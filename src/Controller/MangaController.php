<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Livre;
use App\Entity\Serie;
use App\Form\FormSerieAdd;
use App\Service\UpdateHttp\UpdateMangaSerie;

class MangaController extends AbstractController
{
    #[Route('/manga', name: 'manga')]
    public function index(): Response
    {
        $formNew = $this->createForm(FormSerieAdd::class, new Serie());
        
        return $this->render('manga/index.html.twig', [
            'formNew' => $formNew
        ]);
    }
    
    #[Route('/manga/data', name: 'manga_data')]
    public function data(EntityManagerInterface $entityManager): Response
    {
        $lstSerie = $entityManager->getRepository(Serie::class)->findAll();
        
        $lstFormated = array();
        foreach ($lstSerie as $serie){
            $lstFormated[] = array(
                "id" => $serie->getId(),
                "titre" => $serie->getTitre(),
                "titreVo" => $serie->getTitreVo(),
                "titreTraduit" => $serie->getTitreTraduit(),
                "nombreTomeVo" => $serie->getNombreTomeVo(),
                "nombreTomeVf" => $serie->getNombreTomeVf(),
                "statutVo" => $serie->getStatutVo(),
                "statutVf" => $serie->getStatutVf(),
                
                "source" => $serie->getSource(),
                "url-actualiser" => $this->generateUrl('manga_serie_actualiser', ["serie" => $serie->getId()]),
                "url-supprimer" => $this->generateUrl('manga_serie_supprimer', ["serie" => $serie->getId()])
            );
        }
        
        return new JsonResponse([
            "data" => $lstFormated
        ]);
    }
    
    #[Route('/manga/serie/ajouter', name: 'manga_serie_ajouter')]
    public function serie_ajouter(Request $request, EntityManagerInterface $entityManager, UpdateMangaSerie $updater): Response
    {
        $newSerie = new Serie();
        $formNew = $this->createForm(FormSerieAdd::class, $newSerie);
        
        $formNew->handleRequest($request);
        if ($formNew->isSubmitted() && $formNew->isValid()) {
            $newSerie = $formNew->getData();
            
            $updater->update($newSerie);
        }
        
        return new Response("OK");
    }
    
    #[Route('/manga/serie/actualiser/{serie}', name: 'manga_serie_actualiser')]
    public function serie_actualiser(Request $request, EntityManagerInterface $entityManager, UpdateMangaSerie $updater, Serie $serie): Response
    {
        $updater->update($serie);
        
        return new Response("OK");
    }
    
    #[Route('/manga/serie/supprimer/{serie}', name: 'manga_serie_supprimer')]
    public function serie_supprimer(Request $request, EntityManagerInterface $entityManager, UpdateMangaSerie $updater, Serie $serie): Response
    {
        $entityManager->remove($serie);
        $entityManager->flush();
        
        return new Response("OK");
    }
}
