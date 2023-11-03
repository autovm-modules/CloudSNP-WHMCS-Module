const { createApp } = Vue

app = createApp({

    data() {
        return {
            config: {
                adminUrl: '/admin/clientssummary.php',
                decimals: 0,
                AutovmCurrency: 'USD',
                AutovmCurrencyId: 1,
            },
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
        this.ShowUser()
        this.loadPolling()
        this.loadWhCurrencies()
        this.loadCredit()
    },

    computed: {
        userBalance(){
            let decimals = this.config.decimals
            if(this.user.balance !== null){
                let number = parseFloat(this.user.balance)
                return number.toFixed(decimals)

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

                CurrencyArr.forEach((item) =>{
                    if(item.id == id){
                        UserCurrency = item.suffix;
                    }
                });
                
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
            if(this.userCurrencyIdFromWhmcs != null && this.config.AutovmCurrencyId != null){
                let userCurrencyId = this.userCurrencyIdFromWhmcs;
                let AutovmCurrencyID = this.config.AutovmCurrencyId;
                
                if(userCurrencyId == AutovmCurrencyID){
                    return 1
                } else {
                    let userCurrencyRatio = this.findRationFromId(userCurrencyId)
                    let AutovmCurrencyRatio = this.findRationFromId(AutovmCurrencyID)

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
    },

    methods: {
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
                    this.AdminTransSuccess = null;
                    this.adminTransId = null;
                }, 4000);
            } else {
                this.AdminTransSuccess = false
                setTimeout(() => {
                    this.AdminClickOnTrans = null
                    this.chargeAmountAdminInput = 0
                    this.AdminTransSuccess = null;
                    this.adminTransId = null;
                }, 4000);
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
            var urlParams = new URLSearchParams(window.location.search);
            let userid = this.userid
            let link = this.config.adminUrl
            
            if(userid != null){
                link = this.config.adminUrl + '?' + 'userid=' + this.userid + '&' + 'method=' + method;
            }
            return link
        },

        loadPolling() {
            setInterval(this.ShowUser, 20000)
            setInterval(this.loadCredit, 40000)
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