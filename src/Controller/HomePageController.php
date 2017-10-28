<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 28/10/2017
 * Time: 15:32
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomePageController extends Controller
{
    public function index($name)
    {
        return $this->render('homepage/index.html.twig', ['name' => $name]);
    }
}