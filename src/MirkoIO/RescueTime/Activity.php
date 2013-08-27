<?php
namespace MirkoIO\RescueTime;

/**
 * This class provides a model for activity data returned by RescueTime Analytic Data API
 */
class Activity
{

    /**
     * Activity ordinal number
     *
     * @var integer
     */
    protected $rank;

    /**
     * Activity date
     *
     * @var string
     */
    protected $date;

    /**
     * Person name
     *
     * @var string
     */
    protected $person;

    /**
     * Time spent on activity (seconds)
     *
     * @var integer
     */
    protected $timeSpentSeconds;

    /**
     * Number of people on activity
     *
     * @var integer
     */
    protected $numberOfPeople;

    /**
     * Activity name
     *
     * @var string
     */
    protected $activityName;


    /**
     * RescueTime category name
     *
     * @var string
     */
    protected $activityCategory;

    /**
     * RecueTime productivity grade
     *
     * @var integer
     */
    protected $productivityCode;

    /**
     * Constructs RescueTime activity
     * @param array  $rowHeaders Array of row headers as returned by RescueTime Analytic Data API
     * @param array  $columns    Array of columns as returned by RescueTime Analytics Data API
     */
    public function __construct($rowHeaders, $columns)
    {
        $properties = array();
        foreach ($rowHeaders as $key => $header) {
            switch ($header) {
                case 'Rank':
                    $properties[$key] = 'rank';
                    break;
                case 'Date':
                    $properties[$key] = 'date';
                    break;
                case 'Person':
                    $properties[$key] = 'person';
                    break;
                case 'Time Spent (seconds)':
                    $properties[$key] = 'timeSpentSeconds';
                    break;
                case 'Number of People':
                    $properties[$key] = 'numberOfPeople';
                    break;
                case 'Activity':
                    $properties[$key] = 'activityName';
                    break;
                case 'Category':
                    $properties[$key] = 'activityCategory';
                    break;
                case 'Productivity':
                    $properties[$key] = 'productivityCode';
                    break;
            }
        }

        $this->rank = null;
        $this->date = null;
        $this->person = null;
        $this->timeSpentSeconds = null;
        $this->numberOfPeople = null;
        $this->activityName = null;
        $this->activityCategory = null;
        $this->productivityCode = null;

        foreach ($columns as $key => $value) {
            if (array_key_exists($key, $properties)) {
                $this->$properties[$key] = $value;
            }
        }
    }

    /**
     * Returns activity rank
     *
     * Present when perspective set to rank
     *
     * @return integer
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Returns activity date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Returns person name
     *
     * Present when perspective set to member
     *
     * @return stirng
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Returns time spent (seconds) on activity
     *
     * @return integer
     */
    public function getTimeSpentSeconds()
    {
        return $this->timeSpentSeconds;
    }

    /**
     * Returns number of people on activity
     *
     * Present when perspective set to interval or rank
     *
     * @return integer
     */
    public function getNumberOfPeople()
    {
        return $this->numberOfPeople;
    }

    /**
     * Returns activity name
     *
     * e.g. Program used or URL visited
     *
     * @return string
     */
    public function getActivityName()
    {
        return $this->activityName;
    }

    /**
     * Returns associated RescueTime activity category name
     *
     * @return string
     */
    public function getActivityCategory()
    {
        return $this->activityCategory;
    }

    /**
     * Return RescueTime activiy productivity grade
     *
     * Integer number between -2 and 2
     *  -2 (Very Distracting Time)
     *  -1 (Distracting Time)
     *   0 (Neutral Time)
     *   1 (Productive Time)
     *   2 (Very Productive Time)
     *
     * @return integer
     */
    public function getProductivityCode()
    {
        return $this->productivityCode;
    }

    /**
     * Return RescueTime activiy productivity grade description
     *
     * One of very distracting, distracting, neutral, productive, very productive
     *
     * @return string
     */
    public function getProductivity()
    {
        switch ($this->productivityCode) {
            case -2:
                return "very distracting";
            case -1:
                return "distracting";
            case 0:
                return "neutral";
            case 1:
                return "productive";
            case 2:
                return "very productive";
        }
    }
}
