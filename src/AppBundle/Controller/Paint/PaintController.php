<?php


namespace AppBundle\Controller\Paint; // OU se trouve physiquement notre fichier

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaintController extends Controller
{
    /**
     * @Route("/list")
     *
     */
    public function listAction()
    {
        return new Response('List of my new paints');
    }


    // Création d'une nouvelle page => article/show/id

    /**
     *
     * @Route("/show/{id}", requirements={"id" = "\d+"})
     *
     */
    public function showAction($id, Request $request)
    {
        //dump($request);die;

        $tag = $request->query->get('tag');

        return new Response(
            'Affiche moi la peinture avec l\'id: '.$id.'avec le tag '.$tag
        );
    }
}