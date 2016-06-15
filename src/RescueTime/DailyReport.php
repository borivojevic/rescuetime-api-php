<?php
/**
 * rescuetime-api-php
 *
 * Copyright (c) Konstantin Popov (https://tamvodopad.com)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE file
 */

namespace RescueTime;

/**
 * This class provides a model for activity data returned by RescueTime Analytic Data API
 */
class DailyReport
{

    /**
     * Daily report ordinal number
     *
     * @var integer
     */
    protected $id;

    /**
     * Activity date
     *
     * @var string
     */
    protected $date;

    /**
     * Productivity pulse. (A scale bewteen 0-100)
     *
     * @var float
     */
    protected $productivity_pulse;

    /**
     * Daily very productivity percentage
     *
     * @var float
     */
    protected $very_productive_percentage;

    /**
     * Daily productivity percentage
     *
     * @var float
     */
    protected $productive_percentage;

    /**
     * Daily neutral percentage
     *
     * @var float
     */
    protected $neutral_percentage;

    /**
     * Daily distracting percentage
     *
     * @var float
     */
    protected $distracting_percentage;

    /**
     * Daily very distracting percentage
     *
     * @var float
     */
    protected $very_distracting_percentage;

    /**
     * Daily all productivity percentage
     *
     * @var float
     */
    protected $all_productive_percentage;

    /**
     * Daily all distracting percentage
     *
     * @var float
     */
    protected $all_distracting_percentage;

    /**
     * Daily uncategorized percentage
     *
     * @var float
     */
    protected $uncategorized_percentage;

    /**
     * Daily business percentage
     *
     * @var float
     */
    protected $business_percentage;

    /**
     * Daily communication and scheduling percentage
     *
     * @var float
     */
    protected $communication_and_scheduling_percentage;

    /**
     * Daily social networking percentage
     *
     * @var float
     */
    protected $social_networking_percentage;

    /**
     * Daily design and composition percentage
     *
     * @var float
     */
    protected $design_and_composition_percentage;

    /**
     * Daily entertainment percentage
     *
     * @var float
     */
    protected $entertainment_percentage;

    /**
     * Daily news percentage
     *
     * @var float
     */
    protected $news_percentage;

    /**
     * Daily software development percentage
     *
     * @var float
     */
    protected $software_development_percentage;

    /**
     * Daily reference and learning percentage
     *
     * @var float
     */
    protected $reference_and_learning_percentage;

    /**
     * Daily shopping percentage
     *
     * @var float
     */
    protected $shopping_percentage;

    /**
     * Daily utilities percentage
     *
     * @var float
     */
    protected $utilities_percentage;


    /**
     * Daily total hours (Float with two decimal places)
     *
     * @var float
     */
    protected $total_hours;

    /**
     * Daily very productive hours (Float with two decimal places)
     *
     * @var float
     */
    protected $very_productive_hours;

    /**
     * Daily productive hours (Float with two decimal places)
     *
     * @var float
     */
    protected $productive_hours;

    /**
     * Daily neutral hours (Float with two decimal places)
     *
     * @var float
     */
    protected $neutral_hours;

    /**
     * Daily distracting hours (Float with two decimal places)
     *
     * @var float
     */
    protected $distracting_hours;

    /**
     * Daily very distracting hours (Float with two decimal places)
     *
     * @var float
     */
    protected $very_distracting_hours;

    /**
     * Daily all productive hours (Float with two decimal places)
     *
     * @var float
     */
    protected $all_productive_hours;

    /**
     * Daily all distracting hours (Float with two decimal places)
     *
     * @var float
     */
    protected $all_distracting_hours;

    /**
     * Daily uncategorized hours (Float with two decimal places)
     *
     * @var float
     */
    protected $uncategorized_hours;

    /**
     * Daily business hours (Float with two decimal places)
     *
     * @var float
     */
    protected $business_hours;

    /**
     * Daily communication and scheduling hours (Float with two decimal places)
     *
     * @var float
     */
    protected $communication_and_scheduling_hours;

