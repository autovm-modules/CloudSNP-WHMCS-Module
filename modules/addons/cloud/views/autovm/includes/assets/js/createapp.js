const { createApp } = Vue


createApp({

    data() {
        return {

            config: {
                AutovmDefaultCurrencyID: 1,
                AutovmDefaultCurrencySymbol: 'USD',
            },

            WhmcsCurrencies: null,
            userCreditinWhmcs: null,

            userCurrencyIdFromWhmcs: null,


            regions: [],
            products: [],
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

            productsAreLoaded: false,
            productId: null,
            productName: null,
            productPrice: null,
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
    },


    watch: {

        regionId() {

            // Load products
            this.loadProducts()
        },

        regionName() {

            // Load products
            this.loadProducts()

        },

    },

    methods: {

        ConverFromWhmcsToCloud(value, decimal = 100000) {
            if (this.CurrenciesRatioWhmcsToCloud) {
                let ratio = this.CurrenciesRatioWhmcsToCloud
                if (decimal > 0) {
                    return Math.round(value * ratio * decimal) / decimal
                } else {
                    return Math.round(value * ratio)
                }
            } else {
                return null
            }
        },

        ConverFromAutoVmToWhmcs(value, decimal = 100000) {
            if (this.CurrenciesRatioCloudToWhmcs) {
                let ratio = this.CurrenciesRatioCloudToWhmcs
                if (decimal > 0) {
                    return Math.round(value * ratio * decimal) / decimal
                } else {
                    return Math.round(value * ratio)
                }
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

        formatBalance(balance, decimal = 2) {

            return Number(balance).toFixed(decimal)

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

                // Its not ok to show message here
            }

            if (response.data) {

                this.regions = response.data
            }
        },

        selectRegion(region) {

            this.regionId = region.id
            this.productId = ''
            this.productName = ''
            this.productPrice = null
            this.regionName = region.name

        },

        isRegion(region) {

            if (this.regionId == region.id) {
                return true
            } else {
                return false
            }

        },

        async loadProducts() {

            this.products = []

            let response = await axios.get('/index.php?m=cloud&action=products', {
                params: {
                    id: this.regionId
                }
            })

            response = response.data

            if (response.message) {

                // Its not ok to show message here
            }

            if (response.data) {
                this.productsAreLoaded = true;
                this.products = response.data
            }
        },

        selectProduct(product) {

            this.productId = product.id
            this.productName = product.name
            this.productPrice = product.price
        },

        isProduct(product) {

            if (this.productId == product.id) {
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

                if (this.productId) {
                    formData.append('productId', this.productId)
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