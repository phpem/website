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

    public function getUpcoming()
    {
        $key = "events-upcoming"; // generate a hash for the cache key

        try {
            if ( ! $this->cache->has($key)) {
                $upcomingEvents = $this->client->getUpcoming();
                $this->cache->set($key, $upcomingEvents);
                return $upcomingEvents;
            }
            return $this->cache->get($key);
        } catch (InvalidArgumentException $e) {
            return null;
        }
    }
}