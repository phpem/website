<?php

namespace App\Controller\Page;


use App\Content\PageContentRetriever;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CodeOfConductController extends Controller
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
        return $this->render('pages/code-of-conduct.html.twig', ['raw_content' => $this->pageContent->getPage('code-of-conduct')]);
    }
}