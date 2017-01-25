<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



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
	
	public function registerAction(Request $request){
		$user=new Usuario();
		$form=$this->createForm(UsuarioType::class);
		$form->handleRequest($request);
		//$ms='';
		//$usuarios=$this->usAll();
		if($form->isSubmitted() && $form->isValid()){
			$user=$form->getData();
			//ENCODE THE PASSWORD
			$password = $this->get('security.password_encoder')
				->encodePassword($user, $user->getPlainPassword());
			$user->setPass($password);
			//----------------------
			$em=$this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();
			//$usuarios=$this->usAll();
			/*$ms="Se ha registrado con éxito";
			$this->addFlash('success', $ms);*/
			return $this->render("security/login.html.twig",array("form"=>$form->createView()));
			
		}
		return $this->render('user/registrarse.html.twig',array("form"=>$form->createView()));
	}
	
	
	/**
	 * @Route("/usuario/miiperfil", name="user_perfil")
	 */
	
	public function miperfilAction(){
		return $this->render('user/miiperfil.html.twig',array("menssaje"=>'',"Admin"=>'1'));
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
	
	private function usAll(){
		$em=$this->getDoctrine()->getManager();
		$usuario= $em->getRepository('AppBundle:Usuario')->findAll();
		return $usuario;
	}
	
	
}
