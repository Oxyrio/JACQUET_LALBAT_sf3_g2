<?php


namespace AppBundle\Controller\Article; // OU se trouve physiquement notre fichier

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\Tag;
use AppBundle\Form\Type\Article\ArticleType;
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

        /*

        $manager = $this->getDoctrine()->getManager();

        $articleRepository = $manager->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findAll();



        return $this->render('AppBundle:Home:index.html.twig', [
            'articles' => $articles,
        ]);*/
    }

    // Création d'une nouvelle page => article/show/id

    /**
     *
     * @Route("/show/{id}", requirements={"id" = "\d+"}, name="show_article")
     *
     */
    public function showAction(Request $request)
    {
        //dump($request);die;

        // = $request->query->get('tag');

        //return new Response(
        //    'Affiche moi l\'article avec l\'id: '.$id.'avec le tag '.$tag
        //);

        $id = $request->query->get('id');


        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findBy([
            'id' => $id,
        ]);

        return $this->render('AppBundle:Article:index.html.twig', [
            'articles' => $articles,
        ]);


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
    public function authorAction(Request $request) //pour pouvoir accéder aux articles d'un auteur en particulier
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
     * @Route("/tag", name="article_tag")
     */
    public function tagAction(Request $request) //pour pouvoir accéder aux articles avec un tag en particulier
    {
        $tag = $request->query->get('tag');


        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findBy([
            'tag' => $tag,
        ]);

        return $this->render('AppBundle:Article:index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/tag/new")
     */

    public function newTagAction(Request $request) //envoie formulaire tag en bdd
    {
        $form = $this->createForm(TagType::class);

        $form->handleRequest($request);

        /* $stringUtil = $this->get('string.util');

        $slug = $stringUtil->slugify('mon slug');
        dump($slug);die; */


        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();

            /** @var Tag $slug */
            $tag = $form->getData();

            $stringUtil = $this->get('string.util');

            $slug = $stringUtil->slugify($tag->getName());
            $tag->setSlug($slug);

            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('_article');
        }

        return $this->render('AppBundle:Article:tag.new.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/new", name="article_create")
     */
    public function newArticleAction(Request $request) //envois formulaire article en bdd
    {
        $form = $this->createForm(ArticleType::class); //création du formulaire

        $form->handleRequest($request); //récupération de la requete

        /* $stringUtil = $this->get('string.util');

        $slug = $stringUtil->slugify('mon slug');
        dump($slug);die; */


        if ($form->isValid()){                          //vérif si le formulaire envoyé est valide
            $em = $this->getDoctrine()->getManager();

            /** @var Article $article */
            $article = $form->getData();
            //$sluggy = $article->getTitle();
            //$stringUtil = $this->get('string.util');

            //$slug = $stringUtil->slugify($sluggy);
            //$article->setSlug($slug);

            $em->persist($article);
            $em->flush(); //envois en bdd

            return $this->redirectToRoute('_article');  // si il est valide, cela renvoie sur la page des articles
                                                        // sinon cela dit que le formulaire n'est pas valide
                                                        // et demande à l'utilisateur de bien rentrer les données
        }

        return $this->render('AppBundle:Article:tag.new.html.twig', [
            'form' => $form->createView(), //affiche la vue de la page création d'article, ici c'est la vue tag.new.html.twig
        ]);
    }


}