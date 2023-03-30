<?php

namespace App\Domain\Delivery\Api\Base;

use App\Domain\Delivery\Api\Interfaces\DpdInterface;
use SoapClient;

class DpdClient implements DpdInterface
{
    private SoapClient $client;
    private array $auth = [];

    /**
     * @throws \SoapFault
     */
    public function __construct($method)
    {
        $opts = array(
            'http' => array(
                'user_agent' => 'PHPSoapClient'
            )
        );
        $context = stream_context_create($opts);

        $soapClientOptions = array(
            'stream_context' => $context,
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE
        );
        $this->client = new SoapClient(self::CONNECT_TEST . $method, $soapClientOptions);

        $this->auth['auth'] = [
            'clientNumber' => env("DPD_CLIENT_NUMBER"),
            'clientKey' => env("DPD_CLIENT_KEY")
        ];
    }

    protected function stdToArray($obj)
    {
        $rc = (array)$obj;
        foreach ($rc as $key => $item) {
            $rc[$key] = (array)$item;
            foreach ($rc[$key] as $keys => $items) {
                $rc[$key][$keys] = (array)$items;
            }
        }
        return $rc;
    }

    protected function callSoapMethod($request, $externalKey, $methodName)
    {
        $request = [$externalKey => array_merge($request, $this->auth)];
        $response = $this->client->$methodName($request);
        return $this->stdToArray($response);
    }
}
