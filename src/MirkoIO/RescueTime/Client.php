<?php
namespace MirkoIO\RescueTime;

use Guzzle\Http\Client as GuzzleClient;

class Client
{

    public function __construct($apiKey)
    {
        $this->requestQueryParameters = new RequestQueryParameters($apiKey);
        $this->guzzleClient = null;
    }

    /**
     * Sends request to RescueTime API and returns \Activity array
     * @return Array
     */
    public function request()
    {
        $client = $this->guzzleClient ?: new GuzzleClient($this->requestQueryParameters->apiEndpoint);
        $request = $client->get(
            '/anapi/data',
            array('Accept' => 'application/json'),
            array('query' => $this->requestQueryParameters->toArray())
        );

        $response = $request->send();
        return $this->handleResponse($response);
    }

    private function handleResponse($response)
    {
        if (!$response || !$response->isSuccessful()) {
            throw new \Exception("HTTP request failed");
        }

        if ($response->getContentLength() == 0) {
            throw new \Exception("HTTP body empty");
        }

        try {
            $responseJsonArray = json_decode($response->getBody(), true);
        } catch (RuntimeException $e) {
            throw new \Exception("Invalid JSON response: " . $e->getMessage());
        }

        if (array_key_exists('error', $responseJsonArray)) {
            throw new \Exception("API returned error: " . $responseJsonArray['error']);
        }

        $result = array();
        foreach ($responseJsonArray['rows'] as $args) {
            $reflect  = new \ReflectionClass("\\MirkoIO\\RescueTime\\Activity");
            $result[] = $reflect->newInstanceArgs($args);
        }

        return $result;
    }
}
