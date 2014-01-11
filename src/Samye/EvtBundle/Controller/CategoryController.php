<?php

namespace Samye\EvtBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Samye\EvtBundle\Entity\EvtCategory;
use Samye\EvtBundle\Form\EventType;

class EvtController extends Controller
{
	
	public function indexAction()
    {
      	return $this->render('SamyeEvtBundle:Evt:index.html.twig');
    }
	
	public function eventsAction() {
		
		$repository = $this	->getDoctrine()
							->getManager()
							->getRepository('SamyeEvtBundle:Event');
		
		$eventList = $repository->findAll();
		
		return $this->render('SamyeEvtBundle:Evt:events.html.twig', array('events' => $eventList));
	}
	
	public function addEventAction(){
		
		$event = new Event();
		
		//$form = $this->createForm(new EventType,$event);
		$form = $this->createFormBuilder($event)
					->add('libelle','text')
					->add('dateDeb','date')
					->add('heureDeb','time')
					->add('heureFin','time')
					->add('duree','integer')
					->add('lieu','text')
					->add('category','integer')																									
					->getForm();
					
		$request = $this->get('request');
		if($request->getMethod() == 'POST') {
			$form->bind($request);
			
			if($form->isValid()){
				$em = $this->getDoctrine()->getManager();
				$em->persist($event);
				$em->flush();
				
				return $this->redirect($this->generateUrl('samye_evt'));
			}
		}
		
		return $this->render('SamyeEvtBundle:Evt:ajouter.html.twig',array('form' => $form->createView()));
	}
	
	public function voirAction(){
		
		$repository = $this	->getDoctrine()
							->getManager()
							->getRepository('SamyeEvtBundle:Event');
		
		$eventList = $repository->findAll();
		
		return $this->render('SamyeEvtBundle:Evt:voir.html.twig');
	}
	
	public function modifyAction(Event $event){
		$em = $this->getDoctrine()->getManager();
		$evt = $em->getRepository('SamyeEvtBundle:Event')->find('$event'); 
		$form = $this->createForm(new EventType,$event);
		
		$request = $this->get('request');
		
		if($request->getMethod() == 'POST') {
			$form->bind($request);
			
			if($form->isValid()){
				$em = $this->getDoctrine()->getManager();
				$em->persist($event);
				$em->flush();
				
				return $this->redirect($this->generateUrl('samye_evt'));
			}
		}
		if (!$event) {
			throw $this->createNotFoundException('Unable to find this entity.');
		}

		//CODE
		$em->persist($event);
		$em->flush();
		
		return $this->render('SamyeEvtBundle:Evt:modify.html.twig',array('form' => $form->createView()));
	}	
	
	public function deleteAction(Event $event){
		
		$em = $this->getDoctrine()->getManager();
		
		if (!$event) {
			throw $this->createNotFoundException('Unable to find this entity.');
		}

		$em->remove($event);
		$em->flush();
		
		return $this->render('SamyeEvtBundle:Evt:delete.html.twig');
	}
}