    /**
     * Daily social networking hours (Float with two decimal places)
     *
     * @var float
     */
    protected $social_networking_hours;

    /**
     * Daily design and composition hours (Float with two decimal places)
     *
     * @var float
     */
    protected $design_and_composition_hours;

    /**
     * Daily entertainment hours (Float with two decimal places)
     *
     * @var float
     */
    protected $entertainment_hours;

    /**
     * Daily news hours (Float with two decimal places)
     *
     * @var float
     */
    protected $news_hours;

    /**
     * Daily software development hours (Float with two decimal places)
     *
     * @var float
     */
    protected $software_development_hours;

    /**
     * Daily reference and learning hours (Float with two decimal places)
     *
     * @var float
     */
    protected $reference_and_learning_hours;

    /**
     * Daily shopping hours (Float with two decimal places)
     *
     * @var float
     */
    protected $shopping_hours;

    /**
     * Daily utilities hours (Float with two decimal places)
     *
     * @var float
     */
    protected $utilities_hours;


    /**
     * Daily total hours
     *
     * @var string
     */
    protected $total_duration_formatted;

    /**
     * Daily very productive hours
     *
     * @var string
     */
    protected $very_productive_duration_formatted;

    /**
     * Daily productive hours
     *
     * @var string
     */
    protected $productive_duration_formatted;

    /**
     * Daily neutral hours
     *
     * @var string
     */
    protected $neutral_duration_formatted;

    /**
     * Daily distracting hours
     *
     * @var string
     */
    protected $distracting_duration_formatted;

    /**
     * Daily very distracting hours
     *
     * @var string
     */
    protected $very_distracting_duration_formatted;

    /**
     * Daily all productive hours
     *
     * @var string
     */
    protected $all_productive_duration_formatted;

    /**
     * Daily all distracting hours
     *
     * @var string
     */
    protected $all_distracting_duration_formatted;

    /**
     * Daily uncategorized hours
     *
     * @var string
     */
    protected $uncategorized_duration_formatted;

    /**
     * Daily business hours
     *
     * @var string
     */
    protected $business_duration_formatted;

    /**
     * Daily communication and scheduling hours
     *
     * @var string
     */
    protected $communication_and_scheduling_duration_formatted;

    /**
     * Daily social networking hours
     *
     * @var string
     */
    protected $social_networking_duration_formatted;

    /**
     * Daily design and composition hours
     *
     * @var string
     */
    protected $design_and_composition_duration_formatted;

    /**
     * Daily entertainment hours
     *
     * @var string
     */
    protected $entertainment_duration_formatted;

    /**
     * Daily news hours
     *
     * @var string
     */
    protected $news_duration_formatted;

    /**
     * Daily software development hours
     *
     * @var string
     */
    protected $software_development_duration_formatted;

    /**
     * Daily reference and learning hours
     *
     * @var string
     */
    protected $reference_and_learning_duration_formatted;

    /**
     * Daily shopping hours
     *
     * @var string
     */
    protected $shopping_duration_formatted;

    /**
     * Daily utilities hours
     *
     * @var string
     */
    protected $utilities_duration_formatted;


