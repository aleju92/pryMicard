<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
	/**
	 * @Route("/user", name="user_index");
	 */
	public function indexAction()
	{
		return $this->render('user/index.html.twig');
	}
	
	/**
	 * @Route("/comentarios/{page}", name="user_pageselect");
	 */
	public function pageselectAction($page)
	{
		if($page =="registrarse" || $page=="miiperfil" || $page=="miicard"){
			return $this->render("user/".$page.".html.twig",array("mensaje"=>''));
		}else{
			return  $this->redirect($this->generateUrl("pw_mc_main_userp"));
		}
		 
	}
	
	public function ayudaAction()
	{
		return new Response("<html><body>hola</body></html>");
	}
}
