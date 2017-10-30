<?php

namespace App\Meetup;

interface Client
{
    /**
     * Get upcoming events
     *
     * @return array
     */
    public function getUpcoming(): array;

    /**
     * Get past events
     *
     * @return array
     */
    public function getPast(): array;

    /**
     * Get all events
     *
     * @return array
     */
    public function getEvents(): array;
}