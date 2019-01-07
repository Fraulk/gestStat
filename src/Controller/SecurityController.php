<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends Controller
{
    // Cette route mène à la page d'inscription
        /**
         * @Route ("/inscription", name="security_registration")
         */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder) {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security_login');

        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Cette Route vérifie si l'utilisatur a bien rentrer le mot de passe et l'adrese email
    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(){
        return $this->render('security/login.html.twig', [
            'pageCourante'  =>  'connexion'
        ]);
    }

    // Cette route permet de se déconnecter
    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout() {}
    
}
