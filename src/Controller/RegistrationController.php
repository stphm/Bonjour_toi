<?php

namespace App\Controller;

use App\Entity\Personality;
use App\Entity\Personnality;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\PersonnalityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

    
        if ($form->isSubmitted() && $form->isValid()) {

            $lastIdPersonnality = $this->getDoctrine()->getRepository('App:Personnality')->findBy([], ['id' => 'DESC'], 1);

            $lastIdPhysical = $this->getDoctrine()->getRepository('App:Physical')->findBy([], ['id' => 'DESC'], 1);

           //found last id Personnality
          
            
           // found last id Physical

            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );  
            $user->setPersonnality($lastIdPersonnality[0]);
            $user->setPhysical($lastIdPhysical[0]);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}

// Alors, je vais te laisser en faite cherche une requete DQL (comme sql en Symfony) de récupérer le Dernier $id de l'entité Physical et Personnality
// pour pouvoir mettre dans le fichier
// Register
// et faire en sorte de faire
// $user -> setPhysical($lastIdPhysical);
// tu vois le truc ?
// en SQL SELECT id FROM personnality ORDER BY id DESC LIMIT 1; 
// comme ca tu peux récupérer le résultat pour le mettre dans $user 
// Bonne nuit !! Au pire demain quand je rentrerai chez moi on refait pareille 