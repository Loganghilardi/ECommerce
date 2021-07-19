<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\User;
use App\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /** @Route("/panier", name="panier_home") */
    public function show(PanierRepository $panierRepository)
    {
        //$id = $this->getUser()->getId();

        // Récupère les informations du panier via l'id de l'utilisateur connecté
        return $this->render('panier/index.html.twig', [
            'panier' => $panierRepository->findAll()
        ]);
    }
}