<?php

namespace App\Manager;

use App\Entity\Personality;
use App\Entity\User;
use App\Entity\Personnality;
use App\Form\PersonnalityType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PersonnalityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonnalityManager extends AbstractController
{
    public function createPersonnality(Personnality $personnality)
    {                       
        $form = $this->createForm(PersonnalityType::class, $personnality);
        if ($form->isSubmitted() && $form->isValid()) {   
            
            $em = $this->getDoctrine()->getManager();  
            $em->persist($personnality);
            $em->flush();

        return $this->redirectToRoute('personnality_create', []);
        }
    }

    public function editPersonnality($id, PersonnalityRepository $personnalityRepository)
    {
        $personnality = $personnalityRepository->find($id);
        $form = $this->createForm(PersonnalityType::class, $personnality);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('personnality_index', []);
        }
    }

}
