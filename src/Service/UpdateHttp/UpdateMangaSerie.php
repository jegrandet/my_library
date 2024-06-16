<?php

namespace App\Service\UpdateHttp;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\DomCrawler\Crawler;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Serie;

class UpdateMangaSerie {
    
    public function __construct(
            private HttpClientInterface $client,
            private EntityManagerInterface $entityManager
    ) {
    }

    public function update(Serie $serie): Serie {
        // Récupération de la page
        $response = $this->client->request('GET',$serie->getSource());
        if($response->getStatusCode() !== 200){
            throw new HttpExceptionInterface("Erreur d'accès à la page");
        }
        $crawler = new Crawler($response->getContent());
        
        // Titre de la série
        $titre = $crawler->filter('.entry-page-title')->text();
        $serie->setTitre($titre);
        
        // Titre VO
        $titreVo = $crawler->filter('.title-vo')->text();
        $serie->setTitreVo(substr($titreVo, strlen("Titre VO :")));
        
        // Titre traduit
        $titreTrad = $crawler->filter('.trad')->text();
        $serie->setTitreTraduit(substr($titreTrad, strlen("Titre traduit :")));
        
        // Nombre tome VO / VF + statut
        $zoneNumber = $crawler->filter('#numberblock')->children();
        foreach ($zoneNumber as $children){
            $arrayTemp = array();
            $text = preg_replace('/\s+/', '', $children->textContent);
            $textExplode1 = explode(":", $text);
            $textExplode2 = explode("(", $textExplode1[1]);
            
            $arrayTemp[] = $textExplode1[0];
            $arrayTemp[] = $textExplode2[0];
            $arrayTemp[] = substr($textExplode2[1], 0, -1);
            
            $status = null;
            switch ($arrayTemp[2]){
                case 'Encours': $status = "En cours"; break;
                case 'Terminé': $status = "Terminé"; break;
            }
            
            switch ($arrayTemp[0]){
                case "VF": $serie->setNombreTomeVf($arrayTemp[1]); $serie->setStatutVf($status); break;
                case "VO": $serie->setNombreTomeVo($arrayTemp[1]); $serie->setStatutVo($status); break;
            }
        }
        
        // Résumé
        $resume = $crawler->filter('#summary .bigsize')->text();
        $serie->setResume($resume);
        
        // TODO
        
        $this->entityManager->persist($serie);
        $this->entityManager->flush();
        
        return $serie;
    }
}
