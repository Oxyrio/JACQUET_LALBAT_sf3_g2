<?php


namespace AppBundle\Controller\Article; // OU se trouve physiquement notre fichier

use AppBundle\Form\Type\Article\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller
{
    /**
     * @Route("/", name="_article")
     */
    public function listAction()
    {
        /* $tutorials = [
            [
                'id' => 2,
                'name' => 'Symfony2'
            ],
            [
                'id' => 5,
                'name' => 'Wordpress'
            ],
            [
                'id' => 9,
                'name' => 'Laravel'
            ],
        ];

        return $this->render('AppBundle:Article:index.html.twig', [
            'tutorials' => $tutorials,
        ]); */



        $em = $this->getDoctrine()->getManager();

        $articleRepository = $em->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findAll();



        return $this->render('AppBundle:Home:index.html.twig', [
            'articles' => $articles,
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
        //dump($request);die;

        $tag = $request->query->get('tag');

        return new Response(
            'Affiche moi l\'article avec l\'id: '.$id.'avec le tag '.$tag
        );
    }

    /**
     * @Route("/show/{articleName}")
     *
     * @param $articleName
     *
     * @return Response
     */
    public function showArticleNameAction($articleName)
    {
        return $this->render('AppBundle:Article:index.html.twig', [
            'articleName' => $articleName,
        ]);
    }

    /**
     * @Route("/author", name="article_author")
     */
    public function authorAction(Request $request)
    {
        $author = $request->query->get('author');


        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findBy([
            'author' => $author,
        ]);

        return $this->render('AppBundle:Article:index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/tag/new")
     */

    public function newAction(Request $request)
    {
        $form = $this->createForm(TagType::class);

        $form->handleRequest($request);






        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();

            /** @var Tag $tag */

            $tag = $form->getData();

            $stringUtil = $this->get('string.util');

            $slug = $stringUtil->slugify('mon slug');
            $tag->setSlug($slug);

            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('_article');
        }

        return $this->render('AppBundle:Article:tag.new.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}