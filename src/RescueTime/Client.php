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

use RescueTime\RequestQueryParameters;


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
     * @param  RequestQueryParameters A set of parameters to retrieve
     *
     * @return array<\RescueTime\Activity> All activities, or false if none found
     *
     * @throws \RuntimeException If API returns error
     * @see  \RescueTime\RequestQueryParameters
     */
    public function getActivities(RequestQueryParameters $requestQueryParameters)
    {
        $responseJsonArray = $this->httpClient->request($requestQueryParameters);

        if (array_key_exists('error', $responseJsonArray)) {
            throw new \RuntimeException("API returned error: " . $responseJsonArray['error']);
        }

        $result = array();
        $rowHeaders = $responseJsonArray['row_headers'];
        foreach ($responseJsonArray['rows'] as $columns) {
            $result[]  = new Activity($rowHeaders, $columns);
        }

        return $result ?: false;
    }

    /**
     * Returns list of daily summary activities
     *
     *
     * @return array<\RescueTime\DailyReport> All activities for previous two weeks without current day, or false if none found
     *
     * @throws \RuntimeException If API returns error
     * @see  \RescueTime\RequestQueryParameters
     */
    public function getDailySummary()
    {

        $responseJsonArray = $this->httpClient->requestDailyReport();

        if (array_key_exists('error', $responseJsonArray)) {
            throw new \RuntimeException("API returned error: " . $responseJsonArray['error']);
        }

        $result = array();
        foreach ($responseJsonArray as $responseRecord) {
            $result[]  = new DailyReport($responseRecord);
        }

        return $result ?: false;
    }
}
