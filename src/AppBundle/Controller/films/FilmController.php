<?php


namespace AppBundle\Controller\films; // OU se trouve physiquement notre fichier

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends Controller
{
    /**
     * @Route("/", name="_films")
     */
    public function listAction()
    {
         $films = [
            [
                'id' => 2,
                'name' => 'Star Wars'
            ],
            [
                'id' => 5,
                'name' => 'DeadPool'
            ],
            [
                'id' => 9,
                'name' => 'Batman vs Superman'
            ],
        ];

        return $this->render('AppBundle:films/Partial:film.html.twig', [
            'films' => $films,
        ]);



    }

    // Création d'une nouvelle page => article/show/id

    /**
     *
     * @Route("/show/{id}", requirements={"id" = "\d+"})
     *
     */
    public function showAction($id, Request $request)
    {
        /* //dump($request);die;

        $tag = $request->query->get('tag');

        return new Response(
            'Affiche moi l\'article avec l\'id: '.$id.'avec le tag '.$tag
        ); */
    }

    /**
     * @Route("/show/{filmName}")
     *
     * @param $filmName
     *
     * @return Response
     */
    public function showFilmNameAction($filmName)
    {
       /* return $this->render('AppBundle:film:index.html.twig', [
            'filmName' => $filmName,
        ]);*/
    }


}