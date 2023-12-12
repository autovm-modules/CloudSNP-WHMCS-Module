let messages = {
    'Are you sure about this?': 'Are you sure about this?'
}

let errors = {
    'Something is in queue.': 'Something is in queue.'
}

let common = {
    
// Machine view
        
    // from product
    "backtoservices": "Вернуться к услугам",
    "mb": "MB",
    "gb": "GB",
    "core": "Ядро",
    "hostname": "Имя хоста: ",
    "pending": "Ожидание",
    "processing": "Обработка",
    "active": "Активный",
    "passive": "Пассивный",
    "online": "В сети",
    "offline": "Не в сети",
    "memory": "ПАМЯТЬ",
    "disk": "ДИСК",
    "cpu": "ЦПУ",
    "template": "ШАБЛОН",
    "uptime": "ВРЕМЯ РАБОТЫ",
    "and": " и ",
    "days": "День",
    "hours": "Час",
    "minutes": "Минуты",
    "finance": "Финансы",
    "servicesname": "Название услуги",
    "registrationdate": "Дата регистрации:",
    "nextpayment": "Следующий платеж:",
    "billingcycle": "Цикл оплаты:",
    "networkinformation": "Сетевая информация",
    "ipaddress": "IP-адрес:",
    "networkstatus": "Состояние сети:",
    "connected": "Подключено",
    "disconnected": "Отключено",
    "login": "Вход",
    "username": "Имя пользователя",
    "password": "Пароль",
    "rebootaction": "Перезагрузка",
    "stopaction": "Остановить",
    "consoleaction": "Консоль",
    "startaction": "Запустить",
    
    "rebooting": "Перезагрузка ...!",
    "stoping": "Остановка ...!",
    "consoleing": "Поиск консоли ...!",
    "starting": "Запуск ...!",
    
    "access": "Доступ",
    "accesstext": "Здесь представлена информация и инструменты для управления вашей виртуальной машиной.",
    "changeos": "Сменить ОС",
    "network": "Сеть",
    "upgrades": "Обновления",
    
    "events": "События",
    "statistics": "Статистика",
    "sshkey": "SSH-ключ",
    "status": "Статус",
    "beginingat": "Начало в",
    "endingat": "Окончание в",
    "completed": "Завершено",
    
    "canceled": "Отменено",
    "loadingmsg": "Загрузка",
    "loadingmsglong": "Попытка получения данных с сервера может занять несколько секунд.",
    "iplists": "Список IP-адресов",
    "gateway": "Шлюз",
    "netmask": "Маска подсети",
    "orderip": "Заказать IP-адрес",
    
    "currentkey": "Текущий ключ: ",
    "upgradecloud": "Обновить облачный сервер",
    "setup": "Установка",
    "waittofetch": "Пожалуйста, подождите, это может занять несколько секунд, чтобы получить все данные... !",
    "lastactionpending": "Ваше последнее действие все еще ожидается... !",
    
    "waitforsetup": "Пожалуйста, дождитесь завершения настройки... !",
    "machineisinstalling": "Ваша машина устанавливается",
    "dontclose": "Пожалуйста, не закрывайте это окно и дождитесь завершения настройки... !",
    "willtake": "Это займет несколько минут",
    "goingtoinstall": "Вы собираетесь установить",
    "onyourmachine": "на вашей машине!",
    "installationalert": "Во время установки вы навсегда потеряете все свои данные.",
    "destroyalert": "Уничтожая, вы навсегда потеряете все ваши данные.",
    "clearandinstall": "Очистить и установить",
    "alert": "Предупреждение",
    "installing": "Установка",
    
    "installedsuccessfully": "успешно установлено!",
    "accountinformation": "Вот информация о вашей учетной записи:",
    "lastaction": "Последнее действие: ",
    "close": "Закрыть",
    "thiscommand": "Эта команда может занять некоторое время. Пожалуйста, будьте терпеливы",
    
    "goingto": "Вы собираетесь ",
    "yourmachine": " вашу машину!",
    "requestgetlink": "Вы запросили получение ссылки в вашей консоли.",
    "yourcommand": "Ваша команда, ",
    "hasdonesuccessfully": "успешно выполнена",
    "accessconsole": "Вы можете получить доступ к консоли по следующей ссылке",
    "openconsole": "Открыть консоль",
    
    "confirmtext": "Вы уверены в этом?",
    "currentaction": "Текущее действие: ",
    
    "chooselanguage": "Выберите язык",
    "english": "Английский",
    "farsi": "Фарси",
    "turkish": "Турецкий",
    "french": "Французский",
    "deutsch": "Немецкий",
    "russian": "Русский",
    
    "setlanguage": "Установить язык",
    "traffics": "Информация о трафике",
    "buytraffics": "Покупка",
    "tabeltraffic": "Трафик: ",
    "traffictype": "Тип: ",
    "trafficusage": "Использование трафика: ",
    "trafficdate": "Начальная точка: ",
    "main": "Основной",
    "plus": "Дополнительный",
    
    "actionstatuscompleted": "Завершено",
    "actionstatuspending": "Ожидание",
    "actionstatusprocessing": "Обработка",
    
    "fetchingalert": "Получение информации",
    "nothingeheader": "Упс!",
    "nothingtoseetext": "Мы не получили никакой информации с сервера, здесь нечего показать!",
    "software": "Установка программного обеспечения",
    "install": "Установить",
    "consolefailed": "Проблема с ссылкой на консоль, пожалуйста, попробуйте еще раз",
    'failed' : 'Неуспешный',
    "consoleisrunningalery": "Система работает для подготовки ссылки на консоль. Это может занять менее минуты.",
    "tryagain": "Попробовать снова",
    "sshkeytitle": "SSH-ключ: ",
    "suspend" : "приостановить",
    "unsuspend" : "возобновить",
    "refresh" : "Обновить",
    "trafficplan" : "План трафика",
    "remainingtraffic" : "Оставшийся трафик : ",
    "trafficduration" : "Продолжительность :",
    "remainingtime" : "Оставшееся время :",
    "failactionmsg" : "Последнее действие не было выполнено полностью, статус все еще неудачный. Пожалуйста, попробуйте новое действие!",
    "snapshot" : "Snapshot",
    "free" : "Free",
    "gotopanel" : "Перейти в панель управления",
    "machinestatus" : "Machine status: ",
    "renewaldate" : "Дата продления : ",
    "renewedon" : "Продлен : ",
    "pendingaction" : "Pending Action",
    "machineisdoingnothing" : "No action",
    "accountinformationtitle" : "Account Information",
        "installedsoftware" : "SOFTWARE",
        "traffic" : "TRAFFIC",
// end from Product

// Unique for this cloud
    "todeleteyourmachine": "Для удаления вашей машины вы должны написать",
    "writedestroy" : "'destroy'",
    "intheboxbelow": "в поле ниже и подождать несколько секунд",
    "typehere": "Введите здесь слово:",
    "failedmessage": "Проблема с получением данных с сервера, статус действия все еще не удалось выполнить!",
    "error": "Ошибка",
    "trafficprice": "Стоимость: ",
    "costperhour": "Стоимость за час : ",
    "cent": "ц",
    "$": "$",
    "setupaction": "Настройка",
    "destroying": "Уничтожение ...!",
    "destroyaction": "Уничтожить",
    "fetching": "Получение данных",
    "payasyougo" : "Плати как сможешь",
// End Unique for this cloud

// end Machine View




}

const words = {
    ...messages,
    ...common,
    ...errors
}
