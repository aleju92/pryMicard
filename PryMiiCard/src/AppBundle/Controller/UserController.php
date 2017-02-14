<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
/*use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;*/

class UserController extends Controller 
{
	/**
	 * @Route("/usuario", name="user_index")
	 */
	public function indexAction()
	{	
		$categorias=$this->catAll();
		return $this->render('user/index.html.twig',array('categorias'=>$categorias));
	}
	
	/**
	 * @Route("/usuario/promociones", options={"expose"=true}, name="prom_index")
	 */
	public function promAction(Request $request)
	{	
		if ($request->isXMLHttpRequest()){
			$id = $request->get('id');
			$em = $this->getDoctrine()->getManager();
			$categorias=$em->find("AppBundle:Categoria",$id);
		
			$em = $this->getDoctrine()->getManager();
			$em->flush();
			
			//$categorias=$this->catAll();
			$categorias_html=$this->render('user/formProm.html.twig',array(
	                'categorias'=> $categorias
	            ))->getContent();
			
			return new JsonResponse(array('categorias_html' => $categorias_html));
		}else{
			return $this->redirectToRoute('prom_index');
		}
	}
	
	
	
	/**
	 * @Route("/usuario/logout", name="user_logout")
	 */
	public function logutAction(){
	
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
		if($form->isSubmitted()){
			if($form->isValid()){
				$user=$form->getData();
				//ENCODE THE PASSWORD
				$password = $this->get('security.password_encoder')
					->encodePassword($user, $user->getPlainPassword());
				$user->setPassword($password);
				$user->setEstado(1);
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
			}else{
				$ms='Error!!!!, datos incorrectos';
				$tms='error';
			}
			$this->addFlash($tms, $ms); 
		}
		
		return $this->render('user/registrarse.html.twig',array("form"=>$form->createView()));
	}
	
	/**
	 * @Route("/usuario/miiperfil", name="user_perfil")
	 */
	
	public function miperfilAction(Request $request){
		$user=$this->getUser();
		//if($user->getEstado()== 1){
			$em=$this->getDoctrine()->getManager();
			$form = $this->createForm(UsuarioType::class,$user);
			
			$form->get('path')->setData($user->getPathFoto());
			$form->handleRequest($request);
			$pass=$user->getPassword();
			
			if($form->isSubmitted()){
				if($form->isValid()){
					//$user=$form->getData();
			
					$user->setPassword($pass);
					//Subir la foto
					$img=$form['foto']->getData();
					$ext=$img->guessExtension();
					$file_name=time().".".$ext;
						
					//subir la foto al repositorio
					$img->move("uploads",$file_name);
						
					$user->setFoto($file_name);
								
					
					$em->persist($user);
					$em->flush();
					
					$ms="Sus datos han sido modificado correctamente";
					$tms='success';
					return $this->redirectToRoute('user_perfil');
					
				}else{
					$ms="Error!!!, los datos son incorrectos ";
					$tms='error';
				}
				
				$this->addFlash($tms,$ms);
			}		
				return $this->render("user/miiperfil.html.twig",array("user"=>$user,
						"form"=>$form->createView()));
		/*}else{
			throw new AccessDeniedException();
		}*/
			
	}
	
	/**
	 * @Route("/usuario/miicard", name="user_coin")
	 */
	
	public function micardAction(){
		//$user=$this->getUser();
		//if($user->getEstado()== 1){
			return $this->render('user/miicard.html.twig',array("menssaje"=>''));
		/*}else{
			throw new AccessDeniedException();
		}*/
	}
	
	
	
	/**
	 * @Route("/usuario/miiperfil/down", name="user_delete")
	 */
	public function userdeleteAction(Request $request)
	{	
		$user=$this->getUser();
			if($user->getEstado()==1){
				$user->setEstado(0);
				$ms='fue Desabilitado';
				$tms='error';
				
				$em=$this->getDoctrine()->getManager();
				$em->flush();
				$this->addFlash($tms,$ms);
				return $this->redirectToRoute("user_perfil");
			}else{
				$this->addFlash('error', 'Accion no permitida');
				return $this->redirectToRoute("user_perfil");
			}
	}
	
	private function usAll(){
		$em=$this->getDoctrine()->getManager();
		$usuario= $em->getRepository('AppBundle:Usuario')->findAll();
		return $usuario;
	}
	private function catAll(){
		$em=$this->getDoctrine()->getManager();
		$categorias= $em->getRepository('AppBundle:Categoria')->findAll();
		return $categorias;
	}
	
	
}
