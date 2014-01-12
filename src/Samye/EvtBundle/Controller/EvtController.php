<?php

namespace Samye\EvtBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Samye\EvtBundle\Entity\Event;
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
	
	public function showEventAction(Event $event){
		
		if (!$event) {
        	throw $this->createNotFoundException('Aucun événement trouvé pour cet id : '.$id);
    	}
		
		return $this->render('SamyeEvtBundle:Evt:showEvent.html.twig', array('event' => $event));
	}
	
	public function modifyEventAction(Event $event){
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
	
	public function deleteEventAction(Event $event){
		
		$em = $this->getDoctrine()->getManager();
		
		if (!$event) {
			throw $this->createNotFoundException('Unable to find this entity.');
		}

		$em->remove($event);
		$em->flush();
		
		return $this->render('SamyeEvtBundle:Evt:delete.html.twig');
	}
	
	public function voirEvtCalAction(){
		
		$repository = $this	->getDoctrine()
							->getManager()
							->getRepository('SamyeEvtBundle:Event');
		
		$eventList = $repository->findAll();
		
		return $this->render('SamyeEvtBundle:Evt:voirCal.html.twig', array('events' => $eventList));
	}
	
	public function evtCalAction() {
		$rq = $this->getRequest();

		if ($rq -> isXmlHttpRequest()) {
		$recId = $rq->request->get("id");
		
		$em = $this->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		
		$qb->select('e')
                  ->from('SamyeEvtBundle:Event', 'e')
                   ->where("e.id = :id")
                  ->setParameter('id', $recId);
		
		$lesEvents = $qb->getQuery()->getResult();
		
		foreach ($lesEvents as $evt) {
			$tab[] = array(
							'id' => $evt->getId(),
							'title' => $evt->getLibelle(),
							'start' => $evt->getDateDeb(),
							);
		}
				
		$response = new Response(json_encode($tab));		
		$response->headers->set('Content-Type', 'application/json');
		
		return $response;
		
		
		/*$response = new Response();
		$response->setContent("pouet");
		return $response;*/
		} else {
		$response = new Response();
		$response->setContent("Caca");
		return $response;
		}
	}
}
