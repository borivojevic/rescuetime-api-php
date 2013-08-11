<?php
namespace MirkoIO\RescueTime;

use Guzzle\Http\Client as GuzzleClient;

class Client
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->guzzleClient = null;
    }

    /**
     * Sends request to RescueTime API and returns \Activity array
     * @return Array
     */
    public function request(
        $perspective = null,
        $resolution_time = null,
        $restrict_group = null,
        $restrict_user = null,
        Date $restrict_begin = null,
        Date $restrict_end = null,
        $restrict_kind = null,
        $restrict_project = null,
        $restrict_thing = null,
        $restrict_thingy = null
    ) {
        $requestQueryParameters = new RequestQueryParameters(
            compact(
                'perspective',
                'resolution_time',
                'restrict_group',
                'restrict_user',
                'restrict_begin',
                'restrict_end',
                'restrict_kind',
                'restrict_project',
                'restrict_thing',
                'restrict_thingy'
            )
        );
        $requestQueryParameters->apiKey = $this->apiKey;

        $client = $this->guzzleClient ?: new GuzzleClient($requestQueryParameters->apiEndpoint);
        $request = $client->get(
            '/anapi/data',
            array('Accept' => 'application/json'),
            array('query' => $requestQueryParameters->toArray())
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
        $rowHeaders = $responseJsonArray['row_headers'];
        foreach ($responseJsonArray['rows'] as $columns) {
            $result[]  = new Activity($rowHeaders, $columns);
        }

        return $result;
    }
}
