const { createApp } = Vue

app = createApp({

    data() {
        return {
            PersonalRootDirectoryURL: '',
            PanelLanguage: null,
            moduleConfig: null,
            moduleConfigIsLoaded: null,

            user: {},
            softwares:{},
            userLoadStatus: null,
            chargeAmountAdminInput: null,
            AdminClickOnTrans: false,
            AdminTransSuccess: null,
            adminTransId: null,

            WhmcsCurrencies:{},
            userCurrencyIdFromWhmcs: null,
            userCreditinWhmcs: null,
        }
    },
    
    mounted() {
        this.loadModuleConfig()
    },       

    watch: {
        AdminClickOnTrans(){
            if(this.AdminClickOnTrans == true){
                this.AdminTransSuccess = null
                this.adminTransId = null;
            }
        },

        moduleConfigIsLoaded(){
            if(this.moduleConfigIsLoaded == true){
                this.ShowUser()
                this.loadPolling()
                this.loadWhCurrencies()
                this.loadCredit()
                this.readLanguageFirstTime()
            }
        }
    },


    computed: {
        userBalance(){
            if(this.user.balance !== null){
                let number = parseFloat(this.user.balance)
                return number
            } else {
                return null
            }
        },

        userName(){
            if(this.user.name !== null){
                return this.user.name 
            } else {
                return null
            }
        },
        
        userEmail(){            
            if(this.user.email !== null){
                return this.user.email 
            } else {
                return null
            }
        },
        
        userToken(){            
            if(this.user.toekn !== null){
                return this.user.token 
            } else {
                return null
            }
        },

        userid(){
            var urlParams = new URLSearchParams(window.location.search);
            let userid = urlParams.get('userid');
            return userid
        },

        chargeAmountAdminInputisvalide(){
            let value = this.chargeAmountAdminInput;
            if(value != null && this.isIntOrFloat(value) ){
                return true
            } else {
                return false
            }
        },

        userCurrencySymbolFromWhmcs(){
            if(this.WhmcsCurrencies != null && this.userCurrencyIdFromWhmcs != null){
                let CurrencyArr = this.WhmcsCurrencies.currency
                let id = this.userCurrencyIdFromWhmcs
                let UserCurrency = null
                if(this.moduleConfigIsLoaded){
                    let place = this.config.PlaceCurrencySymbol
                    if(place == '' || place == null){
                        place = 'prefix'
                    }
                    CurrencyArr.forEach((item) =>{
                        if(item.id == id){
                            if(place == 'prefix'){
                                UserCurrency = item.prefix;
                            }
                            if(place == 'suffix'){
                                UserCurrency = item.suffix;
                            }
                            if(place == 'code'){
                                UserCurrency = item.code;
                            }
                        }
                    });
                } else {
                    return null
                }
                
                if(UserCurrency){
                    return UserCurrency    
                } else {
                    return null
                }
            } else {
                return null
            }
        },

        CurrenciesRatioCloudToWhmcs(){
            if(this.userCurrencyIdFromWhmcs != null && this.config.AutovmDefaultCurrencyID != null){
                let userCurrencyId = this.userCurrencyIdFromWhmcs;
                let AutovmDefaultCurrencyID = this.config.AutovmDefaultCurrencyID;
                
                if(userCurrencyId == AutovmDefaultCurrencyID){
                    return 1
                } else {
                    let userCurrencyRatio = this.findRationFromId(userCurrencyId)
                    let AutovmCurrencyRatio = this.findRationFromId(AutovmDefaultCurrencyID)

                    if(userCurrencyRatio != null && AutovmCurrencyRatio != null){
                        return userCurrencyRatio/ AutovmCurrencyRatio ;
                    } else {
                        return null           
                    } 
                }
            } else {
                return null
            }
        },
        
        CurrenciesRatioWhmcsToCloud(){
            if(this.CurrenciesRatioCloudToWhmcs != null){
                return 1 / this.CurrenciesRatioCloudToWhmcs                
            } else {
                return null
            }
        },

        config() {
            if(this.moduleConfig != null && this.moduleConfigIsLoaded){
                return {
                    AdminUserSummeryPagePath: this.moduleConfig.AdminUserSummeryPagePath,
                    AutovmDefaultCurrencySymbol: this.moduleConfig.AutovmDefaultCurrencySymbol,
                    AutovmDefaultCurrencyID: this.moduleConfig.AutovmDefaultCurrencyID,
                    DefaultBalanceDecimalWhmcs: this.moduleConfig.DefaultBalanceDecimalWhmcs,
                    DefaultBalanceDecimalCloud: this.moduleConfig.DefaultBalanceDecimalCloud,
                    PlaceCurrencySymbol: this.moduleConfig.PlaceCurrencySymbol,
                    DefaultChargeAmountDecimalWhmcs: this.moduleConfig.DefaultChargeAmountDecimalWhmcs,
                    DefaultChargeAmountDecimalCloud: this.moduleConfig.DefaultChargeAmountDecimalCloud,
                    DefaultCreditDecimalWhmcs: this.moduleConfig.DefaultCreditDecimalWhmcs,
                    DefaultCreditDecimalCloud: this.moduleConfig.DefaultCreditDecimalCloud,
                };
            } else {
                return {
                    AdminUserSummeryPagePath : '/admin/clientssummary.php',
                    AutovmDefaultCurrencySymbol : '$',
                    AutovmDefaultCurrencyID : 1,
                    DefaultBalanceDecimalWhmcs : 0,
                    DefaultBalanceDecimalCloud : 0,
                    PlaceCurrencySymbol : 'prefix',
                    DefaultChargeAmountDecimalWhmcs : 0,
                    DefaultChargeAmountDecimalCloud : 0,
                    DefaultCreditDecimalWhmcs : 0,
                    DefaultCreditDecimalCloud : 0,
                };
            }
        },
    },

    methods: {
        formatNumbers(number, decimal) {
            const formatter = new Intl.NumberFormat('en-US', {
                style: 'decimal',
                minimumFractionDigits: decimal,
                maximumFractionDigits: decimal,
            });
            return formatter.format(number);
        },
        
        showBalanceWhmcsUnit(value){
            decimal = this.config.DefaultBalanceDecimalWhmcs        
            return this.formatNumbers(value, decimal)
        },
        
        showBalanceCloudUnit(value){
            decimal = this.config.DefaultBalanceDecimalCloud        
            return this.formatNumbers(value, decimal)
        },

        showCreditWhmcsUnit(value){
            decimal = this.config.DefaultCreditDecimalWhmcs        
            return this.formatNumbers(value, decimal)
        },
        
        showCreditCloudUnit(value){
            decimal = this.config.DefaultCreditDecimalCloud        
            return this.formatNumbers(value, decimal)
        },

        showChargeAmountWhmcsUnit(value){
            decimal = this.config.DefaultChargeAmountDecimalWhmcs        
            return this.formatNumbers(value, decimal)
        },
        
        showChargeAmountCloudUnit(value){
            decimal = this.config.DefaultChargeAmountDecimalCloud        
            return this.formatNumbers(value, decimal)
        },

        async ShowUser() {
            let link = this.createLink('admin_ShowUser')
            let response = await axios.post(link)
                
            if(response.data.data){
                this.userLoadStatus = 'fine'
                this.user = response.data.data
            } else {
                this.userLoadStatus = 'empty'
                this.msg = response.data.message
                console.log('Can not able to find the user');
            }
            this.softwares = response.data
        },

        async chargeCloudAdmin() {
            this.AdminClickOnTrans = true
            let link = this.createLink('admin_chargeCloud')
            
            let chargeamount = this.chargeAmountAdminInput;
            
            let params = {
                chargeamount: chargeamount,
            };
            
            let response = await axios.post(link, params);
                
            if(response.data){
                this.adminTransId = response.data.data.id
                this.AdminTransSuccess = true
                setTimeout(() => {
                    this.AdminClickOnTrans = null
                    this.chargeAmountAdminInput = 0
                }, 1000);
            } else {
                this.AdminTransSuccess = false
                setTimeout(() => {
                    this.AdminClickOnTrans = null
                    this.chargeAmountAdminInput = 0
                }, 1000);
            }
        },

        async loadWhCurrencies() {
            let link = this.createLink('admin_GetCurrenciesList')
            let response = await axios.post(link)
            
            if(response.data.result == 'success'){
                this.WhmcsCurrencies = response.data.currencies
            } else {
                return null
            }
        },

        async loadCredit() {
            let link = this.createLink('admin_loadCredit')
            let response = await axios.post(link)

            if(response.data != null){
                this.userCreditinWhmcs = response.data.credit;
                this.userCurrencyIdFromWhmcs = response.data.userCurrencyId;
            } else {
                console.log('can not find credit');
            }
        },

        async loadModuleConfig() {
            let link = this.createLink('admin_getModuleConfig')
            let response = await axios.get(link)
            if(response.data){
                const answer = response.data
                const requiredProperties = [
                    'AutovmDefaultCurrencyID',
                    'AutovmDefaultCurrencySymbol',
                    'AdminUserSummeryPagePath',
                    'DefaultBalanceDecimalWhmcs',
                    'DefaultBalanceDecimalCloud',
                    'PlaceCurrencySymbol',
                    'DefaultChargeAmountDecimalWhmcs',
                    'DefaultChargeAmountDecimalCloud',
                    'DefaultCreditDecimalWhmcs',
                    'DefaultCreditDecimalCloud',
                ];
                  
                if (requiredProperties.every(prop => answer.hasOwnProperty(prop))) {
                this.moduleConfigIsLoaded = true;
                this.moduleConfig = response.data
                } else {
                console.log('Module properties does not exist');
                }
            } else {
                console.log('can not get config');
            } 
        },

        ConverFromWhmcsToCloud(value){
            if(this.CurrenciesRatioWhmcsToCloud != null){
                let ratio = this.CurrenciesRatioWhmcsToCloud
                return Math.round(value*ratio)
            } else {
                return null
            }
        },

        ConverFromAutoVmToWhmcs(value){
            if(this.CurrenciesRatioCloudToWhmcs != null){
                let ratio = this.CurrenciesRatioCloudToWhmcs
                return Math.round(value*ratio)
            } else {
            return null
            }
        },
        
        findRationFromId(id){
            if(this.WhmcsCurrencies != null){
                let CurrencyArr = this.WhmcsCurrencies.currency
                
                let rate = null
                CurrencyArr.forEach((item) =>{
                    if(item.id == id){
                        rate = item.rate;
                    }
                });
                
                if(rate){
                    return rate    
                } else {
                    return null
                }
            } else {
                return null
            }
        },

        isIntOrFloat(value) {
            if (typeof value === 'number' && !Number.isNaN(value)) {
                return true
            } else {
                return false
            }
        },

        createLink(method){
            let link = this.config.AdminUserSummeryPagePath
            let userid = this.userid
            if(userid != null){
                link = this.PersonalRootDirectoryURL + this.config.AdminUserSummeryPagePath + '?' + 'userid=' + this.userid + '&' + 'method=' + method;
            }
            return link
        },

        loadPolling() {
            setInterval(this.ShowUser, 20000)
            setInterval(this.loadCredit, 40000)
        },

        changeLanguage(){
            let newLang = this.PanelLanguage;
            document.cookie = `temlangcookie=${newLang}; expires=${new Date(Date.now() + 365 * 86400000).toUTCString()}; path=/`;
            window.parent.location.reload();
        },

        readLanguageFirstTime(){
            this.PanelLanguage = this.getCookieValue('temlangcookie');
        },

        
        getCookieValue(cookieName) {
            const name = cookieName + "=";
            const decodedCookie = decodeURIComponent(document.cookie);
            const cookieArray = decodedCookie.split(';');
          
            for (let i = 0; i < cookieArray.length; i++) {
              let cookie = cookieArray[i];
              while (cookie.charAt(0) === ' ') {
                cookie = cookie.substring(1);
              }
              if (cookie.indexOf(name) === 0) {
                return cookie.substring(name.length, cookie.length);
              }
            }
            return null; // Return an empty string if the cookie is not found
          },

        lang(name) {
            let output = name
            _.forEach(words, function (first, second) {
                if (second.toLowerCase() == name.toLowerCase()) {
                    output = first
                }
            })
            return output
        },
    }
});


app.mount('.adminapp') 