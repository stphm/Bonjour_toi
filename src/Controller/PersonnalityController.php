<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Personnality;
use App\Form\PersonnalityType;
use App\Manager\PersonnalityManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PersonnalityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PersonnalityController extends AbstractController
{
    protected $personnalityManager;


    public function __construct(PersonnalityManager $personnalityManager)
    {
        $this->personnalityManager = $personnalityManager;

    }
    
      /**
     * @Route("/personnality/create", name="personnality_create")
     */
    public function createAction(Request $request)
    {
        $personnality = new Personnality();
        $form = $this->createForm(PersonnalityType::class, $personnality);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {   
            $em = $this->getDoctrine()->getManager();  
            $em->persist($personnality);
            $em->flush();
            
        return $this->redirectToRoute('app_register', []);
        }
       // $this->personnalityManager->createPersonnality($personnality);

        return $this->render('personnality/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    
    /**
     * @Route("user/edit/{id}", name="personnality_edit")
     */
    public function editAction(Request $request, $id, PersonnalityRepository $personnalityRepository) 
    {
        $personality = $personnalityRepository->find($id);

        if(!$personality) {
            throw new NotFoundHttpException("L'utilisateur personnalité n'existe pas");
        }

        $form = $this->createForm(PersonnalityType::class, $personality);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();  
            $em->flush();

            return $this->redirectToRoute('user_index', []);
        }

        return $this->render('personnality/edit.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
