
let messages = {
    'Are you sure about this?': 'Você tem certeza que deseja prosseguir?'
}

let errors = {
    'Something is in queue.': 'Já existe uma ação em andamento...'
}

let common = {
// Machine view
        
        // from product
        "backtoservices" : "Voltar",
        "mb" : "MB",
        "gb" : "GB",
        "core" : "Core",
        "hostname" : "Hostname : ",
        "pending" : "Pendente",
        "processing" : "Processando",
        "active" : "Ativo",
        "passive" : "Inativo",
        "online" : "Online",
        "offline" : "Offline",
        "memory" : "MEMÓRIA",
        "disk" : "DISCO",
        "cpu" : "CPU",
        "template" : "TEMPLATE",
        "uptime" : "UPTIME",
        "and" : " e ",
        "days" : "Dia",
        "hours" : "Hora",
        "minutes" : "Minutos",
        "finance" : "Financeiro",
        "servicesname" : "Nome do Serviço",
        "registrationdate" : "Data de Registro :",
        "nextpayment" : "Próximo Vencimento :",
        "billingcycle" : "Ciclo de Pagamento :",
        "networkinformation": "Informações de Rede",
        "ipaddress": "IP Address :",
        "networkstatus": "Network Status :",
        "connected": "Conectado",
        "disconnected": "Desconectado",
        "login": "Login",
        "username": "Username",
        "password": "Password",
        "rebootaction": "Reiniciar",
        "stopaction": "Desligar",
        "consoleaction": "Console",
        "startaction": "Iniciar",
    
        "rebooting": "Reiniciando ...!",
        "stoping": "Desligando ...!",
        "consoleing": "Iniciando Console ...!",
        "starting": "Iniciando ...!",
        
        "access": "Painel de Controle",
        "accesstext": "Neste painel você pode reinstalar seu servidor, ver eventos de ações, obter dados de rede e muito mais!",
        "changeos": "Reinstalar",
        "network": "Rede",
        "upgrades": "Upgrades",

        "events": "Eventos",
        "statistics": "Estatística",
        "sshkey": "SSH Key",
        "status": "Status",
        "beginingat": "Iniciado em",
        "endingat": "Finalizado em",
        "completed": "Completo",

        "canceled": "Cancelado",
        "loadingmsg": "Carregando",
        "loadingmsglong": "A tentativa de buscar dados do servidor pode levar alguns segundos.",
        "iplists": "Lista de IPs",
        "gateway": "Gateway",
        "netmask": "Netmask",
        "orderip": "Comprar IP",

        "currentkey": "Chave Atual: ",
        "upgradecloud": "Upgrade Cloud Server",
        "setup": "Instalar",
        "waittofetch": "Espere, por favor, leva alguns segundos para buscar todos os dados ... !",
        "lastactionpending" : "Sua última ação ainda está pendente ... !",
        
        "waitforsetup" : "Aguarde a conclusão da instalação ... !",
        "machineisinstalling" : "Seu servidor está sendo configurado ",
        "dontclose" : "Por favor, não feche esta janela e espere a instalação terminar ... !",
        "willtake" : "Isso levará alguns minutos",
        "goingtoinstall" : "Você está presta a instalar",
        "onyourmachine" : "em seu servidor !",
        "installationalert" : "IMPORTANTE: Através da instalação, você perderá permanentemente todos os seus dados.",
        "destroyalert" : "Ao destruir, você perderá permanentemente todos os seus dados.",
        "clearandinstall" : "Limpar e Instalar",
        "alert" : "Aleta",
        "installing" : "Instalando",

        "installedsuccessfully" : "instalado com sucesso! !",
        "accountinformation" : "Aqui estão as informações da sua conta:",
        "lastaction" : "Ultima Ação : ",
        "close" : "Fechar",
        "thiscommand" : "Este comando pode demorar um pouco. Por favor, seja paciente",

        "goingto" : "Você está indo para ",
        "yourmachine" : " seu servidor!",
        "requestgetlink" : "Você solicita um link para seu console.",
        "yourcommand" : "Seu comando, ",
        "hasdonesuccessfully" : "foi concluído com sucesso!",
        "accessconsole" : "Você pode acessar seu console através do seguinte link.",
        "openconsole" : "Abrir Console",

        "confirmtext" : "Você tem certeza disso ?",
        "currentaction" : "Ação Atual: ",
        
        "chooselanguage" : "Escolher Linguagem",
        "english" : "Português Brasil",
        "farsi" : "Farsi",
        "turkish" : "Turkish",
        "french" : "French",
        "deutsch" : "Deutsch",
        "russian" : "Russian", 
        
        "setlanguage" : "Escolher Linguagem",
        "traffics" : "Informação de Tráfego",
        "buytraffics" : "Comprar",
        "tabeltraffic" : "Tráfego: ",
        "traffictype" : "Tipo: ",
        "trafficusage" : "Tráfego Usado: ",
        "trafficdate" : "Ponto de Partida: ",
        "main" : "Principal",
        "plus" : "Extra",
        
        "actionstatuscompleted" : "Concluído",
        "actionstatuspending" : "Pendente",
        "actionstatusprocessing" : "Processando",

        "fetchingalert" : "Buscando informações",
        "nothingeheader" : "Oops!",
        "nothingtoseetext" : "Não recebemos nenhuma informação do servidor, não há nada para mostrar!",
        "software" : "Instalar Software",
        "install" : "Instalar",
        "consolefailed" : "Há um problema com o link do console, tente novamente ou entre em contato com o suporte.",
        'failed' : 'Falhou',
        "consoleisrunningalery" : "O sistema está em execução para preparar o link do console. Pode demorar menos de um minuto.",
        "tryagain" : "Tentar novamente",
        "sshkeytitle" : "SSH Key : ",
        "suspend" : "Suspenso",
        "unsuspend" : "Unsuspend",
        "refresh" : "Atualizar",
        "trafficplan" : "Pacote de Dados",
        "remainingtraffic" : "Tráfego Restante : ",
        "trafficduration" : "Duração :",
        "remainingtime" : "Tempo Restante :",
        "failactionmsg" : "A ação mais recente não foi concluída completamente, o status ainda falhou, tente uma nova ação!",
        "snapshot" : "Snapshot",
        "free" : "Free",
        "gotopanel": "Ir para o Painel de Controle",
        "machinestatus": "Status da Máquina: ",
        "renewaldate": "Data de Renovação: ",
        "renewedon": "Renovado em: ",
        "pendingaction": "Ação Pendente",
        "machineisdoingnothing": "Nenhuma ação",
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
