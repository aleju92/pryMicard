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
    	switch ($page) {
            case 'categorias':
                return $this->redirectToRoute('catgegoria_index');
                break;
            case 'admins':
                return $this->redirectToRoute('administradores_all');
                break;
            case 'Mi_Perfil':
                return $this->redirectToRoute("miPerfilSa",array("idUser"=>1));
                break;
            default:
                return $this->redirectToRoute('indexSAdmin');
        }
    }
}
