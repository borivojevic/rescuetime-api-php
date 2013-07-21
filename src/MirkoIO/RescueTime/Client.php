<?php
namespace MirkoIO\RescueTime;

use Guzzle\Http\Client as GuzzleClient;

class Client
{

    private $apiKey;
    private $apiEndpoint;
    private $guzzleClient;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->apiEndpoint = 'https://www.rescuetime.com';
        $this->guzzleClient = null;
    }

    public function request(
        $operation = 'select',
        $version = '0',
        $perspective = 'rank',
        $resolution_time = 'hour',
        $restrict_group = null,
        $restrict_user = null,
        Date $restrict_begin = null,
        Date $restrict_end = null,
        $restrict_kind = null,
        $restrict_project = null,
        $restrict_thing = null,
        $restrict_thingy = null
    ) {

        $query = array(
            'key' => $this->apiKey,
            'format' => 'json',
            'operation' => $operation,
            'version' => $version,
            'perspective' => $perspective,
            'resolution_time' => $resolution_time
        );

        $client = $this->guzzleClient ?: new GuzzleClient($this->apiEndpoint);
        $request = $client->get(
            '/anapi/data',
            array('Accept' => 'application/json'),
            array('query' => $query)
        );

        $response = $request->send();
        return $this->handleResponse($response);
    }

    private function handleResponse($response)
    {
        if (!$response || !$response->isSuccessful()) {
            throw new Exception("HTTP request failed");
        }

        if ($response->getContentLength() == 0) {
            throw new Exception("HTTP body empty");
        }

        try {
            $responseJsonArray = json_decode($response->getBody(), true);
        } catch (RuntimeException $e) {
            throw new Exception("Invalid JSON response: " . $e->getMessage());
        }

        if (isset($responseJsonArray['error'])) {
            throw new Exception("API returned error: " . $responseJsonArray['error']);
        }

        $result = array();
        foreach ($responseJsonArray['rows'] as $args) {
            $reflect  = new \ReflectionClass("\\MirkoIO\\RescueTime\\Activity");
            $result[] = $reflect->newInstanceArgs($args);
        }

        return $result;
    }
}
