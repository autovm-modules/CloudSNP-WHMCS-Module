
let messages = {
    'Are you sure about this?': 'Are you sure about this?'
}

let errors = {
    'Something is in queue.': 'Something is in queue.'
}

let common = {
// Machine view 
        
        // from product
        "backtoservices" : "Back to Services",
        "mb" : "MB",
        "gb" : "GB",
        "core" : "Core",
        "hostname" : "Hostname : ",
        "pending" : "Pending",
        "processing" : "Processing",
        "active" : "Active",
        "passive" : "Passive",
        "online" : "Online",
        "offline" : "Offline",
        "memory" : "MEMORY",
        "disk" : "DISK",
        "cpu" : "CPU",
        "template" : "TEMPLATE",
        "uptime" : "UPTIME",
        "and" : " and ",
        "days" : "Day",
        "hours" : "Hour",
        "minutes" : "Minutes",
        "finance" : "Finance",
        "servicesname" : "Services Name",
        "registrationdate" : "Registration Date :",
        "nextpayment" : "Next Payment :",
        "billingcycle" : "Billing Cycle :",
        "networkinformation": "Network Information",
        "ipaddress": "IP Address :",
        "networkstatus": "Network Status :",
        "connected": "Connected",
        "disconnected": "Disconnected",
        "login": "Login",
        "username": "Username",
        "password": "Password",
        "rebootaction": "Reboot",
        "stopaction": "Stop",
        "consoleaction": "Console",
        "startaction": "Start",
    
        "rebooting": "Rebooting!",
        "stoping": "Stoping!",
        "consoleing": "Finding Console!",
        "starting": "Starting!",
        
        "access": "Access",
        "accesstext": "Here is information and tools to manage your VM.",
        "changeos": "Change OS",
        "network": "Network",
        "upgrades": "Upgrades",

        "events": "Events",
        "statistics": "Statistics",
        "sshkey": "SSH Key",
        "status": "Status",
        "beginingat": "Begining At",
        "endingat": "Ending At",
        "completed": "Completed",

        "canceled": "Cancelled",
        "loadingmsg": "Loading",
        "loadingmsglong": "Trying to fetch data from server may take some seconds.",
        "iplists": "IP Lists",
        "gateway": "Gateway",
        "netmask": "Netmask",
        "orderip": "Order IP",

        "currentkey": "Current Key: ",
        "upgradecloud": "Upgrade Cloud Server",
        "setup": "Setup",
        "waittofetch": "Wait please, it takes some second to fetch all data ... !",
        "lastactionpending" : "Your last action is yet pending ... !",
        
        "waitforsetup" : "Please wait for setup to finish ... !",
        "machineisinstalling" : "Your machine is installing ",
        "dontclose" : "Please dont close this window and wait for setup to finish ... !",
        "willtake" : "It will take a few minutes",
        "goingtoinstall" : "You are going to install",
        "onyourmachine" : "on your machine !",
        "installationalert" : "Through installation, you will lose permanently all of your data.",
        "destroyalert" : "By destroy, you will lose permanently all of your data.",
        "clearandinstall" : "Clear and Install",
        "alert" : "Alert",
        "installing" : "Installing",

        "installedsuccessfully" : "has installed successfully !",
        "accountinformation" : "Here is your account information:",
        "lastaction" : "Last Action : ",
        "close" : "Close",
        "thiscommand" : "This command can take a while. Please be patient",

        "goingto" : "You are going to ",
        "yourmachine" : " your machine!",
        "requestgetlink" : "You request to get a link into your Console.",
        "yourcommand" : "Your command, ",
        "hasdonesuccessfully" : "has done successfully",
        "accessconsole" : "You can access to your console through following link.",
        "openconsole" : "Open Console",

        "confirmtext" : "Are you sure about this ?",
        "currentaction" : "Current Action : ",
        
        "chooselanguage" : "Choose the language",
        "english" : "English",
        "farsi" : "Farsi",
        "turkish" : "Turkish",
        "french" : "French",
        "deutsch" : "Deutsch",
        "russian" : "Russian", 
        
        "setlanguage" : "Set Language",
        "traffics" : "Traffics info",
        "buytraffics" : "Purchase",
        "tabeltraffic" : "Traffic: ",
        "traffictype" : "Type: ",
        "trafficusage" : "Traffic Usage: ",
        "trafficdate" : "Starting Point: ",
        "main" : "Main",
        "plus" : "Extra",
        
        "actionstatuscompleted" : "Completed",
        "actionstatuspending" : "Pending",
        "actionstatusprocessing" : "Processing",

        "fetchingalert" : "Fetching Info's",
        "nothingeheader" : "Oops!",
        "nothingtoseetext" : "We did not receive any information from the server, There is nothing to show!",
        "software" : "Install Software",
        "install" : "Install",
        "consolefailed" : "There is problem with the console link, please try again",
        'failed' : 'Failed',
        "consoleisrunningalery" : "System is running to prepare the console link. It can take less than a minutes.",
        "tryagain" : "Try again",
        "sshkeytitle" : "SSH Key : ",
        "suspend" : "Suspend",
        "unsuspend" : "Unsuspend",
        "refresh" : "Refresh",
        "trafficplan" : "Traffic Plan",
        "remainingtraffic" : "Remaining Traffic : ",
        "trafficduration" : "Duration :",
        "remainingtime" : "Remaining time :",
        "failactionmsg" : "The recent action did not finished successfuly, please try a new action!",
        "snapshot" : "Snapshot",
        "free" : "Free",
        "gotopanel" : "Go to Control Panel",
        "machinestatus" : "Machine Status : ",
        "renewaldate" : "Renewal date: ",
        "renewedon" : "Renewed On: ",
        "pendingaction" : "Pending",
        "machineisdoingnothing" : "Nothing",
        "accountinformationtitle" : "Account Information",
        "installedsoftware" : "SOFTWARE",
        "traffic" : "TRAFFIC",
        // end from Product

        // Unique for this cloud
        "todeleteyourmachine" : "To delete your machine, you should write down",
        "writedestroy" : "'destroy'",
        "intheboxbelow" : "in the box below and wait for some seconds",
        "typehere" : "Type Here the word:",
        "failedmessage" : "There is a problem with fetching the backend data, the action status is failed yet !",
        "error" : "Error",
        "trafficprice" : "Price: ",
        "costperhour" : "Cost Per Hour : ",
        "cent" : "¢",
        "$" : "$",
        "setupaction": "Setup OS",
        "destroying": "Destroying",
        "destroyaction": "Destroy",
        "fetching" : "Fetching Data",
        "payasyougo" : "Pay as you go",
        // End Unique for this cloud
    
// end Machine View  
    

}

const words = {
    ...messages,
    ...common,
    ...errors
}
