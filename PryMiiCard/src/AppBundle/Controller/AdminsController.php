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

    public function ayudaAction()
    {
    	return new Response("<html><body>hola</body></html>");
    }
}
