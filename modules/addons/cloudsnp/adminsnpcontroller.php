<?php
use PG\Request\Request;
use WHMCS\Database\Capsule;

class AdminSnpController
{
    protected $WhUserId;
    protected $userToken;
    protected $ResellerBackendUrl;
    protected $ResellerToken;

    public function __construct($WhUserId, $userToken, $ResellerBackendUrl, $ResellerToken){
        $this->WhUserId = $WhUserId;
        $this->userToken = $userToken;
        $this->ResellerBackendUrl = $ResellerBackendUrl;
        $this->ResellerToken = $ResellerToken;
    }

    public function admin_getUseIdByToken(){
        $userToken = $this->userToken;

        $params = [
            'token' => $userToken,
        ];
        
        $ResellerBackendUrl = $this->ResellerBackendUrl;
        $address = [
            $ResellerBackendUrl, 'candy', 'frontend', 'auth', 'token', 'login'
        ];
        
        $response = Request::instance()->setAddress($address)->setParams($params)->getResponse()->asObject();
        return $response->data->id;
    }

    function admin_autovm_get_config_cloud(){
        $response = [];
        $requiredKeys = [
            'AutovmDefaultCurrencyID' => null,
            'AutovmDefaultCurrencySymbol' => null,
            'PlaceCurrencySymbol' => null,
            'ShowExchange' => null,
            'ChargeModuleEnable' => null,
            'ConsoleRoute' => null,
            'TopupLink' => null,
            'AdminUserSummeryPagePath' => null,
            'minimumChargeInAutovmCurrency' => null,
            'DefaultMonthlyDecimal' => null,
            'DefaultHourlyDecimal' => null,
            'DefaultBalanceDecimalWhmcs' => null,
            'DefaultBalanceDecimalCloud' => null,
            'DefaultChargeAmountDecimalWhmcs' => null,
            'DefaultChargeAmountDecimalCloud' => null,
            'DefaultCreditDecimalWhmcs' => null,
            'DefaultCreditDecimalCloud' => null,
            'DefaultMinimumDecimalWhmcs' => null,
            'DefaultMinimumDecimalCloud' => null,
            'DefaultRatioDecimal' => null,
        ];
    
        try {
            $moduleparams = Capsule::table('tbladdonmodules')->get();
            foreach ($moduleparams as $item) {
                if($item->module == 'cloudsnp'){
                    foreach ($requiredKeys as $key => $value) {
                        if ($item->setting == $key) {
                            if(!empty($item->value)){
                                $requiredKeys[$key] = $item->value;
                            } else {
                                $response['message'] = "$key has no value";
                                return $response;
                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            $error = 'Cloud Config ERR ===> Can not find module params table in database';
            $response['error'] = $error;
            return $response;
        }
    
        foreach ($requiredKeys as $key => $value){
            if(isset($requiredKeys[$key])){
                $response[$key] = $value;
            } 
        }
        
        return $response;
    }

    public function readDecimals($option)
    {
        switch($option){
            case "option1":
                return 0;
            case "option2":
                return 1;
            case "option3":
                return 2;
            default:
                return 0;
        }
    }

    public function admin_getModuleConfig(){
        $response = $this->admin_getModuleConfigReguest();
        $this->response($response);
    }
    
    public function admin_getModuleConfigReguest(){        
        $response =  $this->admin_autovm_get_config_cloud();
        
        if(!empty($response['error'])){
            return $response;
        }

        if(!empty($response['message'])){
            return $response;
        }
        
        $requiredKeys = [
            'AutovmDefaultCurrencyID',
            'AutovmDefaultCurrencySymbol',
            'PlaceCurrencySymbol',
            'ShowExchange',
            'ChargeModuleEnable',
            'ConsoleRoute',
            'TopupLink',
            'AdminUserSummeryPagePath',
            'minimumChargeInAutovmCurrency',
            'DefaultMonthlyDecimal',
            'DefaultHourlyDecimal',
            'DefaultBalanceDecimalWhmcs',
            'DefaultBalanceDecimalCloud',
            'DefaultChargeAmountDecimalWhmcs',
            'DefaultChargeAmountDecimalCloud',
            'DefaultCreditDecimalWhmcs',
            'DefaultCreditDecimalCloud',
            'DefaultMinimumDecimalWhmcs',
            'DefaultMinimumDecimalCloud',
            'DefaultRatioDecimal'
        ];
        
        $config = [];
        
        foreach ($requiredKeys as $key) {
            if (isset($response[$key])) {
                if ($key == 'DefaultMonthlyDecimal' || $key == 'DefaultHourlyDecimal' || $key == 'DefaultBalanceDecimalWhmcs' || $key == 'DefaultBalanceDecimalCloud' || $key == 'DefaultChargeAmountDecimalWhmcs' || $key == 'DefaultChargeAmountDecimalCloud' || $key == 'DefaultCreditDecimalWhmcs' || $key == 'DefaultCreditDecimalCloud' || $key == 'DefaultMinimumDecimalWhmcs' || $key == 'DefaultMinimumDecimalCloud' || $key == 'DefaultRatioDecimal') {
                    $config[$key] = $this->readDecimals($response[$key]);
                } else if($key == 'ShowExchange'){
                    if($response['ShowExchange'] == 'option1'){
                        $config[$key] = 'on';
                    } else {
                        $config[$key] = 'off';
                    }
                } else if($key == 'ChargeModuleEnable'){
                    if($response['ChargeModuleEnable'] == 'option1'){
                        $config[$key] = 'on';
                    } else {
                        $config[$key] = 'off';
                    }
                } else if($key == 'PlaceCurrencySymbol'){
                    if($response['PlaceCurrencySymbol'] == 'option1'){
                        $config[$key] = 'code';
                    } else if($response['PlaceCurrencySymbol'] == 'option2'){
                        $config[$key] = 'suffix';
                    } else {
                        $config[$key] = 'prefix';
                    }
                } else {
                    $config[$key] = $response[$key];                
                }
            } else {
                $text = "$key is lost";
                $response = array("error" => $text);
                return $response;
            }
        }
        $response = $config; 
        return $response;
    }
    
    public function admin_ShowUser(){
        $response = $this->admin_sendShowUserRequest();
        $this->response($response);
    }
        
    public function admin_sendShowUserRequest(){        
        $userToken = $this->userToken;

        $params = [
            'token' => $userToken,
        ];
        
        $ResellerBackendUrl = $this->ResellerBackendUrl;
        $address = [
            $ResellerBackendUrl, 'candy', 'frontend', 'auth', 'token', 'login'
        ];
        
        $response = Request::instance()->setAddress($address)->setParams($params)->getResponse()->asObject();
        return $response;
    }
    
    public function admin_chargeCloud(){        
        $requestData = json_decode(file_get_contents("php://input"), true);

        if($requestData['chargeamount']){
            $chargeamount = $requestData['chargeamount'];
        } else {
            echo 'can not access charge amount in admin panel';
        }
    
        $response = $this->admin_sendChargeCloudRequest($chargeamount);
        $this->response($response);
    }
    
    public function admin_sendChargeCloudRequest($chargeamount){
        $AutovmUserId = $this->admin_getUseIdByToken();
        
        $params = [
            'amount' => $chargeamount,
            'type' => 'balance',
            'status' => 'paid'
        ];
        
        $ResellerToken = $this->ResellerToken;
        $headers = ['token' => $ResellerToken];
        
        $ResellerBackendUrl = $this->ResellerBackendUrl;
        $address = [
            $ResellerBackendUrl , 'admin', 'reseller', 'user', 'balance', $AutovmUserId
        ];
        return Request::instance()->setAddress($address)->setHeaders($headers)->setParams($params)->getResponse()->asObject();
    }

    public function admin_LoadCredit()
    {
        $WhUserId = $this->WhUserId;
        $command = 'GetClientsDetails';
        $postData = array(
            'clientid' => $WhUserId,
            'stats' => true,
        );
        
        $results = localAPI($command, $postData);

        if($results['result'] == "success"){
            $credit = $results['credit'];
            $currency = $results['currency_code'];
            $userCurrencyId = $results['currency'];
            $response = array(
                'credit' => $credit,
                'currency' => $currency,
                'userCurrencyId' => $userCurrencyId,
            );
            $this->response($response); 
        } else {
            $this->response(null);
        } 
    }

    public function admin_GetCurrenciesList()
    {
        $command = 'GetCurrencies';
        $postData = array(
        );

        $results = localAPI($command, $postData);
        $this->response($results); 
    }

    public function response($response)
    {
        header('Content-Type: application/json');

        $response = json_encode($response);

        exit($response);
    }

    public function handle($action)
    {
        $class = new ReflectionClass($this);

        $method = $class->getMethod($action);

        if ($method) {
            return $method->invoke($this);
        }
    }
}
