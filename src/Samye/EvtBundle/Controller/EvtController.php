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
	
	public function pendingAction()
    {
      	return $this->render('SamyeEvtBundle:futureFunctions:pending.html.twig');
    }
	
	public function personalEventsAction() {
		
		$user = $this->container->get('security.context')->getToken()->getUser();

		$repository = $this	->getDoctrine()
							->getManager()
							->getRepository('SamyeEvtBundle:Event');
		
		//affiche les événements en fonction de l'utilisateur connecté
		$eventList = $repository->findBy(array('author' => $user));
		
		return $this->render('SamyeEvtBundle:Evt:myevents.html.twig', array('events' => $eventList));
	}
	
	
	public function allEventsAction() {

		$user = $this->container->get('security.context')->getToken()->getUser();
		
		$repository = $this	->getDoctrine()
							->getManager()
							->getRepository('SamyeEvtBundle:Event');
		
		//affiche les événements en fonction de l'utilisateur connecté
		$eventList = $repository->findBy(array('status' => 1));
		
		return $this->render('SamyeEvtBundle:Evt:allEvents.html.twig', array('events' => $eventList));
	}
	
	public function addEventAction(){
		$user = $this->container->get('security.context')->getToken()->getUser();
			
		$repository = $this	->getDoctrine()
							->getManager()
							->getRepository('SamyeEvtBundle:Event');
		
		$eventList = $repository->findBy(array('status' => 1));
		
		$event = new Event();
		
		$form = $this->createForm(new EventType,$event);
		
		$request = $this->get('request');
		if($request->getMethod() == 'POST') {
			$form->bind($request);
			
			if($form->isValid()){
				$em = $this->getDoctrine()->getManager();
				$event->setAuthor($user);
				$em->persist($event);
				$em->flush();
				
				return $this->redirect($this->generateUrl('samye_evt'));
			}
		}
		
		return $this->render('SamyeEvtBundle:Evt:ajouter.html.twig',array(
																		'form' => $form->createView(),
																		'user' => $user,
																		'events'=> $eventList
																		));
	}
	
	public function showEventAction(Event $event){
		$rq = $this->getRequest();

		if ($rq -> isXmlHttpRequest()) {
			
			$recId = $rq->request->get("id");
			
			if (!$event) {
        	throw $this->createNotFoundException('Aucun événement trouvé pour cet id : '.$id);
	    	}
			
			$user = $this->container->get('security.context')->getToken()->getUser();
	
			$repository = $this	->getDoctrine()
								->getManager()
								->getRepository('SamyeEvtBundle:Event');
			
			//affiche les événements en fonction de l'utilisateur connecté
			$eventList = $repository->findBy(array('id' => $recId));			
			
			foreach ($eventList as $evt) {
				
				$dateDeb = $evt->getDateDeb()->format("d - m - Y");
				$heureDeb = $evt->getHeureDeb()->format("H:i:s");
				$heureFin = $evt->getHeureFin()->format("H:i:s");
				
				
				$tab[] = array(
								'id' => $evt->getId(),
								'libelle' => $evt->getLibelle(),
								'date' => $dateDeb,
								'heureDeb' => $heureDeb,
								'heureFin' => $heureFin,
								'lieu' => $evt->getLieu(),
								'categorie' =>$evt->getCategory()->getLibelle(),
								'status'=> $evt->getStatus()->getLibelle(),
								'participation' => $evt->getParticipation(),
								'description' => $evt->getDescription(),
								'auteur' => $evt->getAuthor()->getUsername()
								);
			}		
		}
				
		$response = new Response(json_encode($tab));		
		$response->headers->set('Content-Type', 'application/json');
		
		return $response;

		
		//return $this->render('SamyeEvtBundle:Evt:showEvent.html.twig', array('event' => $event, 'events' => $eventList));
	}
	
	public function modifyEventAction(Event $event){
		
		$repository = $this	->getDoctrine()
							->getManager()
							->getRepository('SamyeEvtBundle:Event');
		
		//affiche les événements en fonction de l'utilisateur connecté
		$eventList = $repository->findBy(array('status' => 1));
			
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
		
		return $this->render('SamyeEvtBundle:Evt:modify.html.twig',array('form' => $form->createView(), 'event'=>$event, 'events'=>$eventList));
	}	
	
	public function deleteEventAction(Event $event){
		
		$em = $this->getDoctrine()->getManager();
		
		if (!$event) {
			throw $this->createNotFoundException('Unable to find this entity.');
		}

		$em->remove($event);
		$em->flush();
		
		return $this->redirect($this->generateUrl('samye_evt'));
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
