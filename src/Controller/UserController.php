<?php

namespace App\Controller;

use App\Form\UserType;
use App\Form\PhysicalType;
use App\Manager\UserManager;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends AbstractController
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    
    /**
     * @Route("/user", name="user_index")
     */
    public function index()
    {
        $user = $this->getUser();

        return $this->render('user/index.html.twig', [
            'user' => $user
        ]);
    }

     /**
      * @Route("/user/edit", name="user_edit")
      */
    public function editUserAction(Request $request)
    {
        
       $user = $this->getUser();
        
       if (!$user)
       {
           throw new NotFoundHttpException("L'utilisateur n'existe pas");
       }

       $form = $this->createForm(UserType::class, $user);       

       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

        return $this->redirectToRoute('user_index', []);
    }

      return $this->render('user/edit.html.twig', [
          'user' => $user,
          'form' => $form->createView(),
      ]);
    }

    /**
     * @Route("profile/user/{id}", name="user_show", priority=-1)
     */
    public function showUserAction($id, UserRepository $userRepository) 
    {
        $user = $userRepository->findOneBy([
            'id' => $id
        ]);

        if(!$user) {
            $this->createNotFoundException("l'utilisateur n'existe pas ! ");
        }

        return $this->render('user/show.html.twig', [
            'user'=> $user
        ]);
    }

}
