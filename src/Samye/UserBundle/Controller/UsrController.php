<?php

namespace Samye\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Samye\UserBundle\Entity\User;
use Samye\UserBundle\Form\UserType;

class UsrController extends Controller
{
	public function showUsersAction() {
		/*$repository = $this	->getDoctrine()
							->getManager()
							->getRepository('SamyeUserBundle:User');
		
		$usrList = $repository->findAll();*/
		
		$userManager = $this->get('fos_user.user_manager');
		$usrList = $userManager->findUsers();
		
		return $this->render('SamyeUserBundle:Users:showUsr.html.twig', array('users' => $usrList));
		
	}
	
	public function editUserAction(User $user) {
		
		$em = $this->getDoctrine()->getManager();
		$usr = $em->getRepository('SamyeUserBundle:User')->find('$user'); 
		$form = $this->createForm(new FOS\UserBundle\Form\Type\RegistrationFormType,$user);
		
		$request = $this->get('request');
		
		if($request->getMethod() == 'POST') {
			$form->bind($request);
			
			if($form->isValid()){
				$em = $this->getDoctrine()->getManager();
				$em->persist($user);
				$em->flush();
				
				return $this->redirect($this->generateUrl('samye_users'));
			}
		}
		if (!$user) {
			throw $this->createNotFoundException('Unable to find this entity.');
		}

		//CODE
		$em->persist($user);
		$em->flush();
		
		return $this->render('SamyeUserBundle:Registration:register.html.twig',array('form' => $form->createView()));
	}
	
	public function delUserAction() {
		
	}
	
}
	