const { createApp } = Vue


createApp({
    
    data() {
        return {
            ipv4Checkbox: true,
            ipv6Checkbox: false,

            PersonalRootDirectoryURL: '',
            PanelLanguage: null,
            moduleConfig: null,
            moduleConfigIsLoaded: null,

            planConfig: {
                Memory:{
                    min: 1,
                    step: 1,
                },
                CpuCore:{
                    min: 1,
                    step: 1,
                },
                CpuLimit:{
                    min: 1,
                    step: 1,
                },
                Disk:{
                    min: 20,
                    step: 10,
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

            RangeValueOverallString: 1,

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

        this.loadRullesFromGit()

        // Load regions
        this.loadRegions()
        this.loadCategories()
        this.loadUser()

        // load Whmcs Data
        this.loadCredit()
        this.loadWhCurrencies()
        this.loadModuleConfig()
        this.readLanguageFirstTime()
    },

    computed: {

        config() {
            if(this.moduleConfig != null && this.moduleConfigIsLoaded){
                return {
                AutovmDefaultCurrencyID: this.moduleConfig.AutovmDefaultCurrencyID,
                AutovmDefaultCurrencySymbol: this.moduleConfig.AutovmDefaultCurrencySymbol,
                ConsoleRoute: this.moduleConfig.ConsoleRoute,
                DefaultMonthlyDecimal: this.moduleConfig.DefaultMonthlyDecimal,
                DefaultHourlyDecimal: this.moduleConfig.DefaultHourlyDecimal,
                DefaultBalanceDecimalCloud: this.moduleConfig.DefaultBalanceDecimalCloud,
                DefaultBalanceDecimalWhmcs: this.moduleConfig.DefaultBalanceDecimalWhmcs,
                // Add more properties as needed
                };
            } else {
                return {
                    AutovmDefaultCurrencyID: null,
                    AutovmDefaultCurrencySymbol: null,
                    DefaultMonthlyDecimal: 0,
                    DefaultHourlyDecimal: 2,
                    DefaultBalanceDecimalCloud: 0,
                    DefaultBalanceDecimalWhmcs: 0,
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
        
        RangeValueOverall(){
            return parseFloat(this.RangeValueOverallString)
        },

        NewMachinePrice(){
            let decimal = this.config.DefaultMonthlyDecimal
            if(this.planCpuCorePrice != null && this.planCpuLimitPrice != null && this.planDiskPrice != null && this.planMemoryPrice != null && this.planAddressPrice != null){
                if(this.RangeValueCpuCore != null && this.RangeValueCpuLimit != null && this.RangeValueDisk != null && this.RangeValueMemory != null){
                    let value = (this.planCpuCorePrice * this.RangeValueCpuCore) + (this.planCpuLimitPrice * this.RangeValueCpuLimit) + (this.planDiskPrice * this.RangeValueDisk) + (this.planMemoryPrice * this.RangeValueMemory) + (this.planAddressPrice)
                    return value
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

        ipv6Checkbox(){
            if(this.ipv6Checkbox == false){
                this.ipv4Checkbox = true;
            }
        },
        
        ipv4Checkbox(){
            if(this.ipv4Checkbox == false){
                this.ipv6Checkbox = true;
            }
        },
        
        RangeValueOverall() {
            let percentage = this.RangeValueOverall

            if(percentage == 1){
                this.RangeValueMemoryString = this.planConfig.Memory.min
                this.RangeValueDiskString = this.planConfig.Disk.min
                this.RangeValueCpuCoreString = this.planConfig.CpuCore.min
            } else {
                this.RangeValueMemoryString = this.normallizeRangeValues(percentage, this.planConfig.Memory.min, this.planMaxMemorySize, this.planConfig.Memory.step)
                this.RangeValueDiskString = this.normallizeRangeValues(percentage, this.planConfig.Disk.min, this.planMaxDiskSize, this.planConfig.Disk.step)
                this.RangeValueCpuCoreString = this.normallizeRangeValues(percentage, this.planConfig.CpuCore.min, this.planMaxCpuCore, this.planConfig.CpuCore.step)
            }

        },
    },

    methods: {

        normallizeRangeValues(percentage, min, max, step){
            let value = Math.ceil(percentage / 100 * (max - min) / step) * step + min
            return value.toString()
        },

        formatNumbers(number, decimal) {
            const formatter = new Intl.NumberFormat('en-US', {
                style: 'decimal',
                minimumFractionDigits: decimal,
                maximumFractionDigits: decimal,
            });
            return formatter.format(number);
        },

        ConverFromWhmcsToCloud(value) {
            if (this.CurrenciesRatioWhmcsToCloud) {
                let ratio = this.CurrenciesRatioWhmcsToCloud                
                return (value * ratio)
            } else {
                return null
            }
        },
        

        ConverFromAutoVmToWhmcs(value) {
            if (this.CurrenciesRatioCloudToWhmcs) {
                let ratio = this.CurrenciesRatioCloudToWhmcs
                return (value * ratio )
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
                return value.toLocaleString('en-US', { minimumFractionDigits: decimal, maximumFractionDigits: decimal })
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
              
        async loadModuleConfig() {
            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=getModuleConfig');
            
            if(response.data){
                const answer = response.data
                const requiredProperties = [
                    'AutovmDefaultCurrencyID',
                    'AutovmDefaultCurrencySymbol',
                    'ConsoleRoute',
                    'DefaultMonthlyDecimal',
                    'DefaultHourlyDecimal',
                    'DefaultBalanceDecimalCloud',
                    'DefaultBalanceDecimalWhmcs',
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

        // Load User Credit
        async loadCredit() {
            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=loadCredit');

            if (response?.data) {
                this.userCreditinWhmcs = response.data.credit;
                this.userCurrencyIdFromWhmcs = response.data.userCurrencyId;
            } else {
                console.log('can not find credit');
            }
        },

        // Test Load Currencies
        async loadWhCurrencies() {
            let response = await axios.post(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=getAllCurrencies')
            if (response.data.result == 'success') {
                this.WhmcsCurrencies = response.data.currencies
            } else {
                return null
            }
        },

        async loadUser() {
            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=login')
            response = response.data
            if (response?.data) {
                this.user = response.data
            }
        },

        async loadRullesFromGit() {
            try {
                let response = await axios.get('https://raw.githubusercontent.com/autovm-modules/AutoVM-WhModules-Reseller/main/modules/addons/cloudsnp/views/autovm/includes/commodules/rulles.php');
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

        showBalanceWhmcsUnit(value){
            let decimal = this.config.DefaultBalanceDecimalWhmcs        
            return this.formatNumbers(value, decimal)
        },
        
        showBalanceCloudUnit(value){
            let decimal = this.config.DefaultBalanceDecimalCloud        
            return this.formatNumbers(value, decimal)
        },

        formatPrice(price, decimal = 2) {
            return Number(price).toFixed(decimal)
        },

        formatCostMonthly(value) {
            let decimal = this.config.DefaultMonthlyDecimal
            if(value < 99999999999999  && value != null){
                if(value > 1){
                    return value.toLocaleString('en-US', { minimumFractionDigits: decimal, maximumFractionDigits: decimal })
                } else if(value > 0.1) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
                } else if(value > 0.01) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 3, maximumFractionDigits: 3 })
                } else if(value > 0.001) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 4, maximumFractionDigits: 4 })
                } else if(value > 0.0001) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 5, maximumFractionDigits: 5 })
                } else if(value > 0.00001) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 6, maximumFractionDigits: 6 })
                } else if(value > 0.000001) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 7, maximumFractionDigits: 7 })
                } else if(value > 0.0000001) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 8, maximumFractionDigits: 8 })
                } else if(value > 0.00000001) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 9, maximumFractionDigits: 9 })
                } else if(value > 0.000000001) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 10, maximumFractionDigits: 10 })
                } else {
                    return valuetoLocaleString('en-US')
                }
            } else {
                return null
            }
        },

        formatCostHourly(value) {
            let decimal = this.config.DefaultHourlyDecimal
            if(value < 99999999999999  && value != null){
                value = value / (30 * 24)
                if(value > 1){
                    return value.toLocaleString('en-US', { minimumFractionDigits: decimal, maximumFractionDigits: decimal })
                } else if(value > 0.1) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
                } else if(value > 0.01) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 3, maximumFractionDigits: 3 })
                } else if(value > 0.001) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 4, maximumFractionDigits: 4 })
                } else if(value > 0.0001) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 5, maximumFractionDigits: 5 })
                } else if(value > 0.00001) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 6, maximumFractionDigits: 6 })
                } else if(value > 0.000001) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 7, maximumFractionDigits: 7 })
                } else if(value > 0.0000001) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 8, maximumFractionDigits: 8 })
                } else if(value > 0.00000001) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 9, maximumFractionDigits: 9 })
                } else if(value > 0.000000001) {
                    return value.toLocaleString('en-US', { minimumFractionDigits: 10, maximumFractionDigits: 10 })
                } else {
                    return valuetoLocaleString('en-US')
                }
            } else {
                return null
            }
        },
        
        async loadRegions() {
            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=regions')
            
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
            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=getPlans', {
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
            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=categories')
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
                
                if (this.ipv4Checkbox == true) {formData.append('ipv4', 1)}
                else if (this.ipv4Checkbox == false) {formData.append('ipv4', 0)}
                
                if (this.ipv6Checkbox == true) {formData.append('ipv6', 1)}
                else if (this.ipv6Checkbox == false) {formData.append('ipv6', 0)}
                
                formData.append('traffic', 5)

                let response = await axios.post(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=create', formData)

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
            window.open(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=pageIndex')
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

          

        formatDescription(description) {
            return description.replace(/\n/g, "<br />");
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