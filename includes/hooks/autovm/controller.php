<?php

use WHMCS\Database\Capsule;
use PG\Request\Request;

class AVMController
{
    protected $serviceId;
    protected $BackendUrl;
    protected $AdminToken;
    protected $ConsoleRoute;

    public function __construct($serviceId)
    {
        $response =  autovm_get_admintoken_baseurl_client();
        if(!empty($response['error'])){
            echo($response['error']);
            return false;
        }

        if(!empty($response['message'])){
            echo($response['message']);
            return false;
        }
        
        if(isset($response['AdminToken']) && isset($response['BackendUrl']) && isset($response['ConsoleRoute'])){
            $AdminToken = $response['AdminToken'];
            $BackendUrl = $response['BackendUrl'];
            $ConsoleRoute = $response['ConsoleRoute'];
        } 
        
        $this->serviceId = $serviceId;
        $this->BackendUrl = $BackendUrl;
        $this->AdminToken = $AdminToken;
        $this->ConsoleRoute = $ConsoleRoute;
    }

    public function getConsoleRoute()
    {      
        $ConsoleRoute = $this->ConsoleRoute;

        if(empty($ConsoleRoute)){
            $ConsoleRoute = 'can not get console route in controller';
        }

        $this->response($ConsoleRoute); 
    }

    public function sendPoolsRequest()
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'common', 'pools'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function softwares()
    {
        $response = $this->sendSoftwaresRequest();

        $this->response($response);
    }

    public function sendSoftwaresRequest()
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'frontend', 'common', 'software', 'categories'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function categories()
    {
        $response = $this->sendCategoriesRequest();

        $this->response($response);
    }

    public function sendCategoriesRequest()
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'frontend', 'common', 'template', 'categories'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function templates()
    {
        $response = $this->sendTemplatesRequest();

        $this->response($response);
    }

    public function sendTemplatesRequest()
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'frontend', 'common', 'templates'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function sendCreateRequest($poolId, $templateId, $memorySize, $memoryLimit, $diskSize, $cpuCore, $cpuLimit, $name, $email, $publicKey, $traffic, $remaining, $duration, $ipv4, $ipv6)
    {
        $params = [
            'poolId' => $poolId, 'templateId' => $templateId, 'memorySize' => $memorySize, 'memoryLimit' => $memoryLimit, 'diskSize' => $diskSize, 'cpuCore' => $cpuCore, 'cpuLimit' => $cpuLimit, 'name' => $name, 'email' => $email, 'publicKey' => $publicKey, 'traffic' => $traffic, 'remaining' => $remaining, 'duration' => $duration, 'autoSetup' => true, 'ipv4' => $ipv4, 'ipv6' => $ipv6, 
        ];

        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'smart', 'pool'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->setParams($params)->getResponse()->asObject();
    }

    public function show()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendShowRequest($machineId);

