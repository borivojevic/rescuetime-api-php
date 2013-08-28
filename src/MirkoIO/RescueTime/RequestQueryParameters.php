<?php
namespace MirkoIO\RescueTime;

/**
 * This class provides convenience wrapper around RescueTime Data API query parameters
 */
class RequestQueryParameters
{

    /**
     * RescueTime API token
     *
     * @var string
     */
    private $apiKey;

    /**
     * API request format (defaulted to json)
     *
     * API provides data in CSV or JSON format
     *
     */
    private $format;

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
     * @var string
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
     * @var string
     */
    private $restrict_group;

    /**
     * One user name or user email
     *
     * Provide the full (display) name of the user or email address.
     * Service will match that with your account to find user.
     *
     * @var string
     */
    private $restrict_user;

    /**
     * Sets the start day for data batch
     *
     * Inclusive (always at time 00:00, start hour/minute not supported)
     * Format ISO 8601 "YYYY-MM-DD"
     *
     * @var \DateTime
     */
    private $restrict_begin;

    /**
     * Sets the end day for data batch
     *
     * Uninclusive (always at time 00:00, end hour/minute not supported)
     * So, to set 2009-07-31 data as last in your batch, set end date of 2009-08-01
     * Format ISO 8601 "YYYY-MM-DD"
     *
     * @var \DateTime
     */
    private $restrict_end;

    /**
     * One of "category", "activity", "productivity"
     *
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
     * @var string
     */
    private $restrict_kind;

    /**
     * Name of project
     *
     * The name of a specific project in your account.
     * If you create multiple projects with identical names, the first match returns.
     * The returned data will be limited to time active in only that project.
     *
     * @var string
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
     * @var string
     */
    private $restrict_thing;

    /**
     * Refers to the specific "document" or "activity" we record for the currently active application,
     * if supported. For example, the document name active when using Microsoft Word.
     * Available for most major applications and web sites.
     *
     * @var string
     */
    private $restrict_thingy;

    /**
     * Constructs RequestQueryParameters class
     *
     * @param array $params
     */
    public function __construct($params)
    {
        $this->operation = 'select';
        $this->version = 0;
        $this->setPerspective($params['perspective'] ?: 'rank');
        $this->setResolutionTime($params['resolution_time'] ?: 'hour');
        $this->restrict_group = $params['restrict_group'] ?: null;
        $this->restrict_user = $params['restrict_user'] ?: null;
        $this->restrict_begin = $params['restrict_begin'] ?: null;
        $this->restrict_end = $params['restrict_end'] ?: null;
        $this->setRestrictKind($params['restrict_kind'] ?: null);
        $this->restrict_project = $params['restrict_project'] ?: null;
        $this->restrict_thing = $params['restrict_thing'] ?: null;
        $this->restrict_thingy = $params['restrict_thingy'] ?: null;
    }

    /**
     * Class properties accessor
     *
     * Utilized for reading data from inaccessible properties
     *
     * @param  string $attribute Property name
     * @return mixed Property value
     */
    public function __get($attribute)
    {
        if (property_exists($this, $attribute)) {
            return $this->$attribute;
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $attribute .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE
        );
        return null;
    }

    /**
     * Sets perspective property
     *
     * @param string $perspective
     * @throws \Exception If perspective not in "rank", "interaval", "member"
     */
    public function setPerspective($perspective)
    {
        if ($perspective && !in_array($perspective, array("rank", "interval", "member"))) {
            throw new \Exception("Perspective must be one of rank, interval or member");
        }
        $this->perspective = $perspective;
    }

    /**
     * Sets resolution property
     *
     * @param string $resolution
     * @throws \Exception If resolution not in "month", "week", "day", "hour"
     */
    public function setResolutionTime($resolution)
    {
        if ($resolution && !in_array($resolution, array("month", "week", "day", "hour"))) {
            throw new \Exception("Resolution time must be one of month, week, day or hour");
        }
        $this->resolution_time = $resolution;
    }

    /**
     * Sets resetrict_kind property
     *
     * @param string $kind
     * @throws  \Exception If property not in "category", "activity", "productivity"
     */
    public function setRestrictKind($kind)
    {
        if ($kind && !in_array($kind, array("category", "activity", "productivity"))) {
            throw new \Exception("Restrict kind must be one of category, activity, productivity");
        }
        $this->restrict_kind = $kind;
    }

    /**
     * Class properties mutator
     *
     * Run when writing data to inaccessible properties
     *
     * @param string $attribute Property name
     * @param string $value     Property value
     */
    public function __set($attribute, $value)
    {
        if ($attribute == "perspective") {
            $this->setPerspective($value);
            return true;
        } elseif ($attribute == "resolution_time") {
            $this->setResolutionTime($value);
            return true;
        } elseif ($attribute == "restrict_kind") {
            $this->setRestrictKind($value);
            return true;
        } elseif (property_exists($this, $attribute)) {
            $this->$attribute = $value;
            return true;
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __set(): ' . $attribute .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE
        );
    }

    /**
     * Serializes query parameters array to API endpoint specific format
     *
     * @return array
     */
    public function toArray()
    {
        $queryParams = array(
            'key' => $this->apiKey,
            'format' => $this->format,
            'operation' => $this->operation,
            'version' => $this->version,
            'perspective' => $this->perspective,
            'resolution_time' => $this->resolution_time,
            'restrict_group' => $this->restrict_group,
            'restrict_user' => $this->restrict_user,
            'restrict_kind' => $this->restrict_kind,
            'restrict_project' => $this->restrict_project,
            'restrict_thing' => $this->restrict_thing,
            'restrict_thingy' => $this->restrict_thingy
        );
        if ($this->restrict_begin) {
            $queryParams['restrict_begin'] = $this->restrict_begin->format('Y-m-d');
        }
        if ($this->restrict_end) {
            $queryParams['restrict_end'] = $this->restrict_end->format('Y-m-d');
        }
        $queryParams = array_filter(
            $queryParams,
            function ($el) {
                return !is_null($el);
            }
        );
        return $queryParams;
    }
}
