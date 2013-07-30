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

    public function __construct($perspective, $columns)
    {
        switch ($perspective) {
            case 'rank':
                $this->rank = $columns[0];
                $this->date = null;
                $this->person = null;
                $this->timeSpentSeconds = $columns[1];
                $this->numberOfPeople = $columns[2];
                $this->activityName = $columns[3];
                $this->activityCategory = $columns[4];
                $this->productivityCode = $columns[5];
                break;
            case 'interval':
                $this->rank = null;
                $this->date = $columns[0];
                $this->person = null;
                $this->timeSpentSeconds = $columns[1];
                $this->numberOfPeople = $columns[2];
                $this->activityName = $columns[3];
                $this->activityCategory = $columns[4];
                $this->productivityCode = $columns[5];
                break;
            case 'member':
                $this->rank = null;
                $this->date = null;
                $this->person = $columns[0];
                $this->timeSpentSeconds = $columns[1];
                $this->numberOfPeople = null;
                $this->activityName = $columns[2];
                $this->activityCategory = $columns[3];
                $this->productivityCode = $columns[4];
                break;
            default:
                throw new \Exception('Unknown perspective');
                break;
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
