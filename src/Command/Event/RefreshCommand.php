<?php


namespace App\Command\Event;

use App\Meetup\Client;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class RefreshCommand extends Command
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
        parent::__construct();
        $this->client = $client;
        $this->cache = $cache;
    }

    public function configure()
    {
        $this->setName('events:refresh');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        // Clear the cache and force a refresh from meetup
        $this->cache->delete('events-upcoming');
        $this->client->getUpcoming();

        return 0; // return 0 on success
    }
}