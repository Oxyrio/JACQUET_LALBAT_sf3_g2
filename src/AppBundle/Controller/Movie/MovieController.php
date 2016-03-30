<?php


namespace AppBundle\Controller\Movie; // OU se trouve physiquement notre fichier

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends Controller
{
    /**
     * @Route("/")
     *
     */
    public function listAction()
    {
        return new Response('List of my new movies');
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
        $tag = $request->query->get('tag'); // Récupère les paramètres en GET


        return new Response('Affiche moi le film avec l\'id: '.$id.'et le tag '.$tag);
    }
}