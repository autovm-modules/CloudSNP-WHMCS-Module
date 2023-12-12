let messages = {
    'Are you sure about this?': 'Bunu yapmak istediğinizden emin misiniz?'
}

let errors = {
    'Something is in queue.': 'Sıraya bir şeyler eklendi.'
}

let common = {
    
// Machine view 
        
    // from product
    "backtoservices" : "Hizmetlere Geri Dön",
    "mb" : "MB",
    "gb" : "GB",
    "core" : "Çekirdek",
    "hostname" : "Ana Bilgisayar Adı : ",
    "pending" : "Beklemede",
    "processing" : "İşleniyor",
    "active" : "Aktif",
    "passive" : "Pasif",
    "online" : "Çevrimiçi",
    "offline" : "Çevrimdışı",
    "memory" : "HAFIZA",
    "disk" : "DİSK",
    "cpu" : "İŞLEMCİ",
    "template" : "ŞABLON",
    "uptime" : "ÇALIŞMA SÜRESİ",
    "and" : " ve ",
    "days" : "Gün",
    "hours" : "Saat",
    "minutes" : "Dakika",
    "finance" : "Finans",
    "servicesname" : "Hizmet Adı",
    "registrationdate" : "Kayıt Tarihi :",
    "nextpayment" : "Sonraki Ödeme :",
    "billingcycle" : "Fatura Döngüsü :",
    "networkinformation": "Ağ Bilgisi",
    "ipaddress": "IP Adresi :",
    "networkstatus": "Ağ Durumu :",
    "connected": "Bağlandı",
    "disconnected": "Bağlantı Kesildi",
    "login": "Giriş",
    "username": "Kullanıcı Adı",
    "password": "Parola",
    "rebootaction": "Yeniden Başlat",
    "stopaction": "Durdur",
    "consoleaction": "Konsol",
    "startaction": "Başlat",

    "rebooting": "Yeniden başlatılıyor ...!",
    "stoping": "Durduruluyor ...!",
    "consoleing": "Konsol bulunuyor ...!",
    "starting": "Başlatılıyor ...!",
    
    "access": "Erişim",
    "accesstext": "İşte sanal makinenizi yönetmek için gereken bilgiler ve araçlar.",
    "changeos": "İşletim Sistemi Değiştir",
    "network": "Ağ",
    "upgrades": "Yükseltmeler",

    "events": "Olaylar",
    "statistics": "İstatistikler",
    "sshkey": "SSH Anahtarı",
    "status": "Durum",
    "beginingat": "Başlangıçta",
    "endingat": "Bitişte",
    "completed": "Tamamlandı",

    "canceled": "İptal Edildi",
    "loadingmsg": "Yükleniyor",
    "loadingmsglong": "Sunucudan veri çekmeye çalışılıyor, birkaç saniye sürebilir.",
    "iplists": "IP Listeleri",
    "gateway": "Ağ Geçidi",
    "netmask": "Alt Ağ Maskesi",
    "orderip": "IP Siparişi",

    "currentkey": "Geçerli Anahtar: ",
    "upgradecloud": "Bulut Sunucuyu Yükselt",
    "setup": "Kurulum",
    "waittofetch": "Lütfen bekleyin, tüm verileri çekmek birkaç saniye sürebilir ... !",
    "lastactionpending" : "Son eyleminiz hala beklemekte ... !",
    
    "waitforsetup" : "Lütfen kurulumun bitmesini bekleyin ... !",
    "machineisinstalling" : "Makineniz kuruluyor ",
    "dontclose" : "Lütfen bu pencereyi kapatmayın ve kurulumun bitmesini bekleyin ... !",
    "willtake" : "Birkaç dakika sürebilir",
    "goingtoinstall" : "Kurulum yapacaksınız",
    "onyourmachine" : "makinenizde!",
    "installationalert" : "Kurulum sırasında tüm verileriniz kalıcı olarak silinecektir.",
    "destroyalert": "Yok etme işlemiyle kalıcı olarak tüm verilerinizi kaybedersiniz.",
    "clearandinstall" : "Temizle ve Kur",
    "alert" : "Uyarı",
    "installing" : "Kuruluyor",

    "installedsuccessfully" : "başarıyla kuruldu!",
    "accountinformation" : "İşte hesap bilgileriniz:",
    "lastaction" : "Son Eylem : ",
    "close" : "Kapat",
    "thiscommand" : "Bu komut biraz zaman alabilir. Lütfen sabırlı olun.",

    "goingto" : "Şu anda ",
    "yourmachine" : " makinenize gidiyorsunuz!",
    "requestgetlink" : "Konsol bağlantısı almak için istekte bulundunuz.",
    "yourcommand" : "Sizin komutunuz, ",
    "hasdonesuccessfully" : "başarıyla tamamlandı",
    "accessconsole" : "Aşağıdaki bağlantıyı kullanarak konsola erişebilirsiniz",
    "openconsole" : "Konsolu Aç",

    "confirmtext" : "Bunu yapmak istediğinizden emin misiniz?",
    "currentaction" : "Geçerli Eylem : ",
    
    "chooselanguage" : "Dili Seçin",
    "english" : "İngilizce",
    "farsi" : "Farsça",
    "turkish" : "Türkçe",
    "french" : "Fransızca",
    "deutsch" : "Almanca",
    "russian" : "Rusça",
    
    "setlanguage" : "Dili Ayarla",
    "traffics" : "Trafiğe İlişkin Bilgiler",
    "buytraffics" : "Trafik Satın Al",
    "tabeltraffic" : "Trafiğ: ",
    "traffictype" : "Tür: ",
    "trafficusage" : "Trafiğin Kullanımı: ",
    "trafficdate" : "Başlangıç Noktası: ",
    "main" : "Ana",
    "plus" : "Ekstra",
    
    "actionstatuscompleted" : "Tamamlandı",
    "actionstatuspending" : "Beklemede",
    "actionstatusprocessing" : "İşleniyor",

    "fetchingalert" : "Bilgiler Getiriliyor",
    "nothingeheader" : "Hata!",
    "nothingtoseetext" : "Sunucudan herhangi bir bilgi alınamadı, gösterilecek bir şey yok!",
    "software" : "Yazılım Kurulumu",
    "install" : "Kur",
    "consolefailed" : "Konsol bağlantısında bir sorun var, lütfen tekrar deneyin",
    'failed' : 'Arızalı',
    "consoleisrunningalery": "Sistem, konsol bağlantısını hazırlamak için çalışıyor. Bu işlem bir dakikadan kısa sürebilir.",
    "tryagain": "Tekrar Deneyin",
    "sshkeytitle": "SSH Anahtarı : ",
    "suspend" : "askıya almak",
    "unsuspend" : "askıdan çıkarmak",
    "refresh" : "Yenile",
    "trafficplan" : "Trafik Planı",
    "remainingtraffic" : "Kalan Trafik : ",
    "trafficduration" : "Süre :",
    "remainingtime" : "Kalan Zaman :",
    "failactionmsg" : "Son işlem tam olarak gerçekleştirilmedi, durum hala başarısız. Lütfen yeni bir işlem deneyin!",
    "snapshot" : "Snapshot",
    "free" : "Free",
    "gotopanel" : "Denetim Masasına Git",
    "machinestatus" : "Makinenin durumu: ",
    "renewaldate" : "Yenileme tarihi : ",
    "renewedon" : "Yenilenme Tarihi : ",
    "pendingaction" : "Pending Action",
    "machineisdoingnothing" : "No action",
    "accountinformationtitle" : "Account Information",
    "installedsoftware" : "SOFTWARE",
    "traffic" : "TRAFFIC",
// end from Product

// Unique for this cloud
    "todeleteyourmachine" : "Makinenizi silmek için aşağıdaki kutuya yazmalısınız",
    "writedestroy" : "'destroy'",
    "intheboxbelow" : "ve birkaç saniye beklemelisiniz",
    "typehere" : "Buraya yazın:",
    "failedmessage" : "Arka uç verisi alınırken bir sorun oluştu, eylem durumu henüz başarısız oldu!",
    "error" : "Hata",
    "trafficprice" : "Fiyat: ",
    "costperhour" : "Saatlik Maliyet : ",
    "cent" : "Sent",
    "$" : "Dolar",
    "setupaction": "Kurulum",
    "destroying": "Siliniyor ...!",
    "destroyaction": "Sil",
    "fetching" : "Veri Getiriliyor",
    "payasyougo" : "Kullandıkça öde",
// End Unique for this cloud

// end Machine View 

}

const words = {
    ...messages,
    ...common,
    ...errors
}