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

    /**
     * The group name
     *
     * @var string
     */
    private $group;

    public function __construct(MeetupKeyAuthClient $client, string $group)
    {
        $this->client = $client;
        $this->group = $group;
    }

    public function getUpcoming()
    {
        $events = $this->client->getEvents([
            'group_urlname' => $this->group,
            'status' => 'upcoming'
        ]);

        $upcoming = [];
        foreach ($events as $event) {
            $upcoming[$event['id']] = $event;
        }

        return $upcoming;
    }

}