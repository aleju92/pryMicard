<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UserController extends Controller
{
	/**
	 * @Route("/usuario", name="user_index")
	 */
	public function indexAction()
	{
		return $this->render('user/index.html.twig');
	}
	
	/**
	 * @Route("/registrate", name="user_register")
	 */
	
	public function registerAction(){
		return $this->render('user/registrarse.html.twig',array("menssaje"=>''));
	}
	
	
	/**
	 * @Route("/usuario/miiperfil", name="user_perfil")
	 */
	
	public function miperfilAction(){
		return $this->render('user/miiperfil.html.twig',array("menssaje"=>''));
	}
	
	

	/**
	 * @Route("/usuario/miicard", name="user_coin")
	 */
	
	public function micardAction(){
		return $this->render('user/miicard.html.twig',array("menssaje"=>''));
	}
	
	
	
	/**
	 * @Route("/usuario/{page}", name="user_pageselect")
	 */
	public function pageselectAction($page)
	{
		switch ($page) {
			case 'Mi_iPerfil':
				return $this->redirectToRoute('');
				break;
			case 'Mi_iCard':
				return $this->redirectToRoute('');
				break;
			default:
				return $this->redirectToRoute('user_index');
		}
		
		
		/*if( $page=="miiperfil" || $page=="miicard"){
			return $this->render("user/".$page.".html.twig",array("menssaje"=>''));
		}else{
			return  $this->redirect($this->generateUrl("pw_mc_main_userp"));
		}*/
		 
	}
	
	
}
