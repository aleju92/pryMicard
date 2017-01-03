<?php

namespace PwMCMainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use PwMCMainBundle\Entity\Administrador;

class SAdminController extends Controller
{
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
    			return  $this->redirect($this->generateUrl("pw_mc_main_admins"));
    			//return $this->render("PwMCMainBundle:sa:".$page.".html.twig",array("menssaje"=>' '));
    		}    		
    	}else{
    		return  $this->redirect($this->generateUrl("pw_mc_main_adminp"));
    	}
    	
    }
}
