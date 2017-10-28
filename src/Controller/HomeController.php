<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 28/10/2017
 * Time: 15:32
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->render('home/index.html.twig');
    }
}
