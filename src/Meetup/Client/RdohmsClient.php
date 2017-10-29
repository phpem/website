<?php

namespace App\Meetup\Client;

use App\Converter\HtmlToMarkdownConverter;
use App\Meetup\Client;
use DMS\Service\Meetup\MeetupKeyAuthClient;
use DMS\Service\Meetup\Response\MultiResultResponse;

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

    public function getUpcoming(): array
    {
        $events = $this->client->getEvents([
            'group_urlname' => $this->group,
            'status' => 'upcoming'
        ]);

        return $this->processEvents($events);
    }

    public function getPast(): array
    {
        $events = $this->client->getEvents([
            'group_urlname' => $this->group,
            'status' => 'past'
        ]);

        return $this->processEvents($events);
    }

    protected function processEvents(MultiResultResponse $events): array
    {
        $upcoming = [];
        foreach ($events as $event) {
            $event['description'] = $this->converter->convert($event['description']);
            $upcoming[$event['id']] = $event;
        }
        return $upcoming;
    }

}