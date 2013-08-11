<?php
namespace MirkoIO\RescueTime;

class Activity
{

    protected $rank;
    protected $date;
    protected $person;
    protected $timeSpentSeconds;
    protected $numberOfPeople;
    protected $activityName;
    protected $activityCategory;
    protected $productivityCode;

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

    public function getRank()
    {
        return $this->rank;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getPerson()
    {
        return $this->person;
    }

    public function getTimeSpentSeconds()
    {
        return $this->timeSpentSeconds;
    }

    public function getNumberOfPeople()
    {
        return $this->numberOfPeople;
    }

    public function getActivityName()
    {
        return $this->activityName;
    }

    public function getActivityCategory()
    {
        return $this->activityCategory;
    }

    public function getProductivityCode()
    {
        return $this->productivityCode;
    }

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
