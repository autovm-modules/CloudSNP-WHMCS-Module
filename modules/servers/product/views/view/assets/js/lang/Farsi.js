
let messages = {
}

let errors = {
}


let common = {
    
// Machine view 
        
    // from product
        "backtoservices" : "بازگشت به خدمات",
        "mb" : "مگابایت",
        "gb" : "گیگابایت",
        "core" : "هسته",
        "hostname" : "نام سرور : ",
        "pending" : "پندینگ",
        "processing" : "در حال پردازش",
        "active" : "فعال",
        "passive" : "غیر فعال",
        "online" : "آنلاین",
        "offline" : "آفلاین",
        "memory" : "حافظه",
        "disk" : "دیسک",
        "cpu" : "پردازنده",
        "template" : "قالب",
        "uptime" : "زمان کارکرد",
        "and" : " و ",
        "days" : "روز",
        "hours" : "ساعت",
        "minutes" : "دقیقه",
        "finance" : "امور مالی",
        "servicesname" : "نام خدمات",
        "registrationdate" : "تاریخ ثبت :",
        "nextpayment" : "پرداخت بعدی :",
        "billingcycle" : "دوره صورتحساب :",
        "networkinformation": "اطلاعات شبکه",
        "ipaddress": "آدرس آی‌پی :",
        "networkstatus": "وضعیت شبکه :",
        "connected": "متصل",
        "disconnected": "قطع اتصال",
        "login": " اطلاعات حساب کاربری",
        "username": "نام کاربری",
        "password": "رمز عبور",
        "rebootaction": "راه‌اندازی مجدد",
        "stopaction": "خاموش کردن ",
        "consoleaction": "کنسول ",
        "startaction": "روشن کردن ",

        "rebooting": "در حال راه‌اندازی مجدد",
        "stoping": "در حال توقف",
        "consoleing": "در حال یافتن کنسول",
        "starting": "در حال شروع",
        
        "access": "دسترسی",
        "accesstext": "اینجا اطلاعات و ابزارهای مدیریت ماشین مجازی شما قرار دارد.",
        "changeos": "تغییر سیستم‌عامل",
        "network": "شبکه",
        "upgrades": "ارتقاء‌ها",

        "events": "رویدادها",
        "statistics": "آمار",
        "sshkey": "کلید SSH",
        "status": "وضعیت",
        "beginingat": "شروع",
        "endingat": "پایان",
        "completed": "تکمیل شده",

        "canceled": "لغو شده",
        "loadingmsg": "در حال بارگیری",
        "loadingmsglong": "در حال تلاش برای دریافت اطلاعات از سرور، ممکن است چند ثانیه طول بکشد.",
        "iplists": "لیست آدرس‌های آی‌پی",
        "gateway": "دروازه",
        "netmask": "نتمسک",
        "orderip": "سفارش آدرس آی‌پی",

        "currentkey": "کلید فعلی: ",
        "upgradecloud": "ارتقاء سرور ابری",
        "setup": "نصب سیستم",
        "waittofetch": "لطفاً صبر کنید، چند ثانیه برای دریافت تمام اطلاعات لازم است ... !",
        "lastactionpending" : "درخواست آخر شما هنوز در حال اجرا است ... !",
        
        "waitforsetup" : "لطفاً منتظر پایان تنظیمات باشید ... !",
        "machineisinstalling" : "ماشین شما در حال نصب سیستم عامل است.",
        "dontclose" : "لطفاً این پنجره را نبندید و منتظر پایان تنظیمات باشید ... !",
        "willtake" : "این ممکن است چند دقیقه طول بکشد",
        "goingtoinstall" : "شما در حال نصب",
        "onyourmachine" : "بر روی ماشین‌ هستید!",
        "installationalert" : "در طول نصب، داده‌های شما به طور دائمی حذف خواهند شد.",
        "destroyalert" : "با عمل حذف ماشین، تمامی اطلاعات ماشین به صورت همیشگی پاک می شود",
        "clearandinstall" : "پاک‌سازی و نصب",
        "alert" : "هشدار",
        "installing" : "در حال نصب",

        "installedsuccessfully" : "با موفقیت نصب شد!",
        "accountinformation" : "اینجا اطلاعات حساب شما قرار دارد:",
        "lastaction" : "آخرین عملیات : ",
        "close" : "بستن",
        "thiscommand" : "این دستور ممکن است کمی طول بکشد. لطفاً صبور باشید.",

        "goingto" : "شما در حال ",
        "yourmachine" : "بر روی ماشین هستید",
        "requestgetlink" : "شما برای دریافت لینک کنسول درخواست داده اید!",
        "yourcommand" : "دستور شما، ",
        "hasdonesuccessfully" : "با موفقیت انجام شد",
        "accessconsole" : "شما می‌توانید از طریق لینک زیر به کنسول‌تان دسترسی پیدا کنید",
        "openconsole" : "باز کردن کنسول",

        "confirmtext" : "آیا از این اطمینان دارید؟",
        "currentaction" : "عملیات فعلی : ",
        
        "chooselanguage" : "زبان را انتخاب کنید",
        "english" : "انگلیسی",
        "farsi" : "فارسی",
        "turkish" : "ترکی",
        "french" : "فرانسوی",
        "deutsch" : "آلمانی",
        "russian" : "روسی",
        
        "setlanguage" : "تنظیم زبان",
        "traffics" : "اطلاعات ترافیک",
        "buytraffics" : "خرید ترافیک",
        "tabeltraffic" : "حجم ترافیک: ",
        "traffictype" : "نوع ترافیک : ",
        "trafficusage" : "ترافیک مصرف شده: ",
        "trafficdate" : "زمان شروع ترافیک: ",
        "main" : "طرح ترافیک اصلی",
        "plus" : "طرح ترافیک اضافه",
        
        "actionstatuscompleted" : "تکمیل شده",
        "actionstatuspending" : "در انتظار تایید",
        "actionstatusprocessing" : "در حال پردازش",

        "fetchingalert" : "در حال دریافت اطلاعات",
        "nothingeheader" : "متاسفانه!",
        "nothingtoseetext" : "هیچ اطلاعاتی از سرور دریافت نکردیم، هیچ چیزی برای نمایش وجود ندارد!",
        "software" : "نصب نرم‌افزار",
        "install" : "نصب",
        "consolefailed" : "مشکلی با لینک کنسول وجود دارد، لطفاً دوباره تلاش کنید",
        'failed' : 'ناموفق',
        "consoleisrunningalery" : "سیستم در حال یافتن لینک اتصال به کنسول است. این فرایند ممکن است چند دقیقه طول بکشد.",
        "tryagain" : "تلاش مجدد",
        "sshkeytitle" : "کلید SSH : ",
        "suspend" : "تعلیق",
        "unsuspend" : "آزادسازی",
        "refresh" : "طرح به‌روز‌رسان",
        "trafficplan" : "طرح ترافیک",
        "remainingtraffic" : "حجم باقیمانده:",
        "trafficduration" : "مدت زمان طرح:",
        "remainingtime" : "زمان باقیمانده:",
        "failactionmsg" : "آخرین عملیات با شکست مواجه شده است. لطفا مجدد تلاش کنید",
        "snapshot" : "اسنپ شات",
        "free" : "رایگان",
        "gotopanel" : "پنل مدیریت ماشین",
        "machinestatus" : "وضعیت ماشین : ",
        "renewaldate" : "پرداخت بعدی :",
        "renewedon" : "آخرین پرداختی :",
        "pendingaction" : "پندینگ",
        "machineisdoingnothing" : "---",
        "accountinformationtitle" : "اطلاعات ماشین",
        "installedsoftware" : "نرم افزار",
        "traffic" : "ترافیک",
    // end from Product

    // Unique for this cloud
        "todeleteyourmachine" : "برای حذف ماشین‌تان، باید عبارت",
        "writedestroy" : "'destroy'",
        "intheboxbelow" : "را در کادر زیر بنویسید و چند ثانیه منتظر بمانید",
        "typehere" : "عبارت را اینجا تایپ کنید:",
        "failedmessage" : "مشکلی در دریافت اطلاعات از سرور وجود دارد، وضعیت عملیات هنوز ناموفق است!",
        "error" : "خطا",
        "trafficprice" : "قیمت : ",
        "costperhour" : "هزینه ساعتی",
        "cent" : "سنت",
        "$" : "دلار",
        "setupaction": "نصب سیستم عامل",
        "destroying": "در حال حذف ",
        "destroyaction": "حذف",
        "fetching" : "در حال دریافت اطلاعات",
        "payasyougo" : "پرداخت به ازای مصرف",
    // End Unique for this cloud

// end Machine View 


}

const words = {
    ...messages,
    ...common,
    ...errors
}
