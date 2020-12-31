<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{
    /**
     * @Route("/api/post", name="apipost", methods={"GET"})
     */
    public function index(EntityManagerInterface $em): JsonResponse
    {
        $articles = $em->getRepository(Article::class)->findBy(array(), array('dateatt' => 'DESC'), 5);
        $serialiazedArticles = [];
        foreach($articles as $article){
            $serialiazedArticles[] = [
                'id' => $article->getId(),
                'title' => $article->getTitle(),
                'content' => $article->getContent()
            ];
        }
        return new JsonResponse(['articles' => $serialiazedArticles, 'items' => count($serialiazedArticles)]);
    }

    /**
     * @Route("/api/getpost", name="getpost")
     */
    public function getJson(){
        $jsonContent = file_get_contents("https://evening-sands-72156.herokuapp.com/api/post");

        return $this->render("api/index.html.twig", [
            'articles' => json_decode($jsonContent)
        ]);
    }
}
