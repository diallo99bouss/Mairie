<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="secutity_registration")
     *
     */
    public function registration( Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){

        $user = new User(); 
        $form = $this->createForm(RegistrationType::class , $user);

        $form -> handleRequest($request);

        if($form -> isSubmitted() && $form->isValid())
        {
            $hash = $encoder->encodePassword($user ,  $user->getPassword());

            $user -> setPassword($hash);

            $manager -> persist($user);
            $manager -> flush();

            return $this->redirectToRoute("security_login");
        }

        return $this->render('security/registration.html.twig',   [
            'form' => $form->createView()
        ]); 
    }

   /**
    * @Route("/accueil", name= "accueil")
    *
    */
    public function accueil(){
        return $this->render('accueil/index.html.twig');
    }

    /**
     * @Route("/", name="security_login" )
     */
    public function login(AuthenticationUtils $authenticationUtils){
        $error = $authenticationUtils ->getLastAuthenticationError();
        $lastUsername = $authenticationUtils ->getLastUsername();
        return $this->render('security/login.html.twig',[
            'Last_username' => $lastUsername ,
            'error' => $error
        ]);
    }

   /**
     * @Route("/deconnexion", name="security_logout" )
     */
    
    public function logout(){
        return $this->render('security/logout.html.twig');
    } 

    /**
     * @Route("/reussi", name="security_reussi" )
     * 
     */
    
    public function oublie(){
        return $this->render('security/reussi.html.twig');
    } 
   
}
