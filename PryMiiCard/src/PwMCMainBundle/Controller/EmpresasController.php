<?php

namespace PwMCMainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EmpresasController extends Controller
{
    public function indexAction()
    {
        return $this->render('PwMCMainBundle:Default:index.html.twig');
    }
    public function ayudaAction()
    {
    	return new Response("<html><body>hola</body></html>");
    }
    
    public function pageselectAction($page)
    {
    	return $this->render("PwMCMainBundle:emp:".$page.".html.twig");
    	/*
    	if($page =="solicitud" || $page=="registroe"){
    		
    		if($page=="solicitud"){
    			return  $this->redirect($this->generateUrl("pw_mc_main_catgetall"));
    		}else{
    			return  $this->redirect($this->generateUrl("pw_mc_main_admins"));
    			//return $this->render("PwMCMainBundle:sa:".$page.".html.twig",array("menssaje"=>' '));
    		}
    	}else{
    		return  $this->redirect($this->generateUrl("pw_mc_main_adminp"));
    	}*/
    	 
    }
}
