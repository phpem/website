<?php


namespace App\Meetup\Client;


use App\Meetup\Client;
use Psr\Cache\InvalidArgumentException;
use Psr\SimpleCache\CacheInterface;

class CachingClient implements Client
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var CacheInterface
     */
    private $cache;

    public function __construct(Client $client, CacheInterface $cache)
    {
        $this->client = $client;
        $this->cache = $cache;
    }

    public function getUpcoming(): array
    {
        $key = "events-upcoming"; // generate a hash for the cache key

        try {
            if ( ! $this->cache->has($key)) {
                $events = $this->client->getUpcoming();
                $this->cache->set($key, $events);
                return $events;
            }
            return $this->cache->get($key);
        } catch (InvalidArgumentException $e) {
            return null;
        }
    }

    public function getPast(): array
    {
        $key = "events-past"; // generate a hash for the cache key

        try {
            if ( ! $this->cache->has($key)) {
                $events = $this->client->getPast();
                $this->cache->set($key, $events);
                return $events;
            }
            return $this->cache->get($key);
        } catch (InvalidArgumentException $e) {
            return null;
        }
    }

    public function getEvents(): array
    {
        $upcoming = $this->getUpcoming();
        $past = $this->getPast();

        return $upcoming + $past;
    }


}