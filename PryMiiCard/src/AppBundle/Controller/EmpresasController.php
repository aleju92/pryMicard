<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
    /**
     * @Route("/emp/{page}", name="user_pageselectemp")
     */
    public function pageselectAction($page)
    {


    	return $this->render("emp/".$page.".html.twig");
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
    /**
     * @Route("/emp/regs/p", name="user_emp")
     */
    public function registarAction(){
        $cats=$this->catAll();
        return $this->render("emp/promocion.html.twig",array("categorias"=>$cats));
    }


    private function catAll(){
        $em=$this->getDoctrine()->getManager();
        $categorias= $em->getRepository('AppBundle:Categoria')->findAll();
        return $categorias;
    }
}
