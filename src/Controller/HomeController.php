<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     */
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll([], []);

        
    



        
        return $this->render('home/index.html.twig', [
            'users' => $users,
            
        ]);
    }
}
