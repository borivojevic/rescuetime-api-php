<?php
/**
 * rescuetime-api-php
 *
 * Copyright (c) Mirko Borivojevic (http://mirkoborivojevic.com)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE file
 */

namespace RescueTime;

/**
 * This class provides convenience wrapper around RescueTime Data API query parameters
 */
class RequestQueryParameters
{
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
     * List of permitted perspectives (used in @setPerspective)
     *
     * @var array
     */
    private $availablePerspectives = array("rank", "interval", "member");

    /**
     * List of permitted resolution times (used in @setResolutionTimes)
     *
     * @var array
     */
    private $availableResolutionTimes = array("month", "week", "day", "hour");

    /**
     * List of permitted restrict kinds (used in @setRestrictKind)
     *
     * @var array
     */
    private $availableRestrictKinds = array("category", "activity", "productivity", "document");

    /**
     * Default values of all parameters handled by this object
     *
     * @var array
     */
    private $defaultParams = [
        'operation' => null,
        'version' => null,
        'perspective' => 'rank',
        'resolution_time' => 'hour',
        'restrict_group' => null,
        'restrict_user' => null,
        'restrict_begin' => null,
        'restrict_end' => null,
        'restrict_kind' => null,
        'restrict_project' => null,
        'restrict_thing' => null,
        'restrict_thingy' => null,
    ];

    /**
     * Constructs RequestQueryParameters class
     *
     * Available options to specify in the params argument:
     * 
     * string    perspective      One of "rank", "interval", "member"
     * string    resolution_time  One of "month", "week", "day", "hour"
     * string    restrict_group   One group name
     * string    restrict_user    One user name or user email
     * \DateTime restrict_begin   Sets the start day for data batch
     * \DateTime restrict_end     Sets the end day for data batch
     * string    restrict_kind    One of "category", "activity", "productivity", "document"
     * string    restrict_project Name of project
     * string    restrict_thing   Name of category, activity, or overview
     * string    restrict_thingy  Name of specific "document" or "activity"
     *
     * @param array $params
     */
    public function __construct(array $params)
    {
        $params = $params + $this->defaultParams;
        $this->operation = 'select';
        $this->version = 0;
        $this->setPerspective($params['perspective']);
        $this->setResolutionTime($params['resolution_time']);
        $this->restrict_group = $params['restrict_group'];
        $this->restrict_user = $params['restrict_user'];
        $this->restrict_begin = $params['restrict_begin'];
        $this->restrict_end = $params['restrict_end'];
        $this->setRestrictKind($params['restrict_kind']);
        $this->restrict_project = $params['restrict_project'];
        $this->restrict_thing = $params['restrict_thing'];
        $this->restrict_thingy = $params['restrict_thingy'];
    }

    /**
     * Class properties accessor
     *
     * Utilized for reading data from inaccessible properties
     *
     * @param  string $attribute Property name
     *
     * @return mixed Property value
     */
    public function __get($attribute)
    {
        if (property_exists($this, $attribute)) {
            return $this->$attribute;
        }

        return null;
    }

    /**
     * Sets perspective property
     * Please refer to @availablePerspectives for available options
     *
     * @param string $perspective
     * @throws \InvalidArgumentException If perspective not in available perspectives
     */
    public function setPerspective($perspective)
    {
        if ($perspective && !in_array($perspective, $this->availablePerspectives)) {
            throw new \InvalidArgumentException(
                sprintf("Perspective must be one of %s", implode(', ', $this->availablePerspectives))
            );
        }
        $this->perspective = $perspective;
    }

    /**
     * Sets resolution property
     * Please refer to @availableResolutionTimes for available options
     *
     * @param string $resolution
     * @throws \InvalidArgumentException If resolution not in available resolution times
     */
    public function setResolutionTime($resolution)
    {
        if ($resolution && !in_array($resolution, $this->availableResolutionTimes)) {
            throw new \InvalidArgumentException(
                sprintf("Resolution time must be one of %s", implode(', ', $this->availableResolutionTimes))
            );
        }
        $this->resolution_time = $resolution;
    }

    /**
     * Sets resetrict_kind property
     * Please refer to @availableRestrictKinds for available options
     *
     * @param string $kind
     * @throws \InvalidArgumentException If property not in available restrict kinds
     */
    public function setRestrictKind($kind)
    {
        if ($kind && !in_array($kind, $this->availableRestrictKinds)) {
            throw new \InvalidArgumentException(
                sprintf("Restrict kind must be one of %s", implode(', ', $this->availableRestrictKinds))
            );
        }
        $this->restrict_kind = $kind;
    }

    /**
     * Serializes query parameters array to API endpoint specific format
     *
     * @return array
     */
    public function toArray()
    {
        $queryParams = array(
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

        return array_filter($queryParams);
    }
}
