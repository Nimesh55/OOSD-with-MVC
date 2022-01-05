<?php

require 'vendor/autoload.php';

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;

class SmsApi
{
    private static $instance = null;
    private $apiKey;
    private $deviceId;
    private $messageClient;
    //'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTY0MTA1NDcyMSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjkyMjIyLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.Mip0jiKnQrI3_9xcrF1cQmZuZugTv_jgyMh33om8S8Y'
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new SmsApi();
        }
        return self::$instance;
    }

    public function set_config($apiKey, $deviceId)
    {
        $this->apiKey = $apiKey;
        $this->deviceId = $deviceId;
        // Configure client
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', $this->apiKey);
        $apiClient = new ApiClient($config);
        $this->messageClient = new MessageApi($apiClient);
    }

    public function sendSms($reciver_no, $message_body)
    {
        // Sending a SMS Message
        $sendMessageRequest1 = new SendMessageRequest([
            'phoneNumber' => $reciver_no,
            'message' => $message_body,
            'deviceId' => $this->deviceId
        ]);
        try {
            $this->messageClient->sendMessages([
                $sendMessageRequest1
            ]);
            $report = 0;
        } catch (Exception $e) {
            $report = -1;
            echo $report;
        }
        return $report;
    }
}
