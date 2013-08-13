<?php
namespace MirkoIO\RescueTime;

class Client
{
    private $apiKey;
    public $httpClient;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = new HttpClient($apiKey);

    }

    /**
     * Gets list of activities from
     * RescueTime API for selected criteria
     *
     * @param  String   $perspective      @see RequestQueryParameters::perspective
     * @param  String   $resolution_time  @see RequestQueryParameters::resolution_time
     * @param  String   $restrict_group   @see RequestQueryParameters::restrict_group
     * @param  String   $restrict_user    @see RequestQueryParameters::restrict_user
     * @param  DateTime $restrict_begin   @see RequestQueryParameters::restrict_begin
     * @param  DateTime $restrict_end     @see RequestQueryParameters::restrict_end
     * @param  String   $restrict_kind    @see RequestQueryParameters::restrict_kind
     * @param  String   $restrict_project @see RequestQueryParameters::restrict_project
     * @param  String   $restrict_thing   @see RequestQueryParameters::restrict_thing
     * @param  String   $restrict_thingy  @see RequestQueryParameters::restrict_thingy
     * @return Array    Array of Activity objects
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
