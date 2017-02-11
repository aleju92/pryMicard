<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


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
			$user->setPassword($password);
			//----------------------
			//SUBIR ARCHIVO
				// Recogemos el fichero
				$img=$form['foto']->getData();
				// Sacamos la extensión del fichero
				$ext=$img->guessExtension();
				// Le ponemos un nombre al fichero
				$file_name=time().".".$ext;
				// Guardamos el fichero en el directorio uploads que estará en el directorio /web del framework
				$img->move("uploads", $file_name);
				// Establecemos el nombre de fichero en el atributo de la entidad
				$user->setFoto($file_name);
			//-----------------------
			$em=$this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();
			//$usuarios=$this->usAll();
			/*$ms="Se ha registrado con éxito";
			$this->addFlash('success', $ms);*/
			//return $this->render("security/login.html.twig",array("form"=>$form->createView()));
			return $this->redirectToRoute('login');
			
		}
		return $this->render('user/registrarse.html.twig',array("form"=>$form->createView()));
	}
	
	/**
	 * @Route("/usuario/miiperfil", name="user_perfil")
	 */
	
	public function miperfilAction(Request $request){
		$user=$this->getUser();
		$form = $this->createFormBuilder($user)
			->add('nombre', TextType::class,array('required'=>true,'disabled'=>'disabled'))
			->add('apellido', TextType::class,array('required'=>true))
			->add('fechanacim',DateType::class)
			//->add('foto',FileType::class)
			//->add('path',HiddenType,array('mapped'=>false))
			->add('cedula',TextType::class)
			->add('email',EmailType::class,array('required'=>true))
			->add('telefono',TextType::class)
			->add('Guardar',SubmitType::class)
			->getForm();

		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()){
			$user=$form->getData();
			
			$em=$this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();
			return $this->render("user/miiperfil.html.twig",array("user"=>$user));
		}
				
			return $this->render("user/miiperfil.html.twig",array("user"=>$user,
					"form"=>$form->createView()));
			
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
