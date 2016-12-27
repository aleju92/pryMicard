<?php

namespace PwMCMainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SAdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('PwMCMainBundle:sa:index.html.twig');
    }
    
    public function pageselectAction($page)
    {
    	if($page =="categorias" || $page=="admins"){
    		return $this->render("PwMCMainBundle:sa:".$page.".html.twig",array());
    	}else{
    		return  $this->redirect($this->generateUrl("pw_mc_main_adminp"));
    	}
    	
    }
    
    public function ayudaAction()
    {
    	return new Response("<html><body>hola</body></html>");
    }
}
