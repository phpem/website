<?php

namespace App\Controller\Page;

use App\Content\PageContentRetriever;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller
{

    /**
     * @var PageContentRetriever
     */
    private $pageContent;

    public function __construct(PageContentRetriever $pageContent)
    {
        $this->pageContent = $pageContent;
    }

    public function index()
    {
        return $this->render('pages/about.html.twig', ['raw_content' => $this->pageContent->getPage('about')]);
    }
}
