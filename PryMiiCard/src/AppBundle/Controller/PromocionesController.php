<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Promocion;
use AppBundle\Form\PromocionType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class PromocionesController extends Controller
{
    /**
     * @Route("/emp/promociones", name="promo")
     */
    public function indexAction()
    {
        return $this->render('emp/promocion.html.twig');
    }

    /**
     * @Route("/emp/prueba", name="prueba")
     */

    public function addPromAction(Request $request)
    {
        $form = $this->createForm(PromocionType::class);
        $form->handleRequest($request);
        return $this->render("emp/prueba.htm.twig",array("form"=>$form->createView()));
    }
}
