<?php

namespace App\Manager;

use App\Entity\Physical;
use App\Form\PhysicalType;
use App\Repository\PhysicalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PhysicalManager extends AbstractController
{
    public function createPhysical(Physical $physical)
    {     
        $form = $this->createForm(PhysicalType::class, $physical);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();  
            $em->persist($physical);
            $em->flush();

            return $this->redirectToRoute('app_register', []);
        }
    }

    public function editPhysical($id, PhysicalRepository $physicalRepository)
    {
        $physical = $physicalRepository->find($id);
        $form = $this->createForm(PhysicalType::class, $physical);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('physical_index', []);
        }
    }

}
