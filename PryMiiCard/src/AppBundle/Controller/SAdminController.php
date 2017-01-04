<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/*use Symfony\Component\HttpFoundation\Response;
use PwMCMainBundle\Entity\Administrador;*/

class SAdminController extends Controller
{
	/**
	 * @Route("/sa", name="indexSAdmin")
	 */
	
    public function indexAction()
    {
        return $this->render('sa/index.html.twig');
    }
    
    /**
     * 
     * @Route("/sa/{page}",name="pageSelect");
     * 
     */
    
    public function pageselectAction($page)
    {
    	if($page =="categorias" || $page=="admins"){
    		if($page=="categorias"){
    			return  $this->redirectToRoute('catgegoria_all');
    		}else{
    			return  $this->redirect($this->generateUrl("pw_mc_main_admins"));
    			//return $this->render("PwMCMainBundle:sa:".$page.".html.twig",array("menssaje"=>' '));
    		}    		
    	}else{
    		return  $this->redirectToRoute('indexSAdmin');
    	}
    	
    }
}
