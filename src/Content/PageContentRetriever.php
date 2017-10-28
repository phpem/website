<?php

namespace App\Content;

use App\Exception\PageContentNotFound;

class PageContentRetriever
{
    /**
     * @var string
     */
    private $rootDirectory;

    public function __construct(string $rootDirectory)
    {
        $this->rootDirectory = rtrim($rootDirectory, '/');
    }

    public function getPage(string $pageName): string
    {
        $fileName = $this->rootDirectory . DIRECTORY_SEPARATOR . $pageName . '.md';

        if ( ! file_exists($fileName)) {
            throw PageContentNotFound::forPage($pageName);
        }

        return file_get_contents($fileName);
    }
}
