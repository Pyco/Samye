<?php

namespace Samye\EvtBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Samye\EvtBundle\Entity\Event;
use Samye\EvtBundle\Form\EventType;

class EvtController extends Controller {

	public function indexAction()
    {
    	$event = new Event();
		$form = $this->createForm(new EventType,$event);		
			
      	return $this->render('SamyeEvtBundle:Evt:index.html.twig', array('form' => $form->createView()));
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
		
		if (!$event) {
			throw $this->createNotFoundException('Unable to find this entity.');
		}

		$em->flush();
		
		return $this->render('Samye:Evt:modify.html.twig');
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

	public function addEvtCalAction() {
		
		
		$rq = $this->getRequest();

		if ($rq -> isXmlHttpRequest()) {
		$recLieu = $rq->request->get("lieu");
		
		$em = $this->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		
		$qb->select('e')
                  ->from('SamyeEvtBundle:Event', 'e')
                   ->where("e.lieu = :lieu")
                  ->setParameter('lieu', $recLieu);
		
		$lesEvents = $qb->getQuery()->getResult();
		
		foreach ($lesEvents as $evt) {
			$tab[] = array(
							'id' => $evt->getId(),
							'libelle' => $evt->getLibelle(),
							'dateDeb' => $evt->getDateDeb(),
							);
		}
				
		$response = new Response(json_encode($tab));		
		$response->headers->set('Content-Type', 'application/json');
		
		return $response;
		
		
		/*$response = new Response();
		$response->setContent("pouet");
		return $response;*/
		
		
		
		
		
		}
		
		
	}

}
