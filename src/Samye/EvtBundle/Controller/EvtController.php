<?php

namespace Samye\EvtBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EvtController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SamyeEvtBundle:Evt:index.html.twig', array('name' => $name));
    }
	
	public function testAction() {
		return new Response("test");
	}
}
