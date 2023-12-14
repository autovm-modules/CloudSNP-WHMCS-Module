const { createApp } = Vue;
app = createApp({

    data() {
        return {
            PersonalRootDirectoryURL: '',
            DiskErrorOverFlow: false,
            PanelLanguage: null,
            moduleConfig: null,
            moduleConfigIsLoaded: null,
            machineTraffic: null,
            
            isVisibe: true,
            WhmcsCurrencies: null,
            userCreditinWhmcs: null,
            userCurrencyIdFromWhmcs: null,

            AddressCopied:false,
            detailIsLoaded: false,
            templateId: null,
            softwareId: null,
            tempNameSetup: '',
            tempIconSetup: '',
            doingAction: '',
            machine: {},
            detail: {},
            uptimeformated: {},
            traffic: {},
            categories: [],
            user: {},

            confirmDialog: false,
            confirmTitle: null,
            confirmText: null,
            messageDialog: false,
            messageText: null,
            osToInstall: '',

            section: 3000,

            showpassword: false,
            machineIsLoaded: false,
            isBetweenPending: false,

            lastAction: 'fetching',
            startNewAction: true,
            confirmdestroytext: '',

            hasCPUradial: false,
            hasRAMradial: false,
            hasDISKradial: false,
            hasBandwidthradial: false,
            cpuRadial: null,
            ramRadial: null,
            diskRadial: null,
            bandwidthRadial: null,


            thereisnodata: true,

            hasMemoryLiniar: false,
            hasCPULiniar: false,

            memoryChart: {
                data: [],
                month: 'Jan',
                min: 0,
            },

            cpuChart: {
                data: [],
                month: 'Jan',
                min: 0,
            },
        }
    },

    mounted() {

        // Load machine
        this.loadMachine()
        this.changeTimeVisibilty()
        // Load user
        this.loadUser()

        // Load detail
        this.loadDetail()

        // Load traffic
        this.loadTraffic()

        // Load categories
        this.loadCategories()

        // Load polling
        this.loadPolling()

        // Radial Charts
        this.createCPURadialGraph()
        this.createRAMRadialGraph()
        this.createDISKRadialGraph()

        // Fetch Linear Charts Data
        this.getMemoryLinearData()
        this.getCPULinearData()
       
        
        // load Whmcs Data
        this.loadCredit()
        this.loadModuleConfig()
        this.loadWhCurrencies()
        this.readLanguageFirstTime()
    },

    watch: {
        detail() {
            this.setLastAction()
            this.formateduptime()
            this.createCPURadialGraph()
            this.createRAMRadialGraph()
            this.createDISKRadialGraph()
        },

        hasMemoryLiniar() {
            this.createMemoryLinearChart()
        },

        hasCPULiniar() {
            this.createCPULinearChart()
        },
        
        machine() {
            this.setLastAction()
        },
    },

    computed: {

        config() {
            if(this.moduleConfig != null && this.moduleConfigIsLoaded){
                return {
                AutovmDefaultCurrencyID: this.moduleConfig.AutovmDefaultCurrencyID,
                AutovmDefaultCurrencySymbol: this.moduleConfig.AutovmDefaultCurrencySymbol,
                PlaceCurrencySymbol: this.moduleConfig.PlaceCurrencySymbol,
                ConsoleRoute: this.moduleConfig.ConsoleRoute,
                DefaultMonthlyDecimal: this.moduleConfig.DefaultMonthlyDecimal,
                DefaultHourlyDecimal: this.moduleConfig.DefaultHourlyDecimal,
                DefaultBalanceDecimalWhmcs: this.moduleConfig.DefaultBalanceDecimalWhmcs,
                // Add more properties as needed
                };
            } else {
                return {
                    AutovmDefaultCurrencyID: null,
                    AutovmDefaultCurrencySymbol: null,
                    PlaceCurrencySymbol: null,
                    DefaultMonthlyDecimal: 0,
                    DefaultHourlyDecimal: 0,
                    DefaultBalanceDecimalWhmcs: 0,
                };
            }
        },

        ConsoleRoute(){
            if(this.moduleConfig != null && this.moduleConfigIsLoaded){
                return this.moduleConfig.ConsoleRoute
            } else {
                return null
            }
        },

        trafficTotal(){
            const value = this.machineTraffic?.total;
            if (value === 0 || value === '0') { return 0; }
            if (value) {
                const numericValue = Number(value);
                if (!isNaN(numericValue)) {
                    const result = numericValue / (1024 * 1024 * 1024);
                    if(result < 1){
                        return Number(result.toFixed(2));
                    } else if(result < 10){
                        return Number(result.toFixed(1));
                    } else {
                        return Number(result.toFixed(0));
                    }
                }
            }
            return null;
        },
        
        trafficSend(){
            const value = this.machineTraffic?.sent;
            if (value === 0 || value === '0') { return 0; }
            if (value) {
                const numericValue = Number(value);
                if (!isNaN(numericValue)) {
                    const result = numericValue / (1024 * 1024 * 1024);
                    if(result < 1){
                        return Number(result.toFixed(2));
                    } else if(result < 10){
                        return Number(result.toFixed(1));
                    } else {
                        return Number(result.toFixed(0));
                    }
                }
            }
            return null;
        },
        
        trafficReceived(){
            const value = this.machineTraffic?.received;
            if (value === 0 || value === '0') { return 0; }
            if (value) {
                const numericValue = Number(value);
                if (!isNaN(numericValue)) {
                    const result = numericValue / (1024 * 1024 * 1024);
                    if(result < 1){
                        return Number(result.toFixed(2));
                    } else if(result < 10){
                        return Number(result.toFixed(1));
                    } else {
                        return Number(result.toFixed(0));
                    }
                }
            }
            return null
        },

        softName() {
            let softName = null
            softName = this.getMachineProperty('software.name')
            return softName
        },

        tempName() {
            let tempName = null
            tempName = this.getMachineProperty('template.name')
            return tempName
        },

        
        tempIcon() {
            let tempIcon = null;
            tempIcon = this.getMachineProperty('template.icon.address')
            return tempIcon
        },

        softIcon() {
            let softIcon = null;
            softIcon = this.getMachineProperty('software.template.icon.address')
            return softIcon
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

        actionStatus() {
            let actionStatus = this.getMachineProperty('action.status');
            return actionStatus;
        },

        findTemplateName() {

            let cats = this.categories

            let id = this.templateId

            for (let i = 0; i < cats.length; i++) {

                let temp = cats[i].templates

                for (let j = 0; j < temp.length; j++) {
                    if (temp[j].id == id) {
                        this.tempNameSetup = temp[j].name
                        return temp[j].name;
                    }
                }
            }

            return 'er';

        },

        findTemplateIcon() {

            let cats = this.categories

            let id = this.templateId

            for (let i = 0; i < cats.length; i++) {

                let temp = cats[i].templates

                for (let j = 0; j < temp.length; j++) {
                    if (temp[j].id == id) {
                        this.tempIconSetup = temp[j].icon
                        return temp[j].icon;
                    }
                }
            }

            return 'er';

        },

        getSetupOS() {

            let templates = this.templates
            let templateId = this.templateId

            function findname(template) {
                if (template.id == templateId) {
                    return template.name
                } else {
                    return false
                }
            }

            let templateName = templates.find(findname).name
            let templateIcon = templates.find(findname).icon.address
            this.tempNameSetup = templateName
            this.tempIconSetup = templateIcon

        },

        uptime() {
            let uptime =  this.getDetailProperty('uptime.value')
            if(uptime == null){
                return null
            } else {
                return uptime
            }
        },

        machineId() {

            let params = new URLSearchParams(window.location.search)

            return params.get('id')

        },

        active() {

            let status = this.getMachineProperty('status')

            if (this.isActive(status)) {
                return true
            } else {
                return false
            }
        },

        passive() {

            let status = this.getMachineProperty('status')

            if (this.isPassive(status)) {
                return true
            } else {
                return false
            }
        },

        online() {

            let status = this.getDetailProperty('powerStatus.value')

            if (this.isOnline(status)) {
                return true
            } else {
                return false
            }
        },

        offline() {

            let status = this.getDetailProperty('powerStatus.value')

            if (this.isOffline(status)) {
                return true
            } else {
                return false
            }
        },

        reserve() {

            return this.getMachineProperty('reserve')
        },

        console() {
            return this.getMachineProperty('console')
        },

        consoleIsPending() {
            let status = this.getMachineProperty('console.status')
            if (this.isPending(status)) {
                return true
            } else {
                return false
            }
        },

        consoleIsProcessing() {

            let status = this.getMachineProperty('console.status')

            if (this.isProcessing(status)) {
                return true
            } else {
                return false
            }
        },

        consoleIsCompleted() {

            let status = this.getMachineProperty('console.status')

            if (this.isCompleted(status)) {
                return true
            } else {
                return false
            }
        },

        consoleIsFailed() {

            let status = this.getMachineProperty('console.status')

            if (this.isFailed(status)) {
                return true
            } else {
                return false
            }
        },

        tempIcon() {

            let tempIcon = '';

            tempIcon = this.getMachineProperty('template.icon.address')

            return tempIcon

        },

        machineUserName() {

            let username = ''
            username = this.getMachineProperty('template.username')
            if (username) {
                return username
            } else {
                return '---'
            }

        },

        machineUserPass() {

            let userpass = ''
            userpass = this.getMachineProperty('password')
            if (userpass) {
                return userpass
            } else {
                return '---'
            }

        },

        actions() {

            return this.getMachineProperty('actions')

        },

        actionMethod() {
            let actionMethod = this.getMachineProperty('action.method');
            if (actionMethod == 'reboot') { return "rebootaction"; }
            else if (actionMethod == 'stop') { return "stopaction"; }
            else if (actionMethod == 'start') { return "startaction"; }
            else if (actionMethod == 'setup') { return "setupaction"; }
            else if (actionMethod == 'console') { return "consoleaction"; }
            else if (actionMethod == 'destroy') { return "destroyaction"; }
            else if (actionMethod == 'suspend') { return "suspend"; }
            else if (actionMethod == 'unsuspend') { return "unsuspend"; }
            else if (actionMethod == 'snapshot') { return "snapshot"; }
            else { return actionMethod; }
        },

        traffics() {

            let traffics = [];

            traffics = this.getMachineProperty('traffics')

            return traffics

        },

        hasalias() {
            let alias = this.getMachineProperty('reserve.address.alias')
            if (alias) {
                return true
            } else {
                return false
            }
        },

        alias() {
            return this.getMachineProperty('reserve.address.alias')
        },

        ipaddress() {

            let address = this.getMachineProperty('reserve.address.address')

            if (address) {

                return address
            } else {

                return '---'
            }

        },

        theMemoryLimit() {
            let memoryLimit = this.getMachineProperty('memoryLimit')
            return memoryLimit
        },

        theCpuLimit() {
            let cpuLimit = this.getMachineProperty('cpuLimit')
            return cpuLimit
        },

        diskSize() {
            let diskSize = this.getMachineProperty('diskSize')
            return diskSize
        },

        memoryUsage() {
            let memoryUsage = this.getDetailProperty('memoryUsage.value')
            return memoryUsage
        },

        cpuUsage() {
            let cpuUsage = this.getDetailProperty('cpuUsage.value')
            return cpuUsage
        },

        diskUsage() {
            let diskUsage = this.getDetailProperty('diskUsage.value')
            return diskUsage
        },
    },

    methods: {

        changeTimeVisibilty() {
            setTimeout(() => {
                this.isVisibe = false;
            }, 6000); // 10 seconds later
        },
        
        ConverFromWhmcsToCloud(value){
            if(this.CurrenciesRatioWhmcsToCloud  && value != null){
                let ratio = this.CurrenciesRatioWhmcsToCloud
                let number = value*ratio
                return number
            } else {
                return null
            }
        },

        ConverFromAutoVmToWhmcs(value){
            if(this.CurrenciesRatioCloudToWhmcs  && value != null){
                let ratio = this.CurrenciesRatioCloudToWhmcs
                let number = value*ratio
                return number
            } else {
                return null
            }
        },
        
        ConverBalanceFromAutoVmToWhmcs(value){
            decimal = this.config.DefaultBalanceDecimal
            if (this.CurrenciesRatioCloudToWhmcs) {
                let ratio = this.CurrenciesRatioCloudToWhmcs
                let v = value * ratio 
                return this.formatNumbers(v, decimal)
            } else {
                return null
            }
        },

        ConverHourlyFromAutoVmToWhmcs(value) {
            decimal = this.config.DefaultHourlyDecimalForWH
            if (this.CurrenciesRatioCloudToWhmcs) {
                let ratio = this.CurrenciesRatioCloudToWhmcs
                let v = value * ratio 
                return this.formatNumbers(v, decimal)
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

        formatBalance(value) {
            let decimal = this.config.DefaultBalanceDecimalWhmcs            
            if(value < 99999999999999  && value != null){
                return value.toLocaleString('en-US', { minimumFractionDigits: decimal, maximumFractionDigits: decimal })
            } else {
                return null
            }
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

        async loadModuleConfig() {
            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=getModuleConfig');
            if(response.data){
                const answer = response.data
                const requiredProperties = [
                    'AutovmDefaultCurrencyID',
                    'AutovmDefaultCurrencySymbol',
                    'PlaceCurrencySymbol',
                    'ConsoleRoute',
                    'DefaultMonthlyDecimal',
                    'DefaultHourlyDecimal',
                    'DefaultBalanceDecimalWhmcs'
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

        async loadCredit() {
            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=loadCredit');
            
            if(response.data != null){
                this.userCreditinWhmcs = response.data.credit;
                this.userCurrencyIdFromWhmcs = response.data.userCurrencyId;
            } else {
                console.log('can not find credit');
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

        async loadUser() {

            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=login')

            response = response.data

            if (response.message) {

                // Its not ok to show message here
            }

            if (response.data) {

                this.user = response.data
            }
        },

        

        setLastAction() {

            if (this.machineIsLoaded) {

                this.lastAction = this.getMachineProperty('action.method')


            } else {

                this.lastAction = 'fetching'

            }

        },

        changeVisibility() {

            this.showpassword = !this.showpassword

        },

        getMachineProperty(name, empty = null) {

            let value = _.get(this.machine, name)

            if (value) {
                return value
            } else {
                return empty
            }

        },

        getDetailProperty(name, empty = null) {

            let value = _.get(this.detail, name)

            if (value) {
                return value
            } else {
                return empty
            }
        },

        bytesToGB(bytes) {

            return Number((bytes / 1073741824)).toFixed(2)
        },

        isMain(type) {

            if (type == 'main') {
                return true
            } else {
                return false
            }
        },

        isRefresh(type) {

            if (type == 'refresh') {
                return true
            } else {
                return false
            }
        },

        isPlus(type) {

            if (type == 'plus') {
                return true
            } else {
                return false
            }
        },

        showSection(section) {

            this.section = section
        },

        isSection(section) {

            if (this.section == section) {
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

            if (status == 'passive') {
                return true
            } else {
                return false
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

        isPending(value) {

            if (value == 'pending') {
                return true
            } else {
                return false
            }
        },

        isProcessing(value) {

            if (value == 'processing') {
                return true
            } else {
                return false
            }
        },

        isCompleted(value) {

            if (value == 'completed') {
                return true
            } else {
                return false
            }
        },

        isFailed(value) {

            if (value == 'failed') {
                return true
            } else {
                return false
            }
        },

        openConfirmDialog(title, text) {

            // Open dialog
            this.confirmDialog = true

            // Content
            this.confirmText = text
            this.confirmTitle = title.toLowerCase()

            // Promise
            return new Promise((resolve) => this.confirmResolve = resolve)
        },

        acceptConfirmDialog() {
            this.confirmResolve(true)
            this.confirmDialog = false
            
            if(this.confirmTitle != "console"){
                this.isBetweenPending = true
            }
        },

        closeConfirmDialog() {

            this.confirmResolve(false)

            // Close dialog
            this.confirmDialog = false
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

        loadPolling() {

            // Load machine
            setInterval(this.loadMachine, 35000)

            // Load detail
            setInterval(this.loadDetail, 30000)

            // Load Credit
            setInterval(this.loadCredit, 2 * 60000)
            
            // Load Currencies
            setInterval(this.loadWhCurrencies, 3 * 60000)
        },

        async loadMachine() {

            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=machine', {
                params: {
                    id: this.machineId
                }
            })

            response = response.data

            if (response.message) {

                // Its not ok to show message here
            }

            if (response.data) {

                this.machine = response.data
                this.machineIsLoaded = true
            }
        },

        async doConsole() {

            this.startNewAction = true

            let accept = await this.openConfirmDialog(this.lang('Console'), this.lang('Are you sure about this?'))

            if (accept) {

                let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=console', {
                    params: {
                        id: this.machineId
                    }
                })

                response = response.data

                if (response.message) {

                    this.openMessageDialog(this.lang(response.message))
                }

                if (response.data) {
                    this.doingAction = 'Console'
                    this.machine = response.data
                }
            }
        },

        openConsole() {
            let address = null
            let params = null
            
            if(this.ConsoleRoute != null){
                address = this.ConsoleRoute
            } else {
                console.log('can not find console route in open console');
            }

            if(address != null){
                let params = new URLSearchParams({
                    'host': this.console.proxy.proxy, 'port': this.console.proxy.port, 'ticket': this.console.ticket
                }).toString()
    
                return window.open([address, params].join('?'))
            }
        },

        async doStop() {

            this.startNewAction = true

            let accept = await this.openConfirmDialog(this.lang('Stop'), this.lang('Are you sure about this?'))

            if (accept) {

                let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=stop', {
                    params: {
                        id: this.machineId
                    }
                })

                response = response.data

                if (response.message) {

                    this.openMessageDialog(this.lang(response.message))
                }

                if (response.data) {
                    this.doingAction = 'Stop'
                    this.machine = response.data
                }
            }
        },

        async doStart() {

            this.startNewAction = true
            let accept = await this.openConfirmDialog(this.lang('Start'), this.lang('Are you sure about this?'))

            if (accept) {

                let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=start', {
                    params: {
                        id: this.machineId
                    }
                })

                response = response.data

                if (response.message) {

                    this.openMessageDialog(this.lang(response.message))
                }

                if (response.data) {
                    this.doingAction = 'Start'
                    this.machine = response.data
                }
            }
        },

        async doReboot() {

            this.startNewAction = true
            let accept = await this.openConfirmDialog(this.lang('Reboot'), this.lang('Are you sure about this?'))

            if (accept) {

                let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=reboot', {
                    params: {
                        id: this.machineId
                    }
                })

                response = response.data

                if (response.message) {

                    this.openMessageDialog(this.lang(response.message))
                }

                if (response.data) {
                    this.doingAction = 'Reboot'
                    this.machine = response.data
                }
            }
        },

        async doSetup() {

            this.startNewAction = true

            let accept = await this.openConfirmDialog(this.lang('Setup'), this.lang('Are you sure about this?'))

            if (accept) {

                let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=setup', {
                    params: {
                        id: this.machineId
                    }
                })

                response = response.data

                if (response.message) {

                    this.openMessageDialog(this.lang(response.message))
                }

                if (response.data) {
                    this.doingAction = 'SetUp'
                    this.machine = response.data
                }
            }
        },

        async doDestroy() {

            this.startNewAction = true

            let accept = await this.openConfirmDialog(this.lang('Destroy'), this.lang('Are you sure about this?'))

            if (accept) {

                let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=destroy', {
                    params: {
                        id: this.machineId
                    }
                })

                response = response.data

                if (response.message) {

                    this.openMessageDialog(this.lang(response.message))
                }

                if (response.data) {

                    this.machine = response.data
                }
            }
        },

        async doChange(event) {

            this.startNewAction = true
            event.preventDefault()

            let accept = await this.openConfirmDialog(this.lang('Setup'), this.lang('Are you sure about this?'))

            if (accept) {

                let formData = new FormData()

                // Template identity
                formData.append('templateId', this.templateId)

                let response = await axios.post(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=change', formData, {
                    params: {
                        id: this.machineId
                    }
                })

                response = response.data

                if (response.message) {

                    this.openMessageDialog(this.lang(response.message))
                }

                if (response.data) {

                    this.machine = response.data
                }
            }
        },

        async CopyAddress() {
            this.AddressCopied = true;
            let ValueToCopy = null;
            if(this.hasalias){
                ValueToCopy = this.alias;
            } else {
                ValueToCopy = this.ipaddress;
            }

            if(ValueToCopy){
                try {
                    await navigator.clipboard.writeText(ValueToCopy);
                } catch (err) {
                    console.log('Unable to copy Address to clipboard', err);
                }    
            }

            setTimeout(() => {
                this.AddressCopied = false;
            }, 1000);
            
        },

        async loadDetail() {

            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=detail', {
                params: {
                    id: this.machineId
                }
            })

            response = response.data

            if (response.message) {

                // Its not ok to show message here
            }

            if (response.data) {

                this.detail = response.data
                this.setDetailLoadStatus()
            }
        },

        createOptionRadials(series, colors, labels) {
            let options = {
                chart: {
                    height: 240,
                    type: "radialBar"
                },

                series: series,
                colors: colors,

                plotOptions: {
                    radialBar: {
                        track: {
                            background: '#F9F5FF',
                        },
                        hollow: {
                            margin: 15,
                            size: "65%"
                        },

                        dataLabels: {
                            showOn: "always",
                            name: {
                                offsetY: -10,
                                show: true,
                                color: "#667085",
                                fontWeight: 300,
                                fontSize: "20px"
                            },
                            value: {
                                color: "#414755",
                                fontSize: "36px",
                                show: true
                            }
                        }
                    }
                },

                stroke: {
                    curve: 'smooth',
                    lineCap: "round",
                },
                labels: labels
            };
            return options
        },

        getMemoryPercent() {

            // Memory limit
            let memoryLimit = this.getMachineProperty('memoryLimit')



            if (!memoryLimit) {
                memoryLimit = 0 // Default value
            }

            // Memory usage
            let memoryUsage = this.getDetailProperty('memoryUsage.value')

            if (!memoryUsage) {
                memoryUsage = 0 // Default value
            }

            // Calculate
            let percent = 0

            if (memoryLimit) {
                percent = (memoryUsage / memoryLimit) * 100
            }

            // Format
            return Number(percent).toFixed()
        },

        createRAMRadialGraph() {
            let element = document.querySelector('.ramRadial')
            let percent = this.getMemoryPercent();
            // create
            if (!this.hasRAMradial) {
                if (percent == 0 || percent > 100) {
                    let options = {};
                    options = this.createOptionRadials(
                        series = [100],
                        colors = ["#7F56D9"],
                        labels = ["RAM Usage"],
                    );
                    this.ramRadial = new ApexCharts(element, options)
                    this.ramRadial.render()
                    this.hasRAMradial = true

                } else {

                    let options = {};
                    options = this.createOptionRadials(
                        series = [percent],
                        colors = ["#7F56D9"],
                        labels = ["RAM Usage"],
                    );
                    this.ramRadial = new ApexCharts(element, options)
                    this.ramRadial.render()
                    this.hasRAMradial = true
                }

            } else {
                if (percent != 0) {
                    // Update
                    this.ramRadial.updateSeries([percent], true)
                } else {
                    this.ramRadial.updateSeries([0], true)
                }
            }
        },

        getCPUPercent() {

            // CPU limit
            let cpuLimit = this.getMachineProperty('cpuLimit')

            if (!cpuLimit) {
                cpuLimit = 0 // Default value
            }

            // CPU usage
            let cpuUsage = this.getDetailProperty('cpuUsage.value')

            if (!cpuUsage) {
                cpuUsage = 0 // Default value
            }

            // Calculate
            let percent = 0

            if (cpuLimit) {
                percent = (cpuUsage / cpuLimit) * 100
            }

            // Format
            return Number(percent).toFixed()
        },

        createCPURadialGraph() {
            let element = document.querySelector('.cpuRadial')
            let percent = this.getCPUPercent();
            // create
            if (!this.hasCPUradial) {
                if (percent == 0 || percent > 100) {
                    let options = {};
                    options = this.createOptionRadials(
                        series = [100],
                        colors = ["#2A4DD1"],
                        labels = ["CPU Usage"],
                    );
                    this.cpuRadial = new ApexCharts(element, options)
                    this.cpuRadial.render()
                    this.hasCPUradial = true

                } else {

                    let options = {};
                    options = this.createOptionRadials(
                        series = percent,
                        colors = ["#2A4DD1"],
                        labels = ["CPU Usage"],
                    );
                    this.cpuRadial = new ApexCharts(element, options)
                    this.cpuRadial.render()
                    this.hasCPUradial = true
                }

            } else {
                if (percent != 0) {
                    // Update
                    this.cpuRadial.updateSeries([percent], true)
                } else {
                    this.cpuRadial.updateSeries([0], true)
                }
            }
        },

        getDiskPercent() {

            // Disk size
            let diskSize = this.getMachineProperty('diskSize')

            if (!diskSize) {
                diskSize = 0 // Default value
            }

            // Disk usage
            let diskUsage = this.getDetailProperty('diskUsage.value')

            if (!diskUsage) {
                diskUsage = 0 // Default value
            }

            // Calculate
            let percent = 0

            if (diskSize) {
                percent = ((diskUsage / 1024) / diskSize) * 100
            }
            
            if(percent && percent > 100){
                this.DiskErrorOverFlow = true
            }

            // Format
            return Number(percent).toFixed()
        },

        createDISKRadialGraph() {
            let element = document.querySelector('.diskRadial')
            let percent = this.getDiskPercent();

            if(percent && percent > 100){
                this.DiskErrorOverFlow = true
            }

            // create
            if (!this.hasDISKradial) {
                if (percent == 0) {
                    let options = {};
                    options = this.createOptionRadials(
                        series = [100],
                        colors = ["#56D9C1"],
                        labels = ["DISK Usage"],
                    );
                    this.diskRadial = new ApexCharts(element, options)
                    this.diskRadial.render()
                    this.hasDISKradial = true

                } else if (percent > 100) {
                    let options = {};
                    options = this.createOptionRadials(
                        series = [0],
                        colors = ["#56D9C1"],
                        labels = ["DISK Usage"],
                    );

                    this.diskRadial = new ApexCharts(element, options)
                    this.diskRadial.render()
                    this.hasDISKradial = true

                } else {
                    let options = {};
                    options = this.createOptionRadials(
                        series = percent,
                        colors = ["#56D9C1"],
                        labels = ["DISK Usage"],
                    );
                    this.diskRadial = new ApexCharts(element, options)
                    this.diskRadial.render()
                    this.hasDISKradial = true
                }

            } else {
                if (percent != 0 && percent < 100) {
                    this.diskRadial.updateSeries([percent], true)
                } else {
                    this.diskRadial.updateSeries([0], true)
                }
            }
        },

        getBandwidthPercent() {

            // Machine Bandwidth size
            let bandwidthSize = this.getMachineProperty('bandwidth')

            if (!bandwidthSize) {
                bandwidthSize = 0 // Default value
            }

            // Disk usage
            let bandwidthUsage = this.getDetailProperty('bandwidth.value')

            if (!bandwidthUsage) {
                bandwidthUsage = 0 // Default value
            }

            // Calculate
            let percent = 0

            if (bandwidthSize) {
                percent = ((bandwidthUsage / 1073741824) / bandwidthSize) * 100
            }

            // Format
            return Number(percent).toFixed()
        },

        createBandwidthRadialGraph() {
            let element = document.querySelector('.bandwidthRadial')
            let percent = this.getBandwidthPercent();
            // create
            if (!this.hasBandwidthradial) {
                if (percent == 0) {
                    let options = {};
                    options = this.createOptionRadials(
                        series = [100],
                        colors = ["#F2BC6B"],
                        labels = ["Bandwidth"],
                    );
                    this.bandwidthRadial = new ApexCharts(element, options)
                    this.bandwidthRadial.render()
                    this.hasBandwidthradial = true

                } else {

                    let options = {};
                    options = this.createOptionRadials(
                        series = percent,
                        colors = ["#F2BC6B"],
                        labels = ["Bandwidth"],
                    );
                    this.bandwidthRadial = new ApexCharts(element, options)
                    this.bandwidthRadial.render()
                    this.hasBandwidthradial = true
                }

            } else {
                if (percent != 0) {
                    // Update
                    this.bandwidthRadial.updateSeries([percent], true)
                } else {
                    this.bandwidthRadial.updateSeries([0], true)
                }
            }
        },

        async loadTraffic() {

            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=currentTrafficUsage', {
                params: {
                    id: this.machineId
                }
            })
            
            response = response.data
            if (response.message) {
            }

            if (response.data) {
                this.machineTraffic = response.data
            }
        },

        async loadCategories() {

            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=categories')

            response = response.data

            if (response.message) {

                // Its not ok to show message here
            }

            if (response.data) {

                this.categories = response.data
            }
        },

        createoption(chartname, data, colors, text) {
            let options = {
                "series": [
                    {
                        "name": chartname,
                        "data": data
                    }
                ],
                "chart": {
                    "animations": {
                        "enabled": false,
                        "easing": "swing"
                    },
                    "background": "#fff",
                    "dropShadow": {
                        "blur": 3
                    },
                    "foreColor": "#373D3F",
                    "fontFamily": "Barlow",
                    "height": 370,
                    "id": "o4Rem",
                    "toolbar": {
                        "show": false,
                        "tools": {
                            "selection": true,
                            "zoom": true,
                            "zoomin": true,
                            "zoomout": true,
                            "pan": true,
                            "reset": true
                        }
                    },
                    "fontUrl": null
                },
                "colors": colors,
                "plotOptions": {
                    "bar": {
                        "borderRadius": 10
                    },
                    "radialBar": {
                        "hollow": {
                            "background": "#fff"
                        },
                        "dataLabels": {
                            "name": {},
                            "value": {},
                            "total": {}
                        }
                    },
                    "pie": {
                        "donut": {
                            "labels": {
                                "name": {},
                                "value": {},
                                "total": {}
                            }
                        }
                    }
                },
                "dataLabels": {
                    "enabled": true,
                    "offsetY": 6,
                    "style": {
                        "fontWeight": 300
                    },
                    "background": {
                        "borderRadius": 5,
                        "borderWidth": 1
                    }
                },
                "fill": {
                    "opacity": 1
                },
                "grid": {
                    "xaxis": {
                        "lines": {
                            "show": true
                        }
                    },
                    "column": {},
                    "padding": {
                        "right": 20,
                        "bottom": 6,
                        "left": 16
                    }
                },
                "legend": {
                    "showForSingleSeries": true,
                    "position": "top",
                    "horizontalAlign": "left",
                    "fontSize": 14,
                    "offsetX": 9,
                    "offsetY": 7,
                    "markers": {
                        "width": 30,
                        "height": 16,
                        "strokeWidth": 8,
                        "radius": 13,
                        "offsetY": 3,
                    },
                    "itemMargin": {
                        "horizontal": 10
                    }
                },


                "tooltip": {},
                "xaxis": {
                    "offsetY": -2,
                    "labels": {
                        "rotate": -45,
                        "trim": true,
                        "style": {
                            "fontSize": 12,
                            "fontWeight": 300
                        }
                    },
                    "axisBorder": {
                        "show": false
                    },
                    "tickAmount": 4,
                    "title": {
                        "text": "",
                        "style": {
                            "fontSize": 12,
                            "fontWeight": 300
                        }
                    }
                },
                "yaxis": {
                    "tickAmount": 6,
                    "min": 0,
                    "labels": {
                        "style": {
                            "fontSize": 12
                        },
                        offsetX: -12,
                        offsetY: 5,
                    },
                    "title": {
                        "text": "",
                        "style": {
                            "fontSize": 12,
                            "fontWeight": 300
                        }
                    }
                }

            };
            return options
        },

        async getMemoryLinearData() {

            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=memoryUsage', {
                params: {
                    id: this.machineId
                }
            })

            // similiar from here
            let memoryChart = [{ x: '8/1', y: 0 }, { x: '8/2', y: 0 }]

            if(response.data.message) {
                console.log('getMemoryLinearData: ' + response.data.message)
            } else {
                memoryChart = []
                response = response.data['data']
                for (let item of response) {
                    memoryChart.push({
                        x: item.month + '/' + item.day,
                        y: item.value,
                    })
                }
            }

            if (memoryChart.length > 0) {
                this.memoryChart.data = memoryChart
            } else {
                this.memoryChart.data = [{ x: '8/1', y: 0 }, { x: '8/2', y: 0 }]
            }

            this.hasMemoryLiniar = true

        },

        async getCPULinearData() {

            let response = await axios.get(this.PersonalRootDirectoryURL + '/index.php?m=cloudsnp&action=cpuUsage', {
                params: { id: this.machineId }
            })

            // similiar from here
            let CPUChart = [{ x: '8/1', y: 0 }, { x: '8/2', y: 0 }]

            if(response.data.message) {
                console.log('getCPULinearData: ' + response.data.message)
            } else {
                CPUChart = []
                response = response.data['data']

                for (let item of response) {
                    CPUChart.push({
                        x: item.month + '/' + item.day,
                        y: item.value,
                    })
                }

            }

            if (CPUChart.length > 0) {
                this.cpuChart.data = CPUChart
            } else {
                this.cpuChart.data = [{ x: '8/1', y: 0 }, { x: '8/2', y: 0 }]
            }

            this.hasCPULiniar = true
        },

        createMemoryLinearChart() {

            let lenghtofdata = this.memoryChart.data.length;
            if (lenghtofdata > 4) {
                this.thereisnodata = false
            }

            // create option
            let options = this.createoption(
                chartname = ["Ram Usage"],
                data = this.memoryChart.data,
                colors = ['#7F56D9'],
                text = 'Ram Usage',
            )

            // Element
            let element = document.querySelector('.RAMLinear')

            // Create Chart
            var chart = new ApexCharts(element, options);
            chart.render();

        },

        createCPULinearChart() {

            let lenghtofdata = this.cpuChart.data.length;
            if (lenghtofdata > 4) {
                this.thereisnodata = false
            }

            // create option
            let options = this.createoption(
                chartname = ["CPU Usage"],
                data = this.cpuChart.data,
                colors = ['#2A4DD1'],
                text = 'CPU Usage',
            )

            // Element
            let element = document.querySelector('.CPULinear')

            // Create Chart
            var chart = new ApexCharts(element, options);
            chart.render();

        },

        formateduptime() {
            let seconds = 1            
            seconds = this.getDetailProperty('uptim.value')
            if (seconds < 61 || seconds == null) {
                seconds = 61;
            }

            if (seconds > 60) {
                let days = Math.floor(seconds / (3600 * 24));

                seconds -= days * 3600 * 24;
                let hours = Math.floor(seconds / 3600);

                seconds -= hours * 3600;
                let minutes = Math.floor(seconds / 60);
                seconds -= minutes * 60;

                let result = {
                    day: '',
                    hr: '',
                    minuts: ''
                };
                if (days > 0) {
                    result.day = days;
                }

                if (hours > 0 || days > 0) {
                    result.hr = hours;
                }

                if (minutes > 0 || hours > 0 || days > 0) {
                    result.minuts = minutes;
                }
                this.uptimeformated = result
            }

        },

        formatdate(time) {


            let year = time.slice(0, 4);
            let month = time.slice(5, 7);
            let day = parseInt(time.slice(8, 10), 10);
            let hour = time.slice(11, 13);
            let minutes = time.slice(14, 16);
            let seconds = time.slice(17, 19);

            const monthNameList = [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'June',
                'July', 'August', 'Sep', 'Oct', 'Nov', 'Dec'
            ];

            let monthName = monthNameList[parseInt(month, 10) - 1];

            function formatday(day) {
                switch (day) {
                    case 1:
                        return 'st';
                    case 2:
                        return 'nd';
                    case 3:
                        return 'rd';
                    default:
                        return ('th');
                }
            }


            result = '<div class="d-flex flex-row justify-content-center align-items-center"><span class="text-secondary p-0 m-0 me-1">' + day + '<sup>' + formatday(day) + '</sup> <span class="ps-1">' + monthName + '</span></span><br class="py-2 my-2"><span class="fs-2 d-none d-md-block"> | </span><span class="text-body-secondary m-0 p-0 d-none d-md-block"><i class="bi bi-clock-fill px-1"></i>' + hour + ':' + minutes + ':' + seconds + '</span></div>';

            return (result)
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
        },

        setDetailLoadStatus() {

            this.detailIsLoaded = true

        },
    }
});


app.mount('.machineapp');