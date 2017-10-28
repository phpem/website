<?php

namespace App\Exception;

class PageContentNotFound extends \Exception
{
    public static function forPage(string $pageName)
    {
        return new static("Could not find content for page: {$pageName}");
    }
}
