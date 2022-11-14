<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CommentaireRepository;
use App\Repository\ImagesRepository;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(ArticleRepository  $articleRepo, ReservationRepository $resaRepo, CommentaireRepository $commentRepo, ImagesRepository $imagesRepo): Response
    {
        $articles = $articleRepo->findAll();
        $reservations = $resaRepo->findAll();
        $commentaires = $commentRepo->findAll();
        $sliders = $imagesRepo->findAll();
        // $slider = $imagesRepo->findBy(["id" => 1]);
        // dd($slider->getImage);

        
        return $this->render('main/index.html.twig', [
            'articles' =>$articles,
            'reservations' =>$reservations,
            'commentaires' =>$commentaires,
            'sliders' =>$sliders,
        ]);
    }
    
    #[Route('/sophrologie', name: 'app_sophrologie')]
    public function sophrologie(): Response
    {
        return $this->render('main/sophrologie.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    
    #[Route('/hypnose', name: 'app_hypnose')]
    public function hypnose(): Response
    {
        return $this->render('main/hypnose.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route("/article/{id}", name:"article_show")]
    public function show($id, ArticleRepository $repo, Request $globals, EntityManager $manager)
    {
        $article = $repo->find($id);

        return $this->render("main/article.html.twig", [
            "id" => $article->getId(),
            "article" => $article,
        ]);
    }
}
