<?php

namespace App\Meetup\Client;

use App\Converter\HtmlToMarkdownConverter;
use App\Meetup\Client;
use DMS\Service\Meetup\MeetupKeyAuthClient;

class RdohmsClient implements Client
{
    /**
     * @var MeetupKeyAuthClient
     */
    private $client;

    /**
     * @var HtmlToMarkdownConverter
     */
    private $converter;

    /**
     * The group name
     *
     * @var string
     */
    private $group;

    public function __construct(MeetupKeyAuthClient $client, HtmlToMarkdownConverter $converter, string $group)
    {
        $this->client = $client;
        $this->converter = $converter;
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
            $event['description'] = $this->converter->convert($event['description']);
            $upcoming[$event['id']] = $event;
        }

        return $upcoming;
    }

}