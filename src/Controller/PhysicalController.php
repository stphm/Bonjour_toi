<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Physical;
use App\Form\PhysicalType;
use App\Manager\PhysicalManager;
use App\Repository\UserRepository;
use App\Repository\PhysicalRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PhysicalController extends AbstractController
{

    protected $physicalManager;

    public function __construct(PhysicalManager $physicalManager)
    {
        $this->physicalManager = $physicalManager;
    }

      /**
     * @Route("/physical", name="physical")
     */
    public function index(): Response
    {
        return $this->render('physical/index.html.twig', [
            'controller_name' => 'PhysicalController',
        ]);
    }

      /**
     * @Route("physical/create", name="physical_create")
     */
    public function createAction(Request $request)
    {
        $physical = new Physical();
        $form = $this->createForm(PhysicalType::class, $physical);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();  
            $em->persist($physical);
            $em->flush();

            

            return $this->redirectToRoute('personnality_create', []);
        }
        //$this->physicalManager->createPhysical($physical);

        return $this->render('physical/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("user/edit/physical/{id}", name="physical_edit")
     */
    public function editAction(Request $request, $id, PhysicalRepository $physicalRepository) 
    {
        $physical = $physicalRepository->find($id);

        if(!$physical) {
            throw new NotFoundHttpException("L'utilisateur physique n'existe pas");
        }

        $form = $this->createForm(PhysicalType::class, $physical);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();  
            $em->flush();

            return $this->redirectToRoute('user_index', []);
        }

        return $this->render('physical/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
