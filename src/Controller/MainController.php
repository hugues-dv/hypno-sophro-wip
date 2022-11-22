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
        // dd($sliders);
        
        
        return $this->render('main/index.html.twig', [
            'articles' =>$articles,
            'reservations' =>$reservations,
            'commentaires' =>$commentaires,
            'sliders' =>$sliders,
        ]);
    }
    
    #[Route('/sophrologie', name: 'app_sophrologie')]
    public function sophrologie(ArticleRepository  $articleRepo, ImagesRepository $imagesRepo): Response
    {
        $articles = $articleRepo->findAll();
        $sliders = $imagesRepo->findAll();
        return $this->render('main/sophrologie.html.twig', [
            'articles' =>$articles,
            'sliders' =>$sliders,
        ]);
    }
    
    #[Route('/hypnose', name: 'app_hypnose')]
    public function hypnose(ArticleRepository  $articleRepo, ImagesRepository $imagesRepo): Response
    {
        $articles = $articleRepo->findAll();
        $sliders = $imagesRepo->findAll();
        return $this->render('main/hypnose.html.twig', [
            'articles' =>$articles,
            'sliders' =>$sliders,
        ]);
    }

    #[Route("/article/{id}", name:"show_article")]
    public function show($id, ArticleRepository $repo)
    {
        $article = $repo->find($id);

        return $this->render("main/article.html.twig", [
            "id" => $article->getId(),
            "article" => $article,
        ]);
    }

    #[Route("/mentions-légales", name:"mentionsLegales")]
    public function mentions(): Response
    {
        return $this->render ('main/mentionsLegales.html.twig');
    }

    #[Route("/politique-de-confidentialité", name:"politiqueDeConfidentialite")]
    public function politiqueDeConfidentialite(): Response
    {
        return $this->render ('main/politiqueDeConfidentialite.html.twig');
    }

    #[Route("/qui-suis-Je", name:"app_quiSuisJe")]
    public function quiSuisJe(): Response
    {
        return $this->render ('main/quiSuisJe.html.twig');
    }
}
