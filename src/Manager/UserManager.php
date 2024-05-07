<?php

namespace App\Manager;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserManager extends AbstractController
{
	protected $em;

	public function __construct(EntityManagerInterface $em) 
    {
		$this->em = $em;
	}

    public function editUser($id, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);
        $form = $this->createForm(UserType::class, $user);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('user_index', []);
        }
    }

}
