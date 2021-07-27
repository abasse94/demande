<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
   /**
    * @Route("/inscription", name="security_registration")
    */

    public function registration(HttpFoundationRequest $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder) {
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
       return $this->render('Security/registration.html.twig', [
           'form' => $form->createView()
       ]);
    }

    /**
     *@Route("/connexion", name="security_login")
     */
    public function login()
    {
        return $this->render('security/login.html.twig');
    }

      /**
     *@Route("/deconnexion", name="security_logout")
     */
    public function logout()
    {
       
    }
}
