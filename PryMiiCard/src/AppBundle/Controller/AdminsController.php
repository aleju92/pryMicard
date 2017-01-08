<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Administrador;

class AdminsController extends Controller
{
	/*
    public function indexAction()
    {
        return $this->render('PwMCMainBundle:sa:index.html.twig');
    }
    
    public function pageselectAction($page)
    {
    	if($page =="categorias" || $page=="admins"){
    		if($page=="categorias"){
    			return  $this->redirect($this->generateUrl("pw_mc_main_catgetall"));
    		}else{
    			return $this->render("PwMCMainBundle:sa:".$page.".html.twig",array("menssaje"=>' '));
    		}    		
    	}else{
    		return  $this->redirect($this->generateUrl("pw_mc_main_adminp"));
    	}
    	
    }*/
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
    public function getAdmisAction(){
    	$Admin=$this->AdminAll();
    	$ms='';
    	return $this->render("PwMCMainBundle:sa:admins.html.twig",array("menssaje"=>$ms,"Admin"=>$Admin));
    }
    public function  getAdminXidAction($id){
    	$em=$this->getDoctrine()->getManager();
    	$admin=$em->find("PwMCMainBundle:Administrador", $id);
    	return new Response($admin->getId()."=>".$admin->getUseAdm());
    }
    private function AdminAll(){
    	$em=$this->getDoctrine()->getManager();
    	$Administadores= $em->getRepository('PwMCMainBundle:Administrador')->findAll();
    	return $Administadores;
    }
    public function ayudaAction()
    {
    	return new Response("<html><body>hola</body></html>");
    }
}
