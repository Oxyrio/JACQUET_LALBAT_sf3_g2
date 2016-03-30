<?php


namespace AppBundle\Controller\Article; // OU se trouve physiquement notre fichier

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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


    // Création d'une nouvelle page => article/show/id

    /**
     *
     * @Route("/show/{id}", requirements={"id" = "\d+"})
     *
     */
    public function showAction($id, Request $request)
    {
        // dump($request);die;
        /* $tag = $request->query->get('tag'); // Récupère les paramètres en GET


        return new Response('Affiche moi l\'article avec l\'id: '.$id.'avec le tag '.$tag);*/

    }

    /**
     * @param $articleName
     *
     * @Route("/show/{articleName}")
     *
     * @return Response
     */
    public function showArticleNameAction($articleName)
    {
        return $this->render('AppBundle:Article:index.html.twig', [
        'articleName' => $articleName
        ]);
    }
}