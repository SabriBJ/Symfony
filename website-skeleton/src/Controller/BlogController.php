<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo): Response
    {
        $articles = $repo->findBy(array(), array('dateatt' => 'DESC'));

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }


    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('blog/home.html.twig' , [
            'title' => "Bienvenue sur TON site internet !"
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/blog/new", name="blog_create")
     * @Route("/blog/{id}/edit", name="blog_edit")
     *
     */
    public function form(Article $article = null,Request $request, EntityManagerInterface $manager){
        if(!$article){
            $article = new Article();
        }

        $article->setTitle("Titre d'exemple");
        $article->setContent("Le contenu");

        $form = $this->createFormBuilder($article)
                ->add('title')
                ->add('content')
                ->add('image')
                ->add('auteur')
                ->add('apercu')
                ->getForm();
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            if(!$article->getId()){
                $article->setDateatt(new \DateTime());
            }
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }

        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null,
            'article' => $article
        ]);
    }

    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Article $article){


        return $this->render('blog/show.html.twig',
        [
            'article' => $article
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}/article-remove", name="blog_remove")
     *
     */
    public function deleteArticle(Article $article){

        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        return $this->render('blog/home.html.twig' , [
            'title' => "Bienvenue sur TON site internet !"
        ]);
    }

}
