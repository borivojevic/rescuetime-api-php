<?php
namespace MirkoIO\RescueTime;

use Guzzle\Http\Client as GuzzleClient;

class HttpClient
{
    private $apiKey;
    private $apiEndpoint;
    private $format;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->apiEndpoint = 'https://www.rescuetime.com';
        $this->format = 'json';
        $this->guzzleClient = null;
    }

    /**
     * Sends request to RescueTime API and returns array
     * @return Array
     */
    public function request(RequestQueryParameters $params)
    {
        $params->apiKey = $this->apiKey;
        $params->format = $this->format;
        $client = $this->guzzleClient ?: new GuzzleClient($this->apiEndpoint);

        $request = $client->get(
            '/anapi/data',
            array('Accept' => 'application/json'),
            array('query' => $params->toArray())
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

        return $responseJsonArray;
    }
}
