<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Bundle\SecurityBundle\Security\UserAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use App\Service\JWTService;
use App\Security\UserAuthenticator; 

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, 
            UserPasswordHasherInterface $userPasswordHasher, 
            UserAuthenticatorInterface $userAuthenticator, 
            UserAuthenticator $authenticator, 
            EntityManagerInterface $entityManager, 
            JWTService $jwt
        ): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // hash du mot de passe
            $hashedPassword = $userPasswordHasher->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            );
            $user->setPassword($hashedPassword);

            // Symfony map automatiquement les autres champs du formulaire vers l'entité
            // Pas besoin de $user->setFirstname(...) etc.

            // persister et flush
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            //Générer le token JWT
            //Header
            $header = [
                'typ' => 'JWT',
                'alg' => 'HS256'
            ];

            //Payload
            $payload = [
                'user_id' => $user->getId(),
                'email' => $user->getEmail() 
            ];

            //On génère le token
            $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'));
            
            dd($token);

            //envoyer par email
            return $userAuthenticator->authenticatorUser(
                $user,
                $authenticator,
                $request
            );

            // redirection vers login
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