    /**
     * Constructs RescueTime activity
     * @param array  $data Array of data as returned by RescueTime Analytic Data API
     */
    public function __construct($data)
    {
        foreach ($data as $property => $value) {
            $this->$property = $value;
        }
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
     * Returns overall productivity pulse. A scale bewteen 0-100
     *
     *
     * @return integer
     */
    public function getProductivityPulse()
    {
        return $this->productivity_pulse;
    }

    /**
     * Returns percentage representation of time spent in very productivity category
     *
     *
     * @return float
     */
    public function getVeryProductivePercentage()
    {
        return $this->very_productive_percentage;
    }

    /**
     * Returns percentage representation of time spent in productivity category
     *
     *
     * @return float
     */
    public function getProductivePercentage()
    {
        return $this->productive_percentage;
    }

    /**
     * Returns percentage representation of time spent in neutral category
     *
     *
     * @return float
     */
    public function getNeutralPercentage()
    {
        return $this->neutral_percentage;
    }

    /**
     * Returns percentage representation of time spent in distracting category
     *
     *
     * @return float
     */
    public function getDistractingPercentage()
    {
        return $this->distracting_percentage;
    }

    /**
     * Returns percentage representation of time spent in all productive categories
     *
     *
     * @return float
     */
    public function getAllProductivePercentage()
    {
        return $this->all_productive_percentage;
    }

    /**
     * Returns percentage representation of time spent in all distracting categories
     *
     *
     * @return float
     */
    public function getAllDistractingPercentage()
    {
        return $this->all_distracting_percentage;
    }

    /**
     * Returns percentage representation of time spent in all uncategorized categories
     *
     *
     * @return float
     */
    public function getUncategorizedPercentage()
    {
        return $this->uncategorized_percentage;
    }

    /**
     * Returns percentage representation of time spent in business category
     *
     *
     * @return float
     */
    public function getBusinessPercentage()
    {
        return $this->business_percentage;
    }

    /**
     * Returns percentage representation of time spent in communication and scheduling category
     *
     *
     * @return float
     */
    public function getCommunicationAndSchedulingPercentage()
    {
        return $this->communication_and_scheduling_percentage;
    }

    /**
     * Returns percentage representation of time spent in social networking category
     *
     *
     * @return float
     */
    public function getSocialNetworkingPercentage()
    {
        return $this->social_networking_percentage;
    }

    /**
     * Returns percentage representation of time spent in design and composition categories
     *
     *
     * @return float
     */
    public function getDesignAndCompositionPercentage()
    {
        return $this->design_and_composition_percentage;
    }

    /**
     * Returns percentage representation of time spent in entertainment category
     *
     *
     * @return float
     */
    public function getEntertainmentPercentage()
    {
        return $this->entertainment_percentage;
    }

    /**
     * Returns percentage representation of time spent in news category
     *
     *
     * @return float
     */
    public function getNewsPercentage()
    {
        return $this->news_percentage;
    }

    /**
     * Returns percentage representation of time spent in software development category
     *
     *
     * @return float
     */
    public function getSoftwareDevelopmentPercentage()
    {
        return $this->software_development_percentage;
    }

    /**
     * Returns percentage representation of time spent in reference and learning categories
     *
     *
     * @return float
     */
    public function getReferenceAndLearningPercentage()
    {
        return $this->reference_and_learning_percentage;
    }

    /**
     * Returns percentage representation of time spent in shopping category
     *
     *
     * @return float
     */
    public function getShoppingPercentage()
    {
        return $this->shopping_percentage;
    }

    /**
     * Returns percentage representation of time spent in shopping category
     *
     *
     * @return float
     */
    public function getUtilitiesPercentage()
    {
        return $this->utilities_percentage;
    }

    /**
     * Returns daily hours (Float with two decimal places)
     *
     *
     * @return float
     */
    public function getTotalHours()
    {
        return $this->total_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in very productivity category
     *
     *
     * @return float
     */
    public function getVeryProductiveHours()
    {
        return $this->very_productive_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in productivity category
     *
     *
     * @return float
     */
    public function getProductiveHours()
    {
        return $this->productive_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in neutral category
     *
     *
     * @return float
     */
    public function getNeutralHours()
    {
        return $this->neutral_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in distracting category
     *
     *
     * @return float
     */
    public function getDistractingHours()
    {
        return $this->distracting_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in distracting category
     *
     *
     * @return float
     */
    public function getVeryDistractingHours()
    {
        return $this->very_distracting_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in all productive categories
     *
     *
     * @return float
     */
    public function getAllProductiveHours()
    {
        return $this->all_productive_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in all distracting categories
     *
     *
     * @return float
     */
    public function getAllDistractingHours()
    {
        return $this->all_distracting_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in all uncategorized categories
     *
     *
     * @return float
     */
    public function getUncategorizedHours()
    {
        return $this->uncategorized_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in business category
     *
     *
     * @return float
     */
    public function getBusinessHours()
    {
        return $this->business_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in communication and scheduling category
     *
     *
     * @return float
     */
    public function getCommunicationAndSchedulingHours()
    {
        return $this->communication_and_scheduling_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in social networking category
     *
     *
     * @return float
     */
    public function getSocialNetworkingHours()
    {
        return $this->social_networking_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in design and composition categories
     *
     *
     * @return float
     */
    public function getDesignAndCompositionHours()
    {
        return $this->design_and_composition_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in entertainment category
     *
     *
     * @return float
     */
    public function getEntertainmentHours()
    {
        return $this->entertainment_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in news category
     *
     *
     * @return float
     */
    public function getNewsHours()
    {
        return $this->news_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in software development category
     *
     *
     * @return float
     */
    public function getSoftwareDevelopmentHours()
    {
        return $this->software_development_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in reference and learning categories
     *
     *
     * @return float
     */
    public function getReferenceAndLearningHours()
    {
        return $this->reference_and_learning_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in shopping category
     *
     *
     * @return float
     */
    public function getShoppingHours()
    {
        return $this->shopping_hours;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in shopping category
     *
     *
     * @return float
     */
    public function getUtilitiesHours()
    {
        return $this->utilities_hours;
    }

    /**
     * Returns daily hours (Float with two decimal places)
     *
     *
     * @return string
     */
    public function getTotalDurationFormatted()
    {
        return $this->total_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in very productivity category
     *
     *
     * @return string
     */
    public function getVeryProductiveDurationFormatted()
    {
        return $this->very_productive_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in productivity category
     *
     *
     * @return string
     */
    public function getProductiveDurationFormatted()
    {
        return $this->productive_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in neutral category
     *
     *
     * @return string
     */
    public function getNeutralDurationFormatted()
    {
        return $this->neutral_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in distracting category
     *
     *
     * @return string
     */
    public function getDistractingDurationFormatted()
    {
        return $this->distracting_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in distracting category
     *
     *
     * @return string
     */
    public function getVeryDistractingDurationFormatted()
    {
        return $this->very_distracting_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in all productive categories
     *
     *
     * @return string
     */
    public function getAllProductiveDurationFormatted()
    {
        return $this->all_productive_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in all distracting categories
     *
     *
     * @return string
     */
    public function getAllDistractingDurationFormatted()
    {
        return $this->all_distracting_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in all uncategorized categories
     *
     *
     * @return string
     */
    public function getUncategorizedDurationFormatted()
    {
        return $this->uncategorized_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in business category
     *
     *
     * @return string
     */
    public function getBusinessDurationFormatted()
    {
        return $this->business_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in communication and scheduling category
     *
     *
     * @return string
     */
    public function getCommunicationAndSchedulingDurationFormatted()
    {
        return $this->communication_and_scheduling_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in social networking category
     *
     *
     * @return string
     */
    public function getSocialNetworkingDurationFormatted()
    {
        return $this->social_networking_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in design and composition categories
     *
     *
     * @return string
     */
    public function getDesignAndCompositionDurationFormatted()
    {
        return $this->design_and_composition_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in entertainment category
     *
     *
     * @return string
     */
    public function getEntertainmentDurationFormatted()
    {
        return $this->entertainment_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in news category
     *
     *
     * @return string
     */
    public function getNewsDurationFormatted()
    {
        return $this->news_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in software development category
     *
     *
     * @return string
     */
    public function getSoftwareDevelopmentDurationFormatted()
    {
        return $this->software_development_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in reference and learning categories
     *
     *
     * @return string
     */
    public function getReferenceAndLearningDurationFormatted()
    {
        return $this->reference_and_learning_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in shopping category
     *
     *
     * @return string
     */
    public function getShoppingDurationFormatted()
    {
        return $this->shopping_duration_formatted;
    }

    /**
     * Returns hours (Float with two decimal places) representation of time spent in shopping category
     *
     *
     * @return string
     */
    public function getUtilitiesDurationFormatted()
    {
        return $this->utilities_duration_formatted;
    }
}
