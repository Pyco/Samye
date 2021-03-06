<?php

namespace Samye\EvtBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Samye\EvtBundle\Entity\EvtCategory;
use Samye\EvtBundle\Form\EvtCategoryType;

class CategoriesController extends Controller
{
  public function categoriesAction()
  {
	  	$categoryList = $this	->getDoctrine()
								->getRepository('SamyeEvtBundle:EvtCategory')
								->findAll();
		
		return $this->render('SamyeEvtBundle:Categories:categories.html.twig', array('categories' => $categoryList));
  }
  
  public function showCategoryAction($id)
  {
	 	$user		= $this->container->get('security.context')->getToken()->getUser();
		
		$categoryList = $this	->getDoctrine()
								->getRepository('SamyeEvtBundle:EvtCategory')
								->findAll();
		
		
		$category	= $this	->getDoctrine()
							->getRepository('SamyeEvtBundle:EvtCategory')
							->find($id);
		
		if (!$category) {
        	throw $this->createNotFoundException('Aucune catégorie trouvée pour cet id : '.$id);
    	}

		$repository = $this	->getDoctrine()
							->getManager()
							->getRepository('SamyeEvtBundle:Event');
		
		$events 	= $repository->findBy(array('author' => $user, 'category' => $category));
		
		return $this->render('SamyeEvtBundle:Categories:byCategory.html.twig', array('cat' => $category, 'events' => $events, 'categories' => $categoryList));
		
  }
  
  public function addCategoryAction()
  {
	  $categoryList = $this	->getDoctrine()
							->getRepository('SamyeEvtBundle:EvtCategory')
							->findAll();
		
	  	 
	  $category = new EvtCategory();
		
		$form = $this->createForm(new EvtCategoryType,$category);
		
		$request = $this->get('request');
		if($request->getMethod() == 'POST') {
			$form->bind($request);
			
			if($form->isValid()){
				$em = $this->getDoctrine()->getManager();
				$em->persist($category);
				$em->flush();
				
				return $this->redirect($this->generateUrl('samye_add_category'));
			}
		}
		
		return $this->render('SamyeEvtBundle:Categories:ajouter.html.twig',array('form' => $form->createView(),'categories' => $categoryList));
  }
  
  	public function modifyCategoryAction(EvtCategory $category){
			
		$categoryList = $this	->getDoctrine()
								->getRepository('SamyeEvtBundle:EvtCategory')
								->findAll();
			
		$em = $this->getDoctrine()->getManager();
		$cat = $em->getRepository('SamyeEvtBundle:EvtCategory')->find('$category'); 
		$form = $this->createForm(new EvtCategoryType(),$category);
		
		$request = $this->get('request');
		
		if($request->getMethod() == 'POST') {
			$form->bind($request);
			
			if($form->isValid()){
				$em = $this->getDoctrine()->getManager();
				$em->persist($category);
				$em->flush();
				
				return $this->redirect($this->generateUrl('samye_add_category'));
			}
		}
		if (!$category) {
			throw $this->createNotFoundException('Unable to find this entity.');
		}

		//CODE
		$em->persist($category);
		$em->flush();
		
		return $this->render('SamyeEvtBundle:Categories:modify.html.twig',array('form' => $form->createView(),'categories' => $categoryList));
	}	
	
	public function deleteCategoryAction(EvtCategory $category){
			
		
		$em = $this->getDoctrine()->getManager();
		
		if (!$category) {
			throw $this->createNotFoundException('Unable to find this entity.');
		}

		$em->remove($category);
		$em->flush();
		
		return $this->redirect($this->generateUrl('samye_add_category'));
	}
}