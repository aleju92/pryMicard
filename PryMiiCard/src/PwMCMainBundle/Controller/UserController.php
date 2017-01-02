<?php

namespace PwMCMainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
	public function indexAction()
	{
		return $this->render('PwMCMainBundle:user:index.html.twig');
	}
	public function ayudaAction()
	{
		return new Response("<html><body>hola</body></html>");
	}
}
