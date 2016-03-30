<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {

        //$antispam = $this->get('antispam');
        //dump($antispam->isSpam('kmdjngjrngmqerjngenrgvnmvjmevnsjk'));die;
        //return new Response('HomePage');

        $manager = $this->getDoctrine()->getManager();

        $articleRepository = $manager->getRepository('AppBundle:Article\Article');

        $articles = new Article();

        $article = new Article();

        $article
            ->setTitle('Titre article')
            ->setContent('Le contenu de mon premier article')
            ->setAuthor('Moi')
            ->setTag('osef')
            ->setCreatedAt(new \DateTime())

        ;
        return $this->render('AppBundle:Home:index.html.twig');

    }
}