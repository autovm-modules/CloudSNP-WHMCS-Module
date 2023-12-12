
let messages = {
    'Are you sure about this?': 'Are you sure about this?'
}

let errors = {
    'Something is in queue.': 'Something is in queue.'
}

let common = {
// Machine view 
        
        // from product
        "backtoservices": "Zurück zu den Diensten",
        "mb": "MB",
        "gb": "GB",
        "core": "Kern",
        "hostname": "Hostname : ",
        "pending": "Ausstehend",
        "processing": "In Bearbeitung",
        "active": "Aktiv",
        "passive": "Passiv",
        "online": "Online",
        "offline": "Offline",
        "memory": "SPEICHER",
        "disk": "FESTPLATTE",
        "cpu": "CPU",
        "template": "VORLAGE",
        "uptime": "LAUFZEIT",
        "and": " und ",
        "days": "Tag",
        "hours": "Stunde",
        "minutes": "Minuten",
        "finance": "Finanzen",
        "servicesname": "Dienstname",
        "registrationdate": "Anmeldedatum :",
        "nextpayment": "Nächste Zahlung :",
        "billingcycle": "Abrechnungszyklus :",
        "networkinformation": "Netzwerkinformationen",
        "ipaddress": "IP-Adresse :",
        "networkstatus": "Netzwerkstatus :",
        "connected": "Verbunden",
        "disconnected": "Getrennt",
        "login": "Anmelden",
        "username": "Benutzername",
        "password": "Passwort",
        "rebootaction": "Neustart",
        "stopaction": "Stopp",
        "consoleaction": "Konsole",
        "startaction": "Starten",

        "rebooting": "Neustart läuft...!",
        "stoping": "Stoppen läuft...!",
        "consoleing": "Konsole wird gesucht...!",
        "starting": "Starten läuft...!",

        "access": "Zugriff",
        "accesstext": "Hier finden Sie Informationen und Tools zur Verwaltung Ihrer virtuellen Maschine.",
        "changeos": "Betriebssystem ändern",
        "network": "Netzwerk",
        "upgrades": "Upgrades",

        "events": "Ereignisse",
        "statistics": "Statistiken",
        "sshkey": "SSH-Schlüssel",
        "status": "Status",
        "beginingat": "Beginn um",
        "endingat": "Ende um",
        "completed": "Abgeschlossen",

        "canceled": "Abgebrochen",
        "loadingmsg": "Laden",
        "loadingmsglong": "Das Abrufen von Daten vom Server kann einige Sekunden dauern.",
        "iplists": "IP-Listen",
        "gateway": "Gateway",
        "netmask": "Netzmaske",
        "orderip": "IP bestellen",

        "currentkey": "Aktueller Schlüssel: ",
        "upgradecloud": "Cloud-Server aufrüsten",
        "setup": "Einrichtung",
        "waittofetch": "Bitte warten Sie, das Abrufen aller Daten kann einige Sekunden dauern ...!",
        "lastactionpending": "Ihre letzte Aktion ist noch ausstehend...!",

        "waitforsetup": "Bitte warten Sie, bis die Einrichtung abgeschlossen ist ...!",
        "machineisinstalling": "Ihre Maschine wird installiert ",
        "dontclose": "Bitte schließen Sie dieses Fenster nicht und warten Sie, bis die Einrichtung abgeschlossen ist ...!",
        "willtake": "Es wird einige Minuten dauern",
        "goingtoinstall": "Sie werden installieren",
        "onyourmachine": "auf Ihrer Maschine!",
        "installationalert": "Durch die Installation verlieren Sie dauerhaft alle Ihre Daten.",
        "destroyalert": "Durch das Zerstören verlieren Sie dauerhaft alle Ihre Daten.",
        "clearandinstall": "Löschen und installieren",
        "alert": "Warnung",
        "installing": "Installation läuft",

        "installedsuccessfully": "wurde erfolgreich installiert!",
        "accountinformation": "Hier sind Ihre Kontoinformationen:",
        "lastaction": "Letzte Aktion : ",
        "close": "Schließen",
        "thiscommand": "Dieser Befehl kann eine Weile dauern. Bitte haben Sie Geduld",

        "goingto": "Sie werden ",
        "yourmachine": " Ihre Maschine!",
        "requestgetlink": "Sie haben eine Anfrage gestellt, um einen Link zu Ihrer Konsole zu erhalten.",
        "yourcommand": "Ihr Befehl, ",
        "hasdonesuccessfully": "wurde erfolgreich ausgeführt",
        "accessconsole": "Sie können auf Ihre Konsole über den folgenden Link zugreifen",
        "openconsole": "Konsole öffnen",

        "confirmtext": "Sind Sie sicher?",
        "currentaction": "Aktuelle Aktion : ",

        "chooselanguage": "Sprache auswählen",
        "english": "Englisch",
        "farsi": "Farsi",
        "turkish": "Türkisch",
        "french": "Französisch",
        "deutsch": "Deutsch",
        "russian": "Russisch",

        "setlanguage": "Sprache festlegen",
        "traffics": "Verkehrsinfo",
        "buytraffics": "Kaufen",
        "tabeltraffic": "Verkehr: ",
        "traffictype": "Typ: ",
        "trafficusage": "Verkehrsverwendung: ",
        "trafficdate": "Startpunkt: ",
        "main": "Haupt",
        "plus": "Zusätzlich",

        "actionstatuscompleted": "Abgeschlossen",
        "actionstatuspending": "Ausstehend",
        "actionstatusprocessing": "In Bearbeitung",

        "fetchingalert": "Abrufen von Informationen...",
        "nothingeheader": "Hoppla!",
        "nothingtoseetext": "Wir haben keine Informationen vom Server erhalten. Nichts zu zeigen!",
        "software": "Software installieren",
        "install": "Installieren",
        "consolefailed": "Es gibt ein Problem mit dem Konsolenlink. Bitte versuchen Sie es erneut",
        'failed' : 'Fehlgeschlagen',
        "consoleisrunningalery": "Das System wird ausgeführt, um den Konsolenlink vorzubereiten. Dies kann weniger als eine Minute dauern.",
        "tryagain": "Erneut versuchen",
        "sshkeytitle": "SSH-Schlüssel: ",
        "suspend" : "sperren",
        "unsuspend" : "entsperren",
        "refresh" : "Aktualisierung",
        "trafficplan" : "Verkehrsplan",
        "remainingtraffic" : "Verbleibender Verkehr : ",
        "trafficduration" : "Dauer :",
        "remainingtime" : "Verbleibende Zeit :",
        "failactionmsg" : "Die neueste Aktion wurde nicht vollständig durchgeführt, der Status ist noch fehlgeschlagen. Bitte versuchen Sie eine neue Aktion!",
        "snapshot" : "Snapshot",
        "free" : "Free",
        "gotopanel" : "Ga naar het Configuratiescherm",
        "machinestatus" : "Machine status: ",
        "renewaldate" : "Yenileme tarihi : ",
        "renewedon" : "Yenilenme Tarihi : ",
        "pendingaction" : "Pending Action",
        "machineisdoingnothing" : "nein",
        "accountinformationtitle" : "Account Information",
        "installedsoftware" : "SOFTWARE",
        "traffic" : "TRAFFIC",
        // end from Product

        // Unique for this cloud
        "todeleteyourmachine": "Um Ihre Maschine zu löschen, müssen Sie",
        "writedestroy" : "'destroy'",
        "intheboxbelow": "in das unten stehende Feld eingeben und einige Sekunden warten",
        "typehere": "Hier den Text eingeben:",
        "failedmessage": "Es gibt ein Problem beim Abrufen der Backend-Daten. Der Aktionstatus ist noch nicht abgeschlossen!",
        "error": "Fehler",
        "trafficprice": "Preis: ",
        "costperhour": "Kosten pro Stunde : ",
        "cent": "Cent",
        "$": "$",
        "setupaction": "Einrichtung",
        "destroying": "Zerstören läuft...!",
        "destroyaction": "Zerstören",
        "fetching": "Daten abrufen",
        "payasyougo" : "Zahlen Sie wenn sie hinausgehen",
        // End Unique for this cloud
    
// end Machine View 
    






}

const words = {
    ...messages,
    ...common,
    ...errors
}
