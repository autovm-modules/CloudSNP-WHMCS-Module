const { createApp } = Vue


createApp({
    
    data() {
        return {
            
            config: {
                AutovmDefaultCurrencyID: 1,
                AutovmDefaultCurrencySymbol: 'َUSD',
                DefaultMonthlyDecimalForAutoVM: 0,
                DefaultMonthlyDecimalForWH: 0,
                DefaultHourlyDecimalForWH: 0,

                planConfig: {
                    Memory:{
                        min: 1,
                        max: 16,
                        step: 1,
                    },
                    CpuCore:{
                        min: 1,
                        max: 8,
                        step: 1,
                    },
                    CpuLimit:{
                        min: 1,
                        max: 8,
                        step: 1,
                    },
                    Disk:{
                        min: 20,
                        max: 1000,
                        step: 10,
                    },
                },
            },

            checkboxconfirmation: null,
            msg : null,

            RullesText: null,
            planMaxMemorySize: null,
            planMaxDiskSize: null,
            planMaxCpuCore: null,
            planMaxCpuLimit: null,

            RangeValueMemoryString: 1,
            RangeValueCpuCoreString: 1,
            RangeValueDiskString: 20,

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
            planMemoryPrice: null,
            planCpuCorePrice: null,
            planCpuLimitPrice: null,
            planDiskPrice: null,
            planAddressPrice: null,
            planTrafficPrice: null,
            
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
        this.loadRullesFromGit()

        // Load categories
        this.loadCategories()

        // Load user
        this.loadUser()

        // load Whmcs Data
        this.loadCredit()
        this.loadWhCurrencies()
    },

    computed: {


        RangeValueMemory(){
            return parseFloat(this.RangeValueMemoryString);
        },

        RangeValueCpuCore(){
            return parseFloat(this.RangeValueCpuCoreString);
        },

        RangeValueDisk(){
            return parseFloat(this.RangeValueDiskString);
        },  

        RangeValueCpuLimit(){
            return parseFloat(this.RangeValueCpuCore)
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
            if(this.planCpuCorePrice != null && this.planCpuLimitPrice != null && this.planDiskPrice != null && this.planMemoryPrice != null && this.planAddressPrice != null){
                if(this.RangeValueCpuCore != null && this.RangeValueCpuLimit != null && this.RangeValueDisk != null && this.RangeValueMemory != null){
                    let value = (this.planCpuCorePrice * this.RangeValueCpuCore) + (this.planCpuLimitPrice * this.RangeValueCpuLimit) + (this.planDiskPrice * this.RangeValueDisk) + (this.planMemoryPrice * this.RangeValueMemory) + (this.planAddressPrice)
                    return this.formatNumbers(value, 4)
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
        
        formatNumbers(number, decimal) {
            const formatter = new Intl.NumberFormat('en-US', {
                style: 'decimal',
                minimumFractionDigits: decimal,
                maximumFractionDigits: decimal,
            });
            return formatter.format(number);
        },

        ConverFromWhmcsToCloud(value) {
            decimal = this.config.DefaultMonthlyDecimalForAutoVM
            if (this.CurrenciesRatioWhmcsToCloud) {
                let ratio = this.CurrenciesRatioWhmcsToCloud
                let v = value * ratio
                return this.formatNumbers(v, decimal)
            } else {
                return null
            }
        },

        ConverFromAutoVmToWhmcs(value) {
            decimal = this.config.DefaultMonthlyDecimalForWH
            if (this.CurrenciesRatioCloudToWhmcs) {
                let ratio = this.CurrenciesRatioCloudToWhmcs
                let v = value * ratio 
                return this.formatNumbers(v, decimal)
            } else {
                return null
            }
        },
        
        ConverFromAutoVmToWhmcsHourly(value) {
            decimal = this.config.DefaultHourlyDecimalForWH
            if (this.CurrenciesRatioCloudToWhmcs) {
                let ratio = this.CurrenciesRatioCloudToWhmcs
                let v = value * ratio 
                return this.formatNumbers(v, decimal)
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
            let response = await axios.get('/index.php?m=cloudsnp&action=loadCredit');

            if (response?.data) {
                this.userCreditinWhmcs = response.data.credit;
                this.userCurrencyIdFromWhmcs = response.data.userCurrencyId;
            } else {
                console.log('can not find credit');
            }
        },

        // Test Load Currencies
        async loadWhCurrencies() {
            let response = await axios.post('/index.php?m=cloudsnp&action=getAllCurrencies')
            if (response.data.result == 'success') {
                this.WhmcsCurrencies = response.data.currencies
            } else {
                return null
            }
        },

        async loadUser() {
            let response = await axios.get('/index.php?m=cloudsnp&action=login')
            response = response.data
            if (response?.data) {
                this.user = response.data
            }
        },

        async loadRullesFromGit() {
            try {
                let response = await axios.get('https://raw.githubusercontent.com/autovm-modules/AutoVM-WhModules-Reseller/main/README.md');
                this.RullesText = response.data; 
            } catch (error) {
                console.error('Error fetching the file:', error);
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
            let response = await axios.get('/index.php?m=cloudsnp&action=regions')
            
            response = response.data
            if (response?.message) {
                this.regionsAreLoaded = true
                this.plansAreLoaded = false
                console.log('can not find regins');
            }
            if (response?.data) {
                this.regionsLength= response.data.length;
                this.plansAreLoaded = false
                this.regionsAreLoaded = true
                this.regions = response.data
            }
        },

        selectRegion(region) {

            this.plansAreLoading = true
            if(this.regionId == region.id){
                this.plansAreLoading = false
            }
            this.planIsSelected = false
            this.regionId = region.id
            this.regionName = region.name

            this.planId = null
            this.planName = null
            this.planMemoryPrice = null
            this.planCpuCorePrice = null
            this.planCpuLimitPrice = null
            this.planDiskPrice = null
            this.planAddressPrice = null
            this.planTrafficPrice = null

            this.planMaxMemorySize = null
            this.planMaxDiskSize = null
            this.planMaxCpuCore = null
            this.planMaxCpuLimit = null
            
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
            let response = await axios.get('/index.php?m=cloudsnp&action=getPlans', {
                params: {
                    id: this.regionId
                }
            })
            this.plansAreLoading = true
            response = response.data
            if (response?.message) {
                this.plansAreLoading = false;
                this.plansAreLoaded = true;
                console.log('can not find any plans in this regin');
            }
            
            if (response?.data) {
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
            this.planMemoryPrice = parseFloat(plan.memoryPrice)
            this.planCpuCorePrice = parseFloat(plan.cpuCorePrice)
            this.planCpuLimitPrice = parseFloat(plan.cpuLimitPrice)
            this.planDiskPrice = parseFloat(plan.diskPrice)
            this.planAddressPrice = parseFloat(plan.addressPrice)
            this.planTrafficPrice = parseFloat(plan.trafficPrice)

            this.planMaxMemorySize = parseFloat(plan.maxMemorySize) / 1024
            this.planMaxCpuCore = parseFloat(plan.maxCpuCore)
            this.planMaxCpuLimit = parseFloat(plan.maxCpuLimit)
            this.planMaxDiskSize = parseFloat(plan.maxDiskSize)
        },

        isPlan(plan) {

            if (this.planId == plan.id) {
                return true
            } else {
                return false
            }
        },

        async loadCategories() {
            let response = await axios.get('/index.php?m=cloudsnp&action=categories')
            response = response.data
            if (response?.message) {

                // Its not ok to show message here
            }
            if (response?.data) {
                this.categories = response.data
            }
        },

        async create() {
            let accept = await this.openConfirmDialog(this.lang('Create Machine'), this.lang('Are you sure about this?'))

            if (accept) {
                let formData = new FormData()

                if (this.themachinename != null) {formData.append('name', this.themachinename)}
                if (this.themachinename != null) {formData.append('publicKey', this.themachinessh)}
                if (this.planId != null) {formData.append('planId', this.planId)}
                if (this.templateId != null) {formData.append('templateId', this.templateId)}
                if (this.RangeValueMemory != null) {formData.append('memorySize', this.RangeValueMemory * 1024)}
                if (this.RangeValueCpuCore != null) {formData.append('cpuCore', this.RangeValueCpuCore)}
                if (this.RangeValueCpuLimit != null) {formData.append('cpuLimit', this.RangeValueCpuLimit * 1000)}
                if (this.RangeValueDisk != null) {formData.append('diskSize', this.RangeValueDisk)}
                
                formData.append('traffic', 5)


                let response = await axios.post('/index.php?m=cloudsnp&action=create', formData)

                response = response.data

                if (response?.data ) {
                    this.createActionSucced = true
                } else if(response?.message) {
                    this.msg = response?.message
                    this.openMessageDialog(this.lang(response?.message))
                    this.createActionFailed = true
                } else {
                    this.createActionFailed = true
                }
            }
        },


        OpenMachineList() {

            window.open('/index.php?m=cloudsnp&action=pageIndex')

        },
        
        planStartFrom(MemoryPrice, CpuCorePrice, CpuLimitPrice, DiskPrice, AddressPrice) {
            if(MemoryPrice != null && CpuCorePrice != null && CpuLimitPrice != null && DiskPrice != null && AddressPrice != null){
                MemoryPrice = parseFloat(MemoryPrice)
                CpuCorePrice = parseFloat(CpuCorePrice)
                CpuLimitPrice = parseFloat(CpuLimitPrice)
                DiskPrice = parseFloat(DiskPrice)
                AddressPrice = parseFloat(AddressPrice)

                let totalPrice = MemoryPrice + CpuCorePrice + CpuLimitPrice + 20*DiskPrice + AddressPrice
                return totalPrice
            } else {
                return null
            }
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