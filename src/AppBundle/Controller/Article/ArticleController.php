<?php


namespace AppBundle\Controller\Article; // OU se trouve physiquement notre fichier

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller
{
    /**
     * @Route("/list")
     *
     */
    public function listAction()
    {
        return new Response('List of my new articles');
    }
}