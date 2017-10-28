<?php

namespace App\Meetup\Client;

use App\Meetup\Client;
use DMS\Service\Meetup\MeetupKeyAuthClient;

class RdohmsClient implements Client
{

    /**
     * @var MeetupKeyAuthClient
     */
    private $client;

    public function __construct(MeetupKeyAuthClient $client)
    {
        $this->client = $client;
    }

    public function getUpcoming()
    {
        $events = $this->client->getEvents([
            'group_urlname' => 'ugphpem',
            'status' => 'upcoming'
        ]);

        return $events->getData();
    }

}