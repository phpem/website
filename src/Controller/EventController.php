<?php


namespace App\Controller;


use App\Meetup\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventController extends Controller
{
    public function next(Client $client)
    {
        $events = $client->getUpcoming();

        return $this->render('events/next.html.twig', ['events' => $events]);
    }

    public function past(Client $client)
    {
        $events = $client->getPast();

        return $this->render('events/past.html.twig', ['events' => $events]);
    }

    public function event(string $event, Client $client)
    {
        $events = $client->getEvents();

        if ( !array_key_exists($event, $events) ) {
            throw new NotFoundHttpException('An event with the id ' . $event .' was not found');
        }

        $event = $events[$event];

        return $this->render('events/event.html.twig', ['event' => $event]);
    }
}