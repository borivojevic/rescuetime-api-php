<?php
namespace RescueTime;

/**
 * This class provides a client API for RescueTime Analytic Data API
 *
 * At this point RescueTime API provides single endpoint to fetch detailed and complicated data.
 * The data is read-only through the API.
 *
 * Initial release of RescueTime API is targeted at bringing developers the prepared and
 * pre-organized data structures already familiar through the reporting views of www.rescuetime.com.
 * Keep in mind this is a draft interface, and may change in the future.
 * RescueTime do intend to version the interfaces though, so it is likely forward compatible.
 *
 * Usage:
 * <code>
 * $Client = new \RescueTime\Client($apiKey);
 * $activities = $Client->getActivities("rank");
 * </code>
 *
 * @link https://www.rescuetime.com/analytic_api_setup/doc
 */
class Client
{

    /**
     * RescueTime API token
     *
     * @var string
     */
    private $apiKey;

    /**
     * Default HttpClient
     *
     * @var \RescueTime\HttpClient
     */
    public $httpClient;

    /**
     * Constructs RescueTime client
     *
     * @param string $apiKey RescueTime API key generated in the Embed and Data API -> Setup Data API
     * @link https://www.rescuetime.com/anapi/setup
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = new HttpClient($apiKey);
    }

    /**
     * Returns list of RescueTime activities for selected search criteria
     *
     * @param  string    $perspective      One of "rank", "interval", "member"
     * @param  string    $resolution_time  One of "month", "week", "day", "hour"
     * @param  string    $restrict_group   One group name
     * @param  string    $restrict_user    One user name or user email
     * @param  \DateTime $restrict_begin   Sets the start day for data batch
     * @param  \DateTime $restrict_end     Sets the end day for data batch
     * @param  string    $restrict_kind    One of "category", "activity", "productivity"
     * @param  string    $restrict_project Name of project
     * @param  string    $restrict_thing   Name of category, activity, or overview
     * @param  string    $restrict_thingy  Name of specific "document" or "activity"
     *
     * @return array<\RescueTime\Activity> All activities, or false if none found
     *
     * @throws \Exception If API returns error
     * @see  \RescueTime\RequestQueryParameters
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

        return $result ?: false;
    }
}
