<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Livre;
use App\Entity\Serie;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $nbLivre = $entityManager->getRepository(Livre::class)->count();
        $nbSerie = $entityManager->getRepository(Serie::class)->count();
        
        return $this->render('accueil/index.html.twig', [
            'nbLivre' => $nbLivre,
            'nbSerie' => $nbSerie
        ]);
    }
}
