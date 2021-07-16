<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/** @Route("/panier", name="panier_home") */
class PanierController extends AbstractController
{
    public function show(PanierRepository $panierRepository, User $user)
    {
        // Récupère les informations du panier via l'id de l'utilisateur connecté
        return $this->render('panier/index.html.twig', [
            'panier' => $panierRepository->findBy($user->getId())
        ]);
    }
}