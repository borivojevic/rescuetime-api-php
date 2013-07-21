<?php
namespace MirkoIO\RescueTime;

class Activity
{

    protected $rank;
    protected $timeSpentSeconds;
    protected $numberOfPeople;
    protected $activityName;
    protected $activityCategory;
    protected $productivityCode;

    public function __construct(
        $rank,
        $timeSpentSeconds,
        $numberOfPeople,
        $activityName,
        $activityCategory,
        $productivityCode
    ) {
        $this->rank = $rank;
        $this->timeSpentSeconds = $timeSpentSeconds;
        $this->numberOfPeople = $numberOfPeople;
        $this->activityName = $activityName;
        $this->activityCategory = $activityCategory;
        $this->productivityCode = $productivityCode;
    }

    public function getRank()
    {
        return $this->rank;
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
