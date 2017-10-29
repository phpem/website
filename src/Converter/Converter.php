<?php

namespace App\Converter;

interface Converter
{
    /**
     * Convert content
     *
     * @param null|string $content
     * @return null|string
     */
    public function convert(?string $content): ?string;
}