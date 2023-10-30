<?php
use PG\Request\Request;

class AdminController
{
    protected $userToken;
    protected $WhUserId;

    public function __construct($userToken, $WhUserId){
        $this->userToken = $userToken;
        $this->WhUserId = $WhUserId;
    }

    public function admin_getUseIdByToken(){
        $userToken = $this->userToken;

        $params = [
            'token' => $userToken,
        ];

        $headers = ['token' => AUTOVM_Reseller_TOKEN];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'auth', 'token', 'login'
        ];
        
        $response = Request::instance()->setAddress($address)->setHeaders($headers)->setParams($params)->getResponse()->asObject();
        return $response->data->id;
    }

    public function admin_ShowUser(){
        $response = $this->admin_sendShowUserRequest();
        $this->response($response);
    }
        
    public function admin_sendShowUserRequest(){
        $AutovmUserId = $this->admin_getUseIdByToken();
        
        $headers = ['token' => AUTOVM_Reseller_TOKEN];
        $address = [
            AUTOVM_BASE, 'candy', 'backend', 'user', 'show', $AutovmUserId
        ];
        return Request::instance()->setAddress($address)->setHeaders($headers)->setParams($params)->getResponse()->asObject();
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
            'userId' => $AutovmUserId,
            'amount' => $chargeamount,
            'type' => 'balance',
            'status' => 'paid'
        ];

        $headers = ['token' => AUTOVM_Reseller_TOKEN];

        $address = [
            AUTOVM_BASE, 'candy', 'backend', 'trans', 'create'
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
