<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user_list")
     */
    public function index(UserRepository $userRep): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRep->findTodayByDate(),
        ]);
    }

    /**
     * @Route("/user/mod/{id}", name="user_mod")
     */
    public function modUser(User $user = null, TranslatorInterface $t)
    {
        // Si l(id utilisateur n'existe pas, on renvoit vers la liste des utilisateurs)
        if($user == null){
            $this->addFlash('danger', $t->trans('user.notFound'));
            $this->redirectToRoute('user_list');
        }

        // On protège les utilisateurs ROLE_SUPER_ADMIN
        if(in_array('ROLE_SUPER_ADMIN', $user->getRoles())){

            $this->addFlash('danger', $t->trans('User ').$user->getEmail().' '.$t->trans('user.cantmod'));
            $this->redirectToRoute('user_list');
        }

        $em = $this->getDoctrine()->getManager();

        // On donne/retire le role ROLE_ADMIN
        if(!in_array('ROLE_ADMIN', $user->getRoles())){
            $user->setRoles(['ROLE_ADMIN']);
            $this->addFlash('success', $t->trans('User ').$user->getEmail().' '.$t->trans('user.mod').' ROLE_ADMIN');
        } else {
            $user->setRoles([]);
            $this->addFlash('success', $t->trans('User ').$user->getEmail().' '.$t->trans('user.unmod').' ROLE_ADMIN');
        }

        $em->persist($user);
        $em->flush();

        // On renvoit vers la liste des utilisateurs
        return $this->redirectToRoute('user_list');
    }
}
