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

    /**
     * @inheritdoc
     */
    public function getUpcoming(): array
    {
        $args = $this->buildArguments('upcoming');
        $events = $this->client->getEvents($args);

        return $this->processEvents($events);
    }

    /**
     * @inheritdoc
     */
    public function getPast(): array
    {
        $args = $this->buildArguments('past');
        $events = $this->client->getEvents($args);

        return $this->processEvents($events);
    }

    /**
     * @inheritdoc
     */
    public function getEvents(): array
    {
        $upcoming = $this->getUpcoming();
        $past = $this->getPast();

        return array_merge($upcoming, $past);
    }

    /**
     * Process the events fetched from meetup
     *
     * @param MultiResultResponse $events
     * @return array
     */
    protected function processEvents(MultiResultResponse $events): array
    {
        $processed = [];
        foreach ($events as $event) {
            $event['description'] = $this->converter->convert($event['description']);
            $processed[$event['id']] = $event;
        }
        return $processed;
    }

    /**
     * Build the arguments array for querying meetup
     *
     * @param string $status
     * @return array
     */
    protected function buildArguments(string $status): array
    {
        return [
            'group_urlname' => $this->group,
            'status' => $status,
            'desc' => 'true'
        ];
    }

}