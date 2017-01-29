<?php

namespace AppBundle\Controller;

use AppBundle\Form\AdministradorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Administrador;

class AdminsController extends Controller
{

	/**
     * @Route("/sa/admins/all", name="administradores_all")
     */
    public function getAdmisAction(){
    	$Admin=$this->AdminAll();
    	$ms='';
    	return $this->render("sa/admins.html.twig",array("menssaje"=>$ms,"Admins"=>$Admin,"Admin"=>null));
    }
    /**
     * @Route("/sa/admins/xid/{id}", name="getAdmin")
     */
    public function  getAdminXidAction($id){
        $Admins=$this->AdminAll();
        $ms='';
    	$em=$this->getDoctrine()->getManager();
    	$admin=$em->find("AppBundle:Administrador", $id);
    	if($admin==null){
    	    $ms="El usuario administrador con id=".$id."No se encientra registrado";
        }
        return $this->render("sa/admins.html.twig",array("menssaje"=>$ms,"Admins"=>$Admins,"Admin"=>$admin));
    }

    /**
     * @Route("/sa/Mi_Perfil/{idUser}", name="miPerfilSa")
     */
    public function miPerfil(Request $request, $idUser){

        $em=$this->getDoctrine()->getManager();
        $adminUser=$em->find("AppBundle:Administrador", $idUser);
        if(!$adminUser){
            return $this->redirectToRoute('indexSAdmin');
        }else{
            $form=$this->createForm(AdministradorType::class, $adminUser);
            $form->get('path')->setData($adminUser->getPathPhotoAdm());
            $form->handleRequest($request);
            if($form->isSubmitted()){
                if( $form->isValid()){
                    $adminUser=$form->getData();

                    //encriptacion de passwprd
                    $password=$this->get('security.password_encoder')
                        ->encodePassword($adminUser,$adminUser->getPasswordTemp());
                    $adminUser->setPassAdm($password);

                    //Subir la foto
                    $img=$form['photoAdm']->getData();
                    $ext=$img->guessExtension();
                    $file_name=time().".".$ext;
                    
                    //subir la foto al repositorio
                    $img->move("AdminPerfil",$file_name);
                    
                    $adminUser->setPhotoAdm($file_name);

                    $em->persist($adminUser);
                    $em->flush();
                    $ms="Sus datos han sido modificado correctamente";
                    $tms='success';
                }else{
                    $ms="Error!!!, los datos son incorrectos ";
                    $tms='error';
                }
                $this->addFlash($tms,$ms);
            }
        }
        return $this->render("sa/miperfil.html.twig",array('Form'=>$form->createView()));
    }
    private function AdminAll(){
    	$em=$this->getDoctrine()->getManager();
    	$Administadores= $em->getRepository('AppBundle:Administrador')->findAll();
    	return $Administadores;
    }
    public function ayudaAction()
    {
    	return new Response("<html><body>hola</body></html>");
    }
}
