<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search_index")
     */
    public function index(Request $request, UserRepository $userRepository): Response
    {
        
        $data = new SearchData;
        $form = $this->createForm(SearchType::class, $data);
        

        $form->handleRequest($request);    
        $users = $userRepository->getResultFilter($data);
        // var_dump($data);   
        return $this->render('search/index.html.twig', [
           'users' => $users,
            'form' => $form->createView(),

        ]);
    }
}
