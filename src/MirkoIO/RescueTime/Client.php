<?php
namespace MirkoIO\RescueTime;

use Guzzle\Http\Client as GuzzleClient;

class Client
{

    private $apiKey;
    private $apiEndpoint;
    private $guzzleClient;

    /**
     * Currently, only one operation is supported, "select",
     * and it is enforced on the server,
     * and does not need to be sent from client.
     *
     * @var string
     */
    private $operation;

    /**
     * Only one version is live right now,
     * and therefore doesn't need to be passed.
     * It will be a serial number.
     *
     * @var integer
     */
    private $version;

    /**
     * One of "rank", "interval", "member"
     *
     * Consider this the X - axis of the returned data.
     * It is what determines how your data is crunched serverside
     * for ordered return.
     *  1. rank: (default) Organized around a calculated value, usually a sum like time spent.
     *  2. interval: Organized around calendar time.
     *  3. member: Organized around users and groups,
     *
     * @var string
     */
    private $perspective;

    /**
     * One of "month", "week", "day", "hour"
     *
     * Default is "hour". In an interval report, the X axis unit.
     * In other words, data is summarizd into chunks of this size.
     *
     * @var String
     */
    private $resolution_time;

    /**
     * One group name
     *
     * Provide the name of the group.
     * Service will match that with your account to find group.
     * Avoid re-using the same name for multiple groups when creating them.
     * Currently we do not prevent this. First match will be returned.
     *
     * @var String
     */
    private $restrict_group;

    /**
     * One user name or user email
     *
     * Provide the full (display) name of the user or email address.
     * Service will match that with your account to find user.
     *
     * @var String
     */
    private $restrict_user;

    /**
     * Sets the start day for data batch,
     * inclusive (always at time 00:00, start hour/minute not supported)
     * Format ISO 8601 "YYYY-MM-DD"
     *
     * @var Date
     */
    private $restrict_begin;

    /**
     * Sets the end day for data batch,
     * uninclusive (always at time 00:00, end hour/minute not supported)
     * So, to set 2009-07-31 data as last in your batch, set end date of 2009-08-01
     * Format ISO 8601 "YYYY-MM-DD"
     *
     * @var Date
     */
    private $restrict_end;

    /**
     * One of "category", "activity", or "productivity".
     * "efficiency" is option when perspective is "interval" or "member"
     *
     * Allows you to preprocess data through different statistical engines.
     * The perspective dictates the main grouping of the data,
     * this provides different aspects of that main grouping.
     *  1. category: sums statistics for all activities into their category
     *  2. activity: sums statistics for individual applications / web sites / activities
     *  3. productivity: productivity calculation
     *  4. efficiency: efficiency calculation (not applicable in "rank" perspective)
     *
     * @var String
     */
    private $restrict_kind;

    /**
     * Name of project
     *
     * The name of a specific project in your account.
     * If you create multiple projects with identical names, the first match returns.
     * The returned data will be limited to time active in only that project.
     *
     * @var String
     */
    private $restrict_project;

    /**
     * Name of category, activity, or overview
     *
     * The name of a specific overview, category, application or website.
     * For websites, use the domain component only
     * if it starts with "www", eg. "www.nytimes.com" would be "nytimes.com".
     * The easiest way to see what name you should be using is to retrieve
     * a list that contains the name you want, and inspect it for the exact names.
     *
     * @var String
     */
    private $restrict_thing;

    /**
     * Refers to the specific "document" or "activity" we record for the currently active application,
     * if supported. For example, the document name active when using Microsoft Word.
     * Available for most major applications and web sites.
     *
     * @var String
     */
    private $restrict_thingy;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->apiEndpoint = 'https://www.rescuetime.com';
        $this->guzzleClient = null;

        $this->operation = 'select';
        $this->version = 0;
        $this->perspective = 'rank';
        $this->resolution_time = 'hour';
        $this->restrict_group = null;
        $this->restrict_user = null;
        $this->restrict_begin = null;
        $this->restrict_end = null;
        $this->restrict_kind = null;
        $this->restrict_project = null;
        $this->restrict_thing = null;
        $this->restrict_thingy = null;
    }

    public function request()
    {
        $query = array(
            'key' => $this->apiKey,
            'format' => 'json',
            'operation' => $this->operation,
            'version' => $this->version,
            'perspective' => $this->perspective,
            'resolution_time' => $this->resolution_time,
            'restrict_group' => $this->restrict_group,
            'restrict_user' => $this->restrict_user,
            'restrict_begin' => $this->restrict_begin,
            'restrict_end' => $this->restrict_end,
            'restrict_kind' => $this->restrict_kind,
            'restrict_project' => $this->restrict_project,
            'restrict_thing' => $this->restrict_thing,
            'restrict_thingy' => $this->restrict_thingy
        );
        $query = array_filter($query, function($el) {
            return !is_null($el);
        });

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
