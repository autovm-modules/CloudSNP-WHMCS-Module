
let messages = {
    'Are you sure about this?': 'Are you sure about this?'
}

let errors = {
    'Something is in queue.': 'Something is in queue.'
}

let common = {
// Machine view 
        
    // from product
    "backtoservices": "Retour aux services",
    "mb": "MB",
    "gb": "GB",
    "core": "Cœur",
    "hostname": "Nom d'hôte : ",
    "pending": "En attente",
    "processing": "En cours de traitement",
    "active": "Actif",
    "passive": "Passif",
    "online": "En ligne",
    "offline": "Hors ligne",
    "memory": "MÉMOIRE",
    "disk": "DISQUE",
    "cpu": "CPU",
    "template": "MODÈLE",
    "uptime": "TEMPS DE FONCTIONNEMENT",
    "and": " et ",
    "days": "Jour",
    "hours": "Heure",
    "minutes": "Minutes",
    "finance": "Finance",
    "servicesname": "Nom des services",
    "registrationdate": "Date d'inscription :",
    "nextpayment": "Prochain paiement :",
    "billingcycle": "Cycle de facturation :",
    "networkinformation": "Informations réseau",
    "ipaddress": "Adresse IP :",
    "networkstatus": "État du réseau :",
    "connected": "Connecté",
    "disconnected": "Déconnecté",
    "login": "Connexion",
    "username": "Nom d'utilisateur",
    "password": "Mot de passe",
    "rebootaction": "Redémarrer",
    "stopaction": "Arrêter",
    "consoleaction": "Console",
    "startaction": "Démarrer",

    "rebooting": "Redémarrage en cours... !",
    "stoping": "Arrêt en cours... !",
    "consoleing": "Recherche de la console... !",
    "starting": "Démarrage en cours... !",

    "access": "Accès",
    "accesstext": "Voici les informations et les outils pour gérer votre machine virtuelle.",
    "changeos": "Changer le système d'exploitation",
    "network": "Réseau",
    "upgrades": "Mises à niveau",

    "events": "Événements",
    "statistics": "Statistiques",
    "sshkey": "Clé SSH",
    "status": "État",
    "beginingat": "Début à",
    "endingat": "Fin à",
    "completed": "Terminé",

    "canceled": "Annulé",
    "loadingmsg": "Chargement",
    "loadingmsglong": "La récupération des données depuis le serveur peut prendre quelques secondes.",
    "iplists": "Listes d'IP",
    "gateway": "Passerelle",
    "netmask": "Masque de réseau",
    "orderip": "Commander une IP",

    "currentkey": "Clé actuelle : ",
    "upgradecloud": "Mise à niveau du serveur Cloud",
    "setup": "Configuration",
    "waittofetch": "Veuillez patienter, cela peut prendre quelques secondes pour récupérer toutes les données... !",
    "lastactionpending": "Votre dernière action est en attente... !",

    "waitforsetup": "Veuillez patienter que la configuration se termine... !",
    "machineisinstalling": "Votre machine est en cours d'installation ",
    "dontclose": "Veuillez ne pas fermer cette fenêtre et attendre que la configuration se termine... !",
    "willtake": "Cela prendra quelques minutes",
    "goingtoinstall": "Vous allez installer",
    "onyourmachine": "sur votre machine !",
    "installationalert": "Pendant l'installation, vous perdrez définitivement toutes vos données.",
    "destroyalert": "En détruisant, vous perdrez définitivement toutes vos données.",
    "clearandinstall": "Effacer et installer",
    "alert": "Alerte",
    "installing": "Installation en cours",

    "installedsuccessfully": "a été installé avec succès !",
    "accountinformation": "Voici les informations de votre compte :",
    "lastaction": "Dernière action : ",
    "close": "Fermer",
    "thiscommand": "Cette commande peut prendre un certain temps. Veuillez patienter",

    "goingto": "Vous allez ",
    "yourmachine": " votre machine !",
    "requestgetlink": "Vous avez demandé à obtenir un lien vers votre console.",
    "yourcommand": "Votre commande, ",
    "hasdonesuccessfully": "a été effectuée avec succès",
    "accessconsole": "Vous pouvez accéder à votre console via le lien suivant",
    "openconsole": "Ouvrir la console",

    "confirmtext": "Êtes-vous sûr de cela ?",
    "currentaction": "Action actuelle : ",

    "chooselanguage": "Choisissez la langue",
    "english": "Anglais",
    "farsi": "Farsi",
    "turkish": "Turc",
    "french": "Français",
    "deutsch": "Allemand",
    "russian": "Russe",

    "setlanguage": "Définir la langue",
    "traffics": "Informations sur le trafic",
    "buytraffics": "Acheter",
    "tabeltraffic": "Trafic : ",
    "traffictype": "Type : ",
    "trafficusage": "Utilisation du trafic : ",
    "trafficdate": "Point de départ : ",
    "main": "Principal",
    "plus": "Supplémentaire",

    "actionstatuscompleted": "Terminé",
    "actionstatuspending": "En attente",
    "actionstatusprocessing": "En cours de traitement",

    "fetchingalert": "Récupération des informations en cours",
    "nothingeheader": "Oups !",
    "nothingtoseetext": "Nous n'avons reçu aucune information du serveur. Rien à afficher !",
    "software": "Installer un logiciel",
    "install": "Installer",
    "consolefailed": "Il y a un problème avec le lien de la console. Veuillez réessayer",
    'failed' : 'Échoué',
    "consoleisrunningalery": "Le système est en cours d'exécution pour préparer le lien de la console. Cela peut prendre moins d'une minute.",
    "tryagain": "Réessayez",
    "sshkeytitle": "Clé SSH : ",
    "suspend" : "suspendre",
    "unsuspend" : "réactiver",
    "refresh" : "Rafraîchir",
    "trafficplan" : "Plan de circulation",
    "remainingtraffic" : "Trafic restant : ",
    "trafficduration" : "Durée :",
    "remainingtime" : "Temps restant :",
    "failactionmsg" : "L'action la plus récente n'a pas été menée à bien complètement, le statut a échoué pour le moment, veuillez essayer une nouvelle action !",
    "snapshot" : "Snapshot",
    "free" : "Free",
    "gotopanel" : "Aller dans le Panneau de configuration",
    "machinestatus" : "Machine status: ",
    "renewaldate" : "Date de renouvellement : ",
    "renewedon" : "Renouvelé le : ",
    "pendingaction" : "Pending Action",
    "machineisdoingnothing" : "No action",
    "accountinformationtitle" : "Account Information",
        "installedsoftware" : "SOFTWARE",
        "traffic" : "TRAFFIC",
    // end from Product

    // Unique for this cloud
    "todeleteyourmachine": "Pour supprimer votre machine, vous devez écrire",
    "writedestroy" : "'destroy'",
    "intheboxbelow": "dans la case ci-dessous et attendre quelques secondes",
    "typehere": "Tapez ici le mot :",
    "failedmessage": "Il y a un problème avec la récupération des données du serveur. L'état de l'action a échoué !",
    "error": "Erreur",
    "trafficprice": "Prix : ",
    "costperhour": "Coût par heure : ",
    "cent": "¢",
    "$": "$",
    "setupaction": "Configuration",
    "destroying": "Destruction en cours... !",
    "destroyaction": "Détruire",
    "fetching": "Récupération des données",
    "payasyougo" : "Payez au fur et à mesure",
    // End Unique for this cloud

// end Machine View 
    



}

const words = {
    ...messages,
    ...common,
    ...errors
}
