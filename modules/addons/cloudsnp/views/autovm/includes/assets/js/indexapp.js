const { createApp } = Vue

app = createApp({

    data() {
        return {
            PersonalRootDirectoryURL: '',
            PanelLanguage: null,
            moduleConfig: null,
            moduleConfigIsLoaded: null,
            
            machinsLoaded: false,
            userHasNoMachine: false,
            
            machines: [],
            user: {},
            WhmcsCurrencies: null,
            invoice: null,
            ConstantInvoiceId: null,

            userCreditinWhmcs: null,
            userCurrencyIdFromWhmcs: null,
            ConstUserId: null,
            
            chargeAmountinWhmcs: null,
            ConstChargeamountInWhmcs: null,
            chargeAmountAdminInput: null,
            AdminTransSuccess: null,
            adminTransId: null,
            AdminClickOnTrans: null,

            theChargingSteps: 0,
            theStepStatus: 0,
            
            TransactionError: null,
            GlobalError: null,
        }
    },

    mounted() {

        // Load machines
        this.loadMachines()
        this.loadModuleConfig()

        // Load user
        this.loadUser()

        // load Whmcs Data
        this.loadCredit()
        this.loadWhCurrencies()
        this.readLanguageFirstTime()

        // Load polling
        this.loadPolling()
    },

    computed: {
        config() {
            if(this.moduleConfig != null && this.moduleConfigIsLoaded){
                return {
                    AutovmDefaultCurrencyID: this.moduleConfig.AutovmDefaultCurrencyID,
                    AutovmDefaultCurrencySymbol: this.moduleConfig.AutovmDefaultCurrencySymbol,
                    ConsoleRoute: this.moduleConfig.ConsoleRoute,
                    minimumChargeInAutovmCurrency: this.moduleConfig.minimumChargeInAutovmCurrency,
                    DefaultMonthlyDecimal: this.moduleConfig.DefaultMonthlyDecimal,
                    DefaultHourlyDecimal: this.moduleConfig.DefaultHourlyDecimal,
                    DefaultBalanceDecimalWhmcs: this.moduleConfig.DefaultBalanceDecimalWhmcs,
                    DefaultBalanceDecimalCloud: this.moduleConfig.DefaultBalanceDecimalCloud,
                    DefaultChargeAmountDecimalWhmcs: this.moduleConfig.DefaultChargeAmountDecimalWhmcs,
                    DefaultChargeAmountDecimalCloud: this.moduleConfig.DefaultChargeAmountDecimalCloud,
                    DefaultCreditDecimalWhmcs: this.moduleConfig.DefaultCreditDecimalWhmcs,
                    DefaultCreditDecimalCloud: this.moduleConfig.DefaultCreditDecimalCloud,
                    DefaultMinimumDecimalWhmcs: this.moduleConfig.DefaultMinimumDecimalWhmcs,
                    DefaultMinimumDecimalCloud: this.moduleConfig.DefaultMinimumDecimalCloud,
                    DefaultRatioDecimal: this.moduleConfig.DefaultRatioDecimal,
                };
            } else {
                return {
                    AutovmDefaultCurrencyID: null,
                    AutovmDefaultCurrencySymbol: null,
                    ConsoleRoute: null,
                    minimumChargeInAutovmCurrency: 2,
                    DefaultMonthlyDecimal: 0,
                    DefaultHourlyDecimal: 0,
                    DefaultBalanceDecimalWhmcs: 0,
                    DefaultBalanceDecimalCloud: 0,
                    DefaultChargeAmountDecimalWhmcs: 0,
                    DefaultChargeAmountDecimalCloud: 0,
                    DefaultCreditDecimalWhmcs: 0,
                    DefaultCreditDecimalCloud: 0,
                    DefaultMinimumDecimalWhmcs: 0,
                    DefaultMinimumDecimalCloud: 0,
                    DefaultRatioDecimal: 0,
                };
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

        balance(){
            if(this.user.balance){
                return this.user.balance
            } else {
                return null
            }
        },

        activeMachines() {
            let listOfMachines = []
            if (this.isNotEmpty(this.machines)) {

                listOfMachines = _.filter(this.machines, machine => this.isActive(machine.status))

            }
            return listOfMachines
        },

        chargeAmountInAutovmCurrency(){
            if(this.chargeAmountinWhmcs != null && this.CurrenciesRatioWhmcsToCloud != null){
                let value = this.ConverFromWhmcsToCloud(this.chargeAmountinWhmcs)
                return value 
            } else { 
                return null
            }
        },
       
        UserCreditInAutovmCurrency(){
            if(this.userCreditinWhmcs != null && this.CurrenciesRatioWhmcsToCloud != null){
                let value = this.ConverFromWhmcsToCloud(this.userCreditinWhmcs)
                return value 
            } else { 
                return null
            }
        },

        chargingValidity(){
            if(this.CurrenciesRatioWhmcsToCloud != null){
                let usercredit = this.UserCreditInAutovmCurrency;
                let chargeAmount = this.chargeAmountInAutovmCurrency;
                let minimum = this.config.minimumChargeInAutovmCurrency;
                
                if(usercredit == null || chargeAmount == null){
                    return null
                } else {
                    if(usercredit == 0){
                        return "nocredit"
                    } else if(usercredit < minimum) {
                        return "noenoughcredit"
                    } else if(chargeAmount < minimum){
                        return "noenoughchargeamount"
                    } else if(!this.isIntOrFloat(chargeAmount)){
                        return "notinteger"
                    } else if(chargeAmount > usercredit){
                        return "overcredit"
                    } else {
                        return "fine"
                    }
                }
            } else {
                return null
            }
        },
        
        chargeAmountAdminInputisvalide(){
            let value = this.chargeAmountAdminInput;
            if(value != null && this.isIntOrFloat(value) ){
                return true
            } else {
                return false
            }
        },

        CurrenciesRatioCloudToWhmcs(){
            if(this.userCurrencyIdFromWhmcs != null && this.config.AutovmDefaultCurrencyID != null){
                let userCurrencyId = this.userCurrencyIdFromWhmcs;
                let AutovmCurrencyID = this.config.AutovmDefaultCurrencyID;
                
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
        isIntOrFloat(value) {
            if (typeof value === 'number' && !Number.isNaN(value)) {
                return true
            } else {
                return false
            }
        },

        ConverFromWhmcsToCloud(value){
            if(this.CurrenciesRatioWhmcsToCloud){
                let ratio = this.CurrenciesRatioWhmcsToCloud
                return value * ratio
            } else {
                return null
            }
        },

        ConverFromAutoVmToWhmcs(value){
            if(this.CurrenciesRatioCloudToWhmcs){
                let ratio = this.CurrenciesRatioCloudToWhmcs
                return value * ratio
            } else {
            return null
            }
        },

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

        showChargeAmountWhmcsUnit(value){
            decimal = this.config.DefaultChargeAmountDecimalWhmcs        
            return this.formatNumbers(value, decimal)
        },
        
        showChargeAmountCloudUnit(value){
            decimal = this.config.DefaultChargeAmountDecimalCloud        
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
        
        showRatio(value){
            decimal = this.config.DefaultRatioDecimal        
            return this.formatNumbers(value, decimal)
        },
        
        showMinimumeWhmcsUnit(value){
            decimal = this.config.DefaultMinimumDecimalWhmcs        
            return this.formatNumbers(value, decimal)
        },
        
        showMinimumeCloudUnit(value){
            decimal = this.config.DefaultMinimumDecimalWhmcs        
            return this.formatNumbers(value, decimal)
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
                // console.log(rate);
                
                if(rate){
                    return rate    
                } else {
                    return null
                }
            } else {
                return null
            }
        },

        formatBalance(balance, decimal = 2) {

            return Number(balance).toFixed(decimal)
        },

        formatCost(value, decimal = 2) {

            return Number(value).toFixed(decimal)
        },

        SuccessWindow(){
            const successModal = document.getElementById('successModal');
            const chargeModal = document.getElementById('chargeModal');

            $("#chargeModal").modal('hide');
            $("#successModal").modal('show'); 
        },
        
        FailWindow(){
            const failModal = document.getElementById('failModal');
            const chargeModal = document.getElementById('chargeModal');

            $("#chargeModal").modal('hide');
            $("#failModal").modal('show'); 
        },

        reloadpage(){
            location.reload()
        },
        
        async loadUser() {

            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=login')

            response = response.data

            if (response.message) {

                // Its not ok to show message here
            }

            if (response.data) {
                this.user = response.data
                this.ConstUserId = Object.freeze({value: response.data.id});
            }
        },

        async loadModuleConfig() {
            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=getModuleConfig');
            if(response.data){
                const answer = response.data
                const requiredProperties = [
                    'AutovmDefaultCurrencyID',
                    'AutovmDefaultCurrencySymbol',
                    'ConsoleRoute',
                    'minimumChargeInAutovmCurrency',
                    'DefaultMonthlyDecimal',
                    'DefaultHourlyDecimal',
                    'DefaultBalanceDecimalWhmcs',
                    'DefaultBalanceDecimalCloud',
                    'DefaultChargeAmountDecimalWhmcs',
                    'DefaultChargeAmountDecimalCloud',
                    'DefaultCreditDecimalWhmcs',
                    'DefaultCreditDecimalCloud',
                    'DefaultMinimumDecimalWhmcs',
                    'DefaultMinimumDecimalCloud',
                    'DefaultRatioDecimal'
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

        async loadMachines() {

            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=machines')

            response = response.data

            if (response.message) {
                this.machinsLoaded = true
                if(response.message == "There is nothing."){
                    this.userHasNoMachine = true;
                }
            }

            if (response.data) {
                this.machines = response.data
                this.machinsLoaded = true
            }
        },

        async loadCredit() {
            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=loadCredit');
            
            if(response.data != null){
                this.userCreditinWhmcs = response.data.credit;
                this.userCurrencyIdFromWhmcs = response.data.userCurrencyId;
            } else {
                console.log('can not find credit');
            }
        },

        async CreateUnpaidInvoice() {
            this.ConstChargeamountInWhmcs = Object.freeze({value: this.chargeAmountinWhmcs});            
              
            const chargeAmountinWhmcs = this.ConstChargeamountInWhmcs.value 
            let chargingValidity = this.chargingValidity;
            this.theChargingSteps = 1;
            this.theStepStatus = 11;
            
            const params = {chargeamount: chargeAmountinWhmcs};

            if(chargingValidity == 'fine'){
                let response = await axios.post(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=CreateUnpaidInvoice', params)
                
                if(response.data.result == 'success'){    
                    this.invoice = response.data;
                    this.ConstantInvoiceId = Object.freeze({value: response.data.invoiceid});
                    setTimeout(() => {
                        this.theStepStatus = 12;
                        this.chargeCloud();
                    }, 6000);
                } else {
                    this.GlobalError = 1
                    setTimeout(() => {
                        this.theStepStatus = 13;
                        this.TransactionError = 'error 1',
                        setTimeout(() => {
                            this.FailWindow();
                        }, 3000);
                    }, 3000);
                }
            } else {
                return null
            }
        },

        async chargeCloud() {
            const id = this.ConstUserId.value;
            const chargeamountInAutovm = this.ConverFromWhmcsToCloud(this.ConstChargeamountInWhmcs.value);
            const invoiceid = this.ConstantInvoiceId.value

            this.theChargingSteps = 2;
            this.theStepStatus = 21;

            const params = {
                chargeamount: chargeamountInAutovm,
                id: id,
                invoiceid: invoiceid,

            };

            if(id > 0){
                let response = await axios.post(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=chargeCloud', params);
                console.log(response);
                
                if(response.data.data){
                    setTimeout(() => {
                        this.theStepStatus = 22;
                        this.applyTheCredit();
                    }, 6000);
                } else {
                    this.GlobalError = 2
                    this.markCancelInvoice()
                    setTimeout(() => {
                        this.theStepStatus = 23;
                        this.TransactionError = 'error 2',
                        setTimeout(() => {
                            this.FailWindow();
                        }, 3000);
                    }, 3000);
                }
            } else {
                return null
            }
        },

        async markCancelInvoice() {
            const invoiceid = this.ConstantInvoiceId.value;
            const params = {invoiceid: invoiceid};

            let response = await axios.post(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=markCancelInvoice', params)
            if(response.data.result == 'success'){    
                console.log('Invoice is marked cancelled successfully');
            } else {
                console.log('can not able to clear invoice'); 
            }
        },
        
        async applyTheCredit() {
            const invoiceid = this.ConstantInvoiceId.value;
            const chargeamountinWhmcs = this.ConstChargeamountInWhmcs.value
            
            this.theChargingSteps = 3;
            this.theStepStatus = 31;

            const params = {invoiceid: invoiceid, chargeamount : chargeamountinWhmcs};

            if(invoiceid > 0){
                let response = await axios.post(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=applyTheCredit', params)
                
                if(response.data.result == 'success'){
                    setTimeout(() => {
                        this.theStepStatus = 32;
                        setTimeout(() => {
                            this.SuccessWindow();
                        }, 1500);
                    }, 6000);
                } else {
                    this.GlobalError = 3
                    setTimeout(() => {
                        this.theStepStatus = 33;
                        this.TransactionError = 'error 3',
                        setTimeout(() => {
                            this.FailWindow();
                        }, 3000);
                    }, 3000);
                }
            } else {
                return null
            }
        },
        
        async loadWhCurrencies() {
            let response = await axios.post(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=getAllCurrencies')    
            if(response.data.result == 'success'){
                this.WhmcsCurrencies = response.data.currencies
            } else {
                return null
            }
        },

        loadPolling() {

            // Load machine
            setInterval(this.loadMachine, 30000)
            
            // Load User
            setInterval(this.loadUser, 30000)
            
            // Load Credit
            setInterval(this.loadCredit, 15000)
            
            // Load Currencies
            setInterval(this.loadWhCurrencies, 50000)

        },

        isEmpty(value) {

            if (_.isEmpty(value)) {
                return true
            } else {
                return false
            }
        },

        isNotEmpty(value) {

            if (_.isEmpty(value)) {
                return false
            } else {
                return true
            }
        },

        getProperty(data, name, empty = null) {

            let value = _.get(data, name)

            if (value) {
                return value
            } else {
                return empty
            }
        },

        isOnline(status) {

            if (status == 'online') {
                return true
            } else {
                return false
            }
        },

        isOffline(status) {

            if (status == 'offline') {
                return true
            } else {
                return false
            }
        },

        isActive(status) {

            if (status == 'active') {
                return true
            } else {
                return false
            }
        },

        isPassive(status) {

            if (status == 'offline') {
                return true
            } else {
                return false
            }
        },
        
        open(machine) {
            let address = '/modules/addons/cloudsnp/views/autovm/machine.php?m=cloudsnp'
            let params = new URLSearchParams({
                'action': 'pageMachine', 'id': machine.id
            }).toString()
            window.open([address, params].join('&'), "_top")
        },

        opencreatepage() {

            let address = '/modules/addons/cloudsnp/views/autovm/create.php'

            window.open([address], "_top")

        },

        address(machine) {

            let listOfReserves = []

            if (this.isNotEmpty(machine)) {

                listOfReserves = _.filter(machine.reserves, reserve => this.isActive(reserve.status))
            }

            let listOfIPs = []

            _.forEach(listOfReserves, function (reserve) {

                listOfIPs.push(reserve.address.address)
            })

            return listOfIPs.shift()
        },

        online(machine) {

            let status = this.getProperty(machine, 'powerStatus.value')

            if (this.isOnline(status)) {
                return true
            } else {
                return false
            }
        },

        offline(machine) {

            let status = this.getProperty(machine, 'powerStatus.value')

            if (this.isOffline(status)) {
                return true
            } else {
                return false
            }
        },

        changeLanguage(){
            let newLang = this.PanelLanguage;
            document.cookie = `temlangcookie=${newLang}; expires=${new Date(Date.now() + 365 * 86400000).toUTCString()}; path=/`;
            window.location.reload();
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
        }
    }
});

app.config.compilerOptions.isCustomElement = tag => tag === 'btn'
app.mount('.indexapp') 