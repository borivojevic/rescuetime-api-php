<?php
namespace MirkoIO\RescueTime;

use Guzzle\Http\Client as GuzzleClient;

class Client
{

    private $apiKey;
    private $apiEndpoint;
    private $guzzleClient;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->apiEndpoint = 'https://www.rescuetime.com';
        $this->guzzleClient = null;
    }

    public function request(
        $operation = 'select',
        $version = '0',
        $perspective = 'rank',
        $resolution_time = 'hour',
        $restrict_group = null,
        $restrict_user = null,
        Date $restrict_begin = null,
        Date $restrict_end = null,
        $restrict_kind = null,
        $restrict_project = null,
        $restrict_thing = null,
        $restrict_thingy = null
    ) {

        $query = array(
            'key' => $this->apiKey,
            'format' => 'json',
            'operation' => $operation,
            'version' => $version,
            'perspective' => $perspective,
            'resolution_time' => $resolution_time
        );

        $client = $this->guzzleClient ?: new GuzzleClient($this->apiEndpoint);
        $request = $client->get(
            '/anapi/data',
            array('Accept' => 'application/json'),
            array('query' => $query)
        );
        $response = $request->send();
        echo $response->getBody();
    }
}