        $this->response($response);
    }

    public function sendShowRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'show', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function detail()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendDetailRequest($machineId);

        $this->response($response);
    }

    public function sendDetailRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'detail', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function sendTrafficRequest($machineId, $traffic, $remaining, $duration, $type)
    {
        $params = [
            'traffic' => $traffic, 'remaining' => $remaining, 'duration' => $duration, 'type' => $type
        ];

        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'traffic', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->setParams($params)->getResponse()->asObject();
    }

    public function setup()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendSetupRequest($machineId);

        $this->response($response);
    }

    public function sendSetupRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'setup', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function start()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendStartRequest($machineId);

        $this->response($response);
    }

    public function sendStartRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'start', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function stop()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendStopRequest($machineId);

        $this->response($response);
    }

    public function sendStopRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'stop', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function reboot()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendRebootRequest($machineId);

        $this->response($response);
    }

    public function sendRebootRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'reboot', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function sendSuspendRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'suspend', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function sendForceSuspendRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'forceSuspend', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function sendUnsuspendRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'unsuspend', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function sendForceUnsuspendRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'forceUnsuspend', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }
    
    public function snapshot()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendSnapshotRequest($machineId);

        $this->response($response);
    }

    public function sendSnapshotRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'snapshot', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function revert()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendRevertRequest($machineId);

        $this->response($response);
    }

    public function sendRevertRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'revert', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function console()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendConsoleRequest($machineId);

        $this->response($response);
    }

    public function sendConsoleRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'console', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function sendDestroyRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'destroy', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function sendForceDestroyRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'forceDestroy', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function change()
    {
        $machineId = $this->getMachineIdFromService();

        // Find the template identity
        $templateId = autovm_get_query('avmTemplateId');

        // Send request
        $response = $this->sendChangeRequest($machineId, $templateId);

        $this->response($response);
    }

    public function sendChangeRequest($machineId, $templateId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'change', $machineId
        ];

        $params = ['templateId' => $templateId];

        return Request::instance()->setAddress($address)->setHeaders($headers)->setParams($params)->getResponse()->asObject();
    }

    public function currentTrafficUsage()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendCurrentTrafficUsageRequest($machineId);

        $this->response($response);
    }

    public function sendCurrentTrafficUsageRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'graph', 'machine', $machineId, 'traffic', 'current'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function memoryUsage()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendMemoryUsageRequest($machineId);

        $this->response($response);
    }

    public function sendMemoryUsageRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'graph', 'machine', $machineId, 'memory', 'daily'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function cpuUsage()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendCpuUsageRequest($machineId);

        $this->response($response);
    }

    public function sendCpuUsageRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'graph', 'machine', $machineId, 'cpu', 'daily'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function trafficUsage()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendTrafficUsageRequest($machineId);

        $this->response($response);
    }

    public function sendTrafficUsageRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'graph', 'machine', $machineId, 'traffic', 'daily'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function bandwidthUsage()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendBandwidthUsageRequest($machineId);

        $this->response($response);
    }

    public function sendBandwidthUsageRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'graph', 'machine', $machineId, 'bandwidth', 'daily'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function hourlyMemoryUsage()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendHourlyMemoryUsageRequest($machineId);

        $this->response($response);
    }

    public function sendHourlyMemoryUsageRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'graph', 'machine', $machineId, 'memory', 'hourly'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function hourlyCpuUsage()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendHourlyCpuUsageRequest($machineId);

        $this->response($response);
    }

    public function sendHourlyCpuUsageRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'graph', 'machine', $machineId, 'cpu', 'hourly'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function currentBandwidthUsage()
    {
        $machineId = $this->getMachineIdFromService();

        // Send request
        $response = $this->sendCurrentBandwidthUsageRequest($machineId);

        $this->response($response);
    }

    public function sendCurrentBandwidthUsageRequest($machineId)
    {
        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'graph', 'machine', $machineId, 'bandwidth', 'current'
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->getResponse()->asObject();
    }

    public function sendUpgradeRequest($machineId, $memorySize, $memoryLimit, $diskSize, $cpuCore, $cpuLimit)
    {
        $params = [
            'memorySize' => $memorySize, 'memoryLimit' => $memoryLimit, 'diskSize' => $diskSize, 'cpuCore' => $cpuCore, 'cpuLimit' => $cpuLimit, 'reboot' => 'active'
        ];

        $AdminToken = $this->AdminToken;
        $headers = ['token' => $AdminToken];

        $BackendUrl = $this->BackendUrl;
        $address = [
            $BackendUrl, 'candy', 'backend', 'machine', 'upgrade', $machineId
        ];

        return Request::instance()->setAddress($address)->setHeaders($headers)->setParams($params)->getResponse()->asObject();
    }

    public function response($response)
    {
        header('Content-Type: application/json');

        $response = json_encode($response);

        exit($response);
    }

    public function getServiceSuspended()
    {
        $params = [
            'serviceId' => $this->serviceId
        ];

$query = <<<EOT

SELECT a.domainstatus FROM tblhosting a
    WHERE a.id = :serviceId
        AND a.domainstatus IN ('Suspended')

EOT;

        $suspended = Capsule::selectOne($query, $params);

        // The first value
        if ($suspended) {
            return current($suspended);
        }

        return $suspended;
    }

    public function getServiceRemaining()
    {
        $params = [
            'serviceId' => $this->serviceId
        ];

$query = <<<EOT

SELECT TIMESTAMPDIFF(DAY, DATE(CURRENT_TIMESTAMP), a.nextinvoicedate) as days FROM tblhosting a
    WHERE a.id = :serviceId
        HAVING days >= 1

EOT;

        $remaining = Capsule::selectOne($query, $params);

        // The first value
        if ($remaining) {
            return current($remaining);
        }

        return $remaining;
    }

    public function getServiceDuration()
    {
        $params = [
            'serviceId' => $this->serviceId
        ];

$query = <<<EOT

SELECT ( CASE WHEN a.billingcycle IN ('Monthly') THEN 30 WHEN a.billingcycle IN ('Quarterly') THEN 90 WHEN a.billingcycle IN ('Semi-Annually') THEN 182 WHEN a.billingcycle IN ('Annually') THEN 365 WHEN a.billingcycle IN ('Biennially') THEN 730 WHEN a.billingcycle IN ('Triennially') THEN 1095 ELSE 365 END ) as days FROM tblhosting a
    WHERE a.id = :serviceId
        HAVING days >= 1

EOT;

        $duration = Capsule::selectOne($query, $params);

        // The first value
        if ($duration) {
            return current($duration);
        }

        return $duration;
    }

    public function getMachineIdFromService()
    {
        $machineId = $this->getMachineIdFromServiceCurrentVersion();

        if (!$machineId) {

            $machineId = $this->getMachineIdFromServiceOldVersion();
        }

        return $machineId;
    }

    public function getMachineIdFromServiceCurrentVersion()
    {
        $params = [
            'serviceId' => $this->serviceId
        ];

        $machine = Capsule::selectOne('SELECT machine_id FROM autovm_order WHERE order_id = :serviceId', $params);

        // The first value
        if ($machine) {
            return current($machine);
        }

        return $machine;
    }

    public function getMachineIdFromServiceOldVersion()
    {
        $params = [
            'name' => 'ID', 'serviceId' => $this->serviceId
        ];

        $machine = Capsule::selectOne('SELECT a.value FROM tblcustomfieldsvalues a INNER JOIN tblcustomfields b ON b.id = a.fieldid WHERE b.fieldname = :name AND a.relid = :serviceId', $params);

        // The first value
        if ($machine) {
            return current($machine);
        }

        return $machine;
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
