<?php
namespace MirkoIO\RescueTime;

class Client
{
    private $apiKey;
    private $httpClient;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = new HttpClient($apiKey);

    }

    public function setClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Sends request to RescueTime API and returns \Activity array
     * @return Array
     */
    public function getActivities(
        $perspective = null,
        $resolution_time = null,
        $restrict_group = null,
        $restrict_user = null,
        \DateTime $restrict_begin = null,
        \DateTime $restrict_end = null,
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

        $responseJsonArray = $this->httpClient->request($requestQueryParameters);

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
