<?php

use WHMCS\Database\Capsule;
use PG\Request\Request;

class CloudController
{
    protected $clientId;

    public function __construct($clientId)
    {
        $this->clientId = $clientId;
    }

    public function pageIndex()
    {
        return ['templatefile' => 'views/index'];
    }

    public function pageMachines()
    {
        return ['templatefile' => 'views/machines'];
    }

    public function pageMachine()
    {
        return ['templatefile' => 'views/machine'];
    }

    public function pageCreate()
    {
        return ['templatefile' => 'views/create'];
    }

    public function login()
    {
        $token = $this->getUserTokenFromClientId();

        $response = $this->sendLoginRequest($token);

        $this->response($response);
    }

    public function sendLoginRequest($token)
    {
        $params = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'auth', 'token', 'login'
        ];

        return Request::instance()->setAddress($address)->setParams($params)->getResponse()->asObject();
    }

    public function machines()
    {
        $token = $this->getUserTokenFromClientId();

        // Send request
        $response = $this->sendMachinesRequest($token);

        $this->response($response);
    }

    public function sendMachinesRequest($token)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'machine', 'index'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function machine()
    {
        $id = autovm_get_query('id');

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendMachineRequest($token, $id);

        $this->response($response);
    }

    public function sendMachineRequest($token, $id)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'machine', 'show', $id
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function detail()
    {
        $id = autovm_get_query('id');

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendDetailRequest($token, $id);

        $this->response($response);
    }

    public function sendDetailRequest($token, $id)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'machine', 'detail', $id
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function create()
    {
        $params = autovm_get_post_array(['productId', 'templateId', 'publicKey', 'name']);

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendCreateRequest($token, $params);

        $this->response($response);
    }

    public function sendCreateRequest($token, $params)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'machine', 'create'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->setParams($params)->getResponse()->asObject();
    }

    public function setup()
    {
        $id = autovm_get_query('id');

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendSetupRequest($token, $id);

        $this->response($response);
    }

    public function sendSetupRequest($token, $id)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'machine', 'setup', $id
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function change()
    {
        $id = autovm_get_query('id');

        $params = autovm_get_post_array(['templateId']);

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendChangeRequest($token, $id, $params);

        $this->response($response);
    }

    public function sendChangeRequest($token, $id, $params)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'machine', 'change', $id
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->setParams($params)->getResponse()->asObject();
    }

    public function start()
    {
        $id = autovm_get_query('id');

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendStartRequest($token, $id);

        $this->response($response);
    }

    public function sendStartRequest($token, $id)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'machine', 'start', $id
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function stop()
    {
        $id = autovm_get_query('id');

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendStopRequest($token, $id);

        $this->response($response);
    }

    public function sendStopRequest($token, $id)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'machine', 'stop', $id
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function reboot()
    {
        $id = autovm_get_query('id');

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendRebootRequest($token, $id);

        $this->response($response);
    }

    public function sendRebootRequest($token, $id)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'machine', 'reboot', $id
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function snapshot()
    {
        $id = autovm_get_query('id');

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendSnapshotRequest($token, $id);

        $this->response($response);
    }

    public function sendSnapshotRequest($token, $id)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'machine', 'snapshot', $id
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function revert()
    {
        $id = autovm_get_query('id');

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendRevertRequest($token, $id);

        $this->response($response);
    }

    public function sendRevertRequest($token, $id)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'machine', 'revert', $id
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function console()
    {
        $id = autovm_get_query('id');

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendConsoleRequest($token, $id);

        $this->response($response);
    }

    public function sendConsoleRequest($token, $id)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'machine', 'console', $id
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function destroy()
    {
        $id = autovm_get_query('id');

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendDestroyRequest($token, $id);

        $this->response($response);
    }

    public function sendDestroyRequest($token, $id)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'machine', 'destroy', $id
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function expenses()
    {
        $id = autovm_get_query('id');

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendExpensesRequest($token, $id);

        $this->response($response);
    }

    public function sendExpensesRequest($token, $id)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'graph', 'machine', 'expenses', $id
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function currentTrafficUsage()
    {
        $id = autovm_get_query('id');

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendCurrentTrafficUsageRequest($token, $id);

        $this->response($response);
    }

    public function sendCurrentTrafficUsageRequest($token, $id)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'graph', 'machine', $id, 'traffic', 'current'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function memoryUsage()
    {
        $id = autovm_get_query('id');

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendMemoryUsageRequest($token, $id);

        $this->response($response);
    }

    public function sendMemoryUsageRequest($token, $id)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'graph', 'machine', $id, 'memory', 'daily'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function cpuUsage()
    {
        $id = autovm_get_query('id');

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendCpuUsageRequest($token, $id);

        $this->response($response);
    }

    public function sendCpuUsageRequest($token, $id)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'graph', 'machine', $id, 'cpu', 'daily'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function bandwidthUsage()
    {
        $id = autovm_get_query('id');

        $token = $this->getUserTokenFromClientId();

        $response = $this->sendBandwidthUsageRequest($token, $id);

        $this->response($response);
    }

    public function sendBandwidthUsageRequest($token, $id)
    {
        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'graph', 'machine', $id, 'bandwidth', 'current'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function regions()
    {
        $response = $this->sendRegionsRequest();

        $this->response($response);
    }

    public function sendRegionsRequest()
    {
        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'common', 'regions'
        ];

        return Request::instance()->setAddress($address)->getResponse()->asObject();
    }

    public function products()
    {
        $regionId = autovm_get_query('id');

        $response = $this->sendProductsRequest($regionId);

        $this->response($response);
    }

    public function sendProductsRequest($regionId)
    {
        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'common', 'products', $regionId
        ];

        return Request::instance()->setAddress($address)->getResponse()->asObject();
    }

    public function templates()
    {
        $response = $this->sendTemplatesRequest();

        $this->response($response);
    }

    public function sendTemplatesRequest()
    {
        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'common', 'templates'
        ];

        return Request::instance()->setAddress($address)->getResponse()->asObject();
    }

    public function categories()
    {
        $response = $this->sendCategoriesRequest();

        $this->response($response);
    }

    public function sendCategoriesRequest()
    {
        $address = [
            AUTOVM_BASE, 'candy', 'frontend', 'common', 'template', 'categories'
        ];

        return Request::instance()->setAddress($address)->getResponse()->asObject();
    }

    public function getUserTokenFromClientId()
    {
        $params = [
            'userId' => $this->clientId
        ];

        $user = Capsule::selectOne('SELECT token FROM autovm_user WHERE user_id = :userId', $params);

        // The first value
        if ($user) {
            return current($user);
        }

        return $user;
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

    // Get User Credit Info
    public function loadCredit()
    {
        $userId = $this->clientId;
        $command = 'GetClientsDetails';
        $postData = array(
            'clientid' => $userId,
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

    // Create Unpaid Invoice
    public function CreateUnpaidInvoice()
    {
        $requestData = json_decode(file_get_contents("php://input"), true);
        if($requestData['chargeamount']){
            $chargeamount = $requestData['chargeamount'];
        } else {
            echo 'can not access charge amount (E01-Create Invoice)';
        }

        $userId = $this->clientId;
        $currentDateTime = date('Y-m-d');
        $nextDay = date('Y-m-d', strtotime($currentDateTime . ' +1 day'));
        
        if(isset($chargeamount) && isset($userId)){
            $command = 'CreateInvoice';
            $postData = array(
                'userid' => $userId,
                'taxrate' => '0',
                'date' => $currentDateTime,
                'duedate' => $nextDay,
                'itemdescription1' => 'Charge Cloud Account',
                'itemamount1' => $chargeamount,
                'itemtaxed1' => '0',
                'notes' => 'This is an auto created invoice. If it has yet been unpaid, you should check it with Client Cloud Account and if Transaction has down successfully, then force customer to pay this invoice',
                'autoapplycredit' => '0',
            );
            $results = localAPI($command, $postData);
            $this->response($results); 
        } 
    }

    // Mark Cancel invoice
    public function markCancelInvoice()
    {
        $requestData = json_decode(file_get_contents("php://input"), true);
        if($requestData['invoiceid']){
            $invoiceid = $requestData['invoiceid'];
        } else {
            echo 'Can not access Invoice Id (E02-Mark Cancel)';
        }

        $userId = $this->clientId;
        $currentDateTime = date('Y-m-d');

        $command = 'UpdateInvoice';
            $postData = array(
                'invoiceid' => $invoiceid,
                'status' => 'Cancelled',
                'date' => $currentDateTime,
                'notes' => 'This invoice created automatically to charge Cloud Balance, but we have error in Autovm Api request, so this invoice cancelled automatically, it means that the cloud balance did not charged',
            );
            $results = localAPI($command, $postData);
            $this->response($results); 
    }

    // ChargeCloud
    public function chargeCloud()
    {
        $requestData = json_decode(file_get_contents("php://input"), true);

        if($requestData['id']){
            $userId = $requestData['id'];
        } else {
            echo 'can not access user id (E03-Charge Cloud)';
        }
        
        if($requestData['chargeamount']){
            $chargeamount = $requestData['chargeamount'];
        } else {
            echo 'can not access charge amount (E03-Charge Cloud)';
        }

        $token = AUTOVM_ADMIN_TOKEN ;
    
        $response = $this->sendChargeCloudRequest($token, $userId, $chargeamount);
        $this->response($response);
    }
    
    // sendChargeCloudRequest
    public function sendChargeCloudRequest($token, $userId, $amount)
    {
        $params = [
            'userId' => $userId,
            'amount' => $amount,
            'type' => 'balance',
            'status' => 'paid'
        ];

        $headers = ['token' => $token];

        $address = [
            AUTOVM_BASE, 'candy', 'backend', 'trans', 'create'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->setParams($params)->getResponse()->asObject();
    }

    // Create Unpaid Invoice
    public function applyTheCredit()
    {
        $requestData = json_decode(file_get_contents("php://input"), true);
        if($requestData['invoiceid']){
            $invoiceid = $requestData['invoiceid'];
        } else {
            echo 'can not access user id (E04-Apply Credit)';
        }
        
        if($requestData['chargeamount']){
            $chargeamount = $requestData['chargeamount'];
        } else {
            echo 'can not access charge amount (E04-Apply Credit)';
        }

        if(isset($chargeamount) && isset($invoiceid)){
            $command = 'ApplyCredit';
            $postData = array(
                'invoiceid' => $invoiceid,
                'amount' => $chargeamount,
            );

            $results = localAPI($command, $postData);
            $this->response($results); 
        } 
    }  
    
    // Test Get Currencies
    public function getAllCurrencies()
    {
        $command = 'GetCurrencies';
        $postData = array(
        );

        $results = localAPI($command, $postData);
        $this->response($results); 

    }

}