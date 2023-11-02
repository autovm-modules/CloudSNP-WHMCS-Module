const { createApp } = Vue


createApp({

    data() {
        return {
            
            config: {
                AutovmDefaultCurrencyID: 1,
                AutovmDefaultCurrencySymbol: 'USD',
                DefaultMonthlyDecimal: 3,
                DefaultHourlyDecimal: 4,
                DefaultBalanceDecimal: 5,

                planConfig: {
                    Traffic:{
                        min: 1,
                        max: 500,
                        step: 1,
                    },
                    Memory:{
                        min: 1,
                        max: 10,
                        step: 1,
                    },
                    CpuCore:{
                        min: 1,
                        max: 24,
                        step: 1,
                    },
                    CpuLimit:{
                        min: 1500,
                        max: 32000,
                        step: 100,
                    },
                    Disk:{
                        min: 1500,
                        max: 32000,
                        step: 100,
                    },
                },
            },

            RangeValueTraffic: 1,
            RangeValueMemory: 1,
            RangeValueCpuCore: 1,
            RangeValueCpuLimit: 1,
            RangeValueDisk: 1,

            WhmcsCurrencies: null,
            userCreditinWhmcs: null,

            userCurrencyIdFromWhmcs: null,


            regions: [],
            regionsAreLoaded: false,
            plans: [],
            plansAreLoaded: false,
            plansAreLoading: false,
            planIsSelected: false,

            categories: [],
            user: {},

            confirmDialog: false,
            confirmTitle: null,
            confirmText: null,

            messageDialog: false,
            messageText: null,

            name: null,
            regionId: null,
            regionName: null,

            planId: null,
            planName: null,
            planTrafficPrice: null,
            planMemoryPrice: null,
            planCpuCorePrice: null,
            planCpuLimitPrice: null,
            planDiskPrice: null,
            
            plansLength: 0,
            regionsLength: 0,

            templateId: null,

            themachinename: null,
            MachineNameValidationError: false,
            SshNameValidationError: false,
            MachineNamePreviousValue: "",
            SshNamePreviousValue: "",

            themachinessh: null,

            createActionFailed: false,
            createActionSucced: false,
            userClickedCreationBtn: false,

        }
    },

    mounted() {

        // Load regions
        this.loadRegions()

        // Load categories
        this.loadCategories()

        // Load user
        this.loadUser()

        // load Whmcs Data
        this.loadCredit()
        this.loadWhCurrencies()
    },

    computed: {

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
        
        CurrenciesRatioCloudToWhmcs() {
            if (this.userCurrencyIdFromWhmcs != null && this.config.AutovmDefaultCurrencyID != null) {
                let userCurrencyId = this.userCurrencyIdFromWhmcs;
                let AutovmCurrencyID = this.config.AutovmDefaultCurrencyID;

                if (userCurrencyId == AutovmCurrencyID) {
                    return 1
                } else {
                    let userCurrencyRatio = this.findRationFromId(userCurrencyId)
                    let AutovmCurrencyRatio = this.findRationFromId(AutovmCurrencyID)

                    if (userCurrencyRatio != null && AutovmCurrencyRatio != null) {
                        return userCurrencyRatio / AutovmCurrencyRatio;
                    } else {
                        return null
                    }
                }
            } else {
                return null
            }
        },

        CurrenciesRatioWhmcsToCloud() {
            if (this.CurrenciesRatioCloudToWhmcs != null) {
                return 1 / this.CurrenciesRatioCloudToWhmcs
            } else {
                return null
            }
        },

        NewMachinePrice(){
            let decimal = this.config.DefaultMonthlyDecimal
            if(this.planCpuCorePrice && this.planCpuLimitPrice && this.planDiskPrice && this.planMemoryPrice && this.planTrafficPrice){
                if(this.RangeValueCpuCore && this.RangeValueCpuLimit && this.RangeValueDisk && this.RangeValueMemory && this.RangeValueTraffic){
                    let value = (this.planCpuCorePrice * this.RangeValueCpuCore) + (this.planCpuLimitPrice * this.RangeValueCpuLimit) + (this.planDiskPrice * this.RangeValueDisk) + (this.planMemoryPrice * this.RangeValueMemory) + (this.planTrafficPrice * this.RangeValueTraffic)

                    const formatted = Number(value).toFixed(decimal);
                    return parseFloat(formatted).toLocaleString();
                } else {
                    return null
                }
            } else {
                return null
            }
        },


    },


    watch: {

        regionId() {
            this.loadPlans()
        },
    },

    methods: {
        
        formatNumberMonthly(value){
            let decimal = this.config.DefaultMonthlyDecimal

            if(value < 99999999999999  && value != null){    
                const formatted = Number(value).toFixed(decimal);
                return parseFloat(formatted).toLocaleString();
            } else {
                return null
            }
        },
        
        formatNumberHourly(value){
            let decimal = this.config.DefaultHourlyDecimal
            if(value < 99999999999999  && value != null){
                const formatted = Number(value).toFixed(decimal);
                return parseFloat(formatted).toLocaleString();
            } else {
                return null
            }
        },

        ConverFromWhmcsToCloud(value) {
            let decimal = this.config.DefaultMonthlyDecimal

            if (this.CurrenciesRatioWhmcsToCloud) {
                let ratio = this.CurrenciesRatioWhmcsToCloud
                let v = value * ratio 
                const formatted = Number(v).toFixed(decimal);
                return parseFloat(formatted).toLocaleString();
            } else {
                return null
            }
        },

        ConverFromAutoVmToWhmcs(value) {
            let decimal = this.config.DefaultMonthlyDecimal
            if (this.CurrenciesRatioCloudToWhmcs) {
                let ratio = this.CurrenciesRatioCloudToWhmcs
                let v = value * ratio 
                const formatted = Number(v).toFixed(decimal);
                return parseFloat(formatted).toLocaleString();
            } else {
                return null
            }
        },

        findRationFromId(id) {
            if (this.WhmcsCurrencies != null) {
                let CurrencyArr = this.WhmcsCurrencies.currency

                let rate = null
                CurrencyArr.forEach((item) => {
                    if (item.id == id) {
                        rate = item.rate;
                    }
                });
                // console.log(rate);

                if (rate) {
                    return rate
                } else {
                    return null
                }
            } else {
                return null
            }
        },

        formatBalance(value) {
            let decimal = this.config.DefaultBalanceDecimal
            if(value < 99999999999999  && value != null){
                const formatted = Number(value).toFixed(decimal);
                return parseFloat(formatted).toLocaleString();
            } else {
                return null
            }
        },
        
        validateInput() {
            // Regular expression to allow only English letters and numbers
        const pattern = /^[A-Za-z0-9]+$/;
        if (!pattern.test(this.themachinename)) {
            this.MachineNameValidationError = true;
            // Restore the previous valid value
            this.themachinename = this.MachineNamePreviousValue;
        } else {
            this.MachineNameValidationError = false;
            // Update the previous valid value
            this.MachineNamePreviousValue = this.themachinename;
        }
        
        if (!pattern.test(this.themachinessh)) {
            this.SshNameValidationError = true;
            // Restore the previous valid value
            this.themachinessh = this.SshNamePreviousValue;
        } else {
            this.SshNameValidationError = false;
            // Update the previous valid value
            this.SshNamePreviousValue = this.themachinessh;
        }
        },
        
        // Load User Credit
        async loadCredit() {
            let response = await axios.get('/index.php?m=cloud&action=loadCredit');

            if (response.data != null) {
                this.userCreditinWhmcs = response.data.credit;
                this.userCurrencyIdFromWhmcs = response.data.userCurrencyId;
            } else {
                console.log('can not find credit');
            }
        },

        // Test Load Currencies
        async loadWhCurrencies() {
            let response = await axios.post('/index.php?m=cloud&action=getAllCurrencies')
            if (response.data.result == 'success') {
                this.WhmcsCurrencies = response.data.currencies
            } else {
                return null
            }
        },

        async loadUser() {

            let response = await axios.get('/index.php?m=cloud&action=login')

            response = response.data

            if (response.message) {

                // Its not ok to show message here
            }

            if (response.data) {

                this.user = response.data
            }
        },

        openConfirmDialog(title, text) {

            // Open dialog
            this.confirmDialog = true

            // Content
            this.confirmText = text
            this.confirmTitle = title

            // Reset click Btn 
            this.createActionFailed = false
            this.createActionSucced = false
            this.userClickedCreationBtn = false

            // Promise
            return new Promise((resolve) => this.confirmResolve = resolve)

        },

        acceptConfirmDialog() {

            this.confirmResolve(true)

            // Close dialog
            this.confirmDialog = false

            // Check Click
            this.userClickedCreationBtn = true

        },

        closeConfirmDialog() {

            this.confirmResolve(false)

            // Close dialog
            this.confirmDialog = false


            // Reset Click BTN
            setTimeout(() => {
                this.createActionFailed = false
                this.createActionSucced = false
                this.userClickedCreationBtn = false
            }, 500);



        },

        openMessageDialog(text) {

            // Open dialog
            this.messageDialog = true

            // Content
            this.messageText = text

            // Promise
            return new Promise((resolve) => this.messageResolve = resolve)
        },

        closeMessageDialog() {

            this.messageResolve(false)

            // Close dialog
            this.messageDialog = false
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

        formatPrice(price, decimal = 2) {

            return Number(price).toFixed(decimal)
        },

        async loadRegions() {
            let response = await axios.get('/index.php?m=cloud&action=regions')
            
            response = response.data
            if (response.message) {
                this.regionsAreLoaded = true
                this.plansAreLoaded = false
                console.log('can not find regins');
            }
            if (response.data) {
                this.regionsLength= response.data.length;
                this.plansAreLoaded = false
                this.regionsAreLoaded = true
                this.regions = response.data
            }
        },

        selectRegion(region) {
            this.plansAreLoading = true
            
            this.planIsSelected = false
            this.regionId = region.id
            this.regionName = region.name

            this.planId = null
            this.planName = null
            this.planTrafficPrice = null
            this.planMemoryPrice = null
            this.planCpuCorePrice = null
            this.planCpuLimitPrice = null
            this.planDiskPrice = null

        },

        isRegion(region) {

            if (this.regionId == region.id) {
                return true
            } else {
                return false
            }

        },

        async loadPlans() {

            this.plans = []
            let response = await axios.get('/index.php?m=cloud&action=getPlans', {
                params: {
                    id: this.regionId
                }
            })
            this.plansAreLoading = true
            response = response.data
            if (response.message) {
                this.plansAreLoading = false;
                this.plansAreLoaded = true;
                console.log('can not find any plans in this regin');
            }
            
            if (response.data) {
                this.plansLength= response.data.length;                
                this.plansAreLoading = false;
                this.plansAreLoaded = true;
                this.plans = response.data
            }
        },

        selectPlan(plan) {
            this.planIsSelected = true
            this.planId = plan.id
            this.planName = plan.name
            this.planTrafficPrice = plan.trafficPrice
            this.planMemoryPrice = plan.memoryPrice
            this.planCpuCorePrice = plan.cpuCorePrice
            this.planCpuLimitPrice = plan.cpuLimitPrice
            this.planDiskPrice = plan.diskPrice
        },

        isPlan(plan) {

            if (this.planId == plan.id) {
                return true
            } else {
                return false
            }
        },

        async loadCategories() {

            let response = await axios.get('/index.php?m=cloud&action=categories')

            response = response.data

            if (response.message) {

                // Its not ok to show message here
            }

            if (response.data) {

                this.categories = response.data
            }
        },

        async create() {

            let accept = await this.openConfirmDialog(this.lang('Create Machine'), this.lang('Are you sure about this?'))

            if (accept) {

                let formData = new FormData()

                if (this.planId) {
                    formData.append('planId', this.planId)
                }

                if (this.templateId) {
                    formData.append('templateId', this.templateId)
                }

                if (this.themachinename) {
                    formData.append('name', this.themachinename)
                }

                let response = await axios.post('/index.php?m=cloud&action=create', formData)

                response = response.data

                if (response.message) {

                    this.openMessageDialog(this.lang(response.message))
                    this.createActionFailed = true

                }

                if (response.data) {

                    this.createActionSucced = true

                }
            }
        },


        OpenMachineList() {

            window.open('/index.php?m=cloud&action=pageIndex')

        },


        reloadPage() {

            location.reload()

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
}).mount('#createapp')