<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Administrador;

class AdminsController extends Controller
{
	public function addAdminAction($nom,$ape,$email,$use,$pass){
    	$admin= new Administrador();
    	$admin->setNomAdm($nom);
    	$admin->setApeAdm($ape);
    	$admin->setEmAdm($email);
    	$admin->setUseAdm($use);
    	$admin->setPassAdm($pass);
    	$admin->setTipAdm(1);
    	$admin->setEstAdm(1);
    	
    	$em=$this->getDoctrine()->getManager();
    	$em->persist($admin);
    	$em->flush();
    	$Admin=$this->AdminAll();
    	$ms="El usuario (".$nom." ".$ape.") ha sido ingredado con exito";
    	return $this->render("PwMCMainBundle:sa:admins.html.twig",array("menssaje"=>$ms,"Admin"=>$Admin));	
    }
    public function editAdminAction($id,$nom,$ape,$email,$use,$pass){
    	$em=$this->getDoctrine()->getManager();
    	$admin=$em->find("PwMCMainBundle", $id);    	
    	$admin->setNomAdm($nom);
    	$admin->setApeAdm($ape);
    	$admin->setEmAdm($email);
    	$admin->setUseAdm($use);
    	$admin->setPassAdm($pass); 
    	$em->flush();
    	
    	$Admin=$this->AdminAll();
    	$ms="El usuario (".$nom." ".$ape.") ha sido modificado con exito";
    	return $this->render("PwMCMainBundle:sa:admins.html.twig",array("menssaje"=>$ms,"Admin"=>$Admin));
    }
    public function deleteAdminAction($id,$estado){
    	$em=$this->getDoctrine()->getManager();
    	$admin=$em->find("PwMCMainBundle", $id);
    	$Admin=$this->AdminAll();
    	$ms="El usuario (".$admin->getNomAdm()." ".$admin->getApeAdm().") ha sido eliminado con exito";
    	return $this->render("PwMCMainBundle:sa:admins.html.twig",array("menssaje"=>$ms,"Admin"=>$Admin));
    }

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
    	//return new Response($admin->getId()."=>".$admin->getUseAdm());
    }

    /**
     * @Route("/sa/Mi_Perfil/{idUser}", name="miPerfilSa")
     */
    public function miPerfil($idUser){
        $em=$this->getDoctrine()->getManager();
        $admin=$em->find("AppBundle:Administrador", $idUser);
        return $this->render("sa/miperfil.html.twig",array("menssaje"=>" ","Admin"=>$admin));
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
