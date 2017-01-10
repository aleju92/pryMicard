<?php

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Administrador;

class PromocionesController extends Controller
{
    /**
     * @Route("/emp/promociones", name="promo")
     */
    public function indexAction()
    {
        return $this->render('emp/promocion.html.twig');
    }
}
