<?php

namespace App\Meetup;

interface Client
{
    public function getUpcoming(): array;

    public function getPast(): array;

    public function getEvents(): array;
}