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
     * @Route("/emp/promociones", name="promociones")
     */
    public function logAction()
    {
        return $this->render("emp/promociones.html.twig");
    }

    /**
     * @Route("/emp/regpromocion", name="regpromo")
     */

    public function addPromAction(Request $request)
    {
        $form = $this->createForm(PromocionType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
            $promocion=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($promocion);
            $em->flush();
            $ms = "Promocion registrada con exito";
            $this->addFlash('success',"$ms");
            return $this->redirectToRoute("regpromo");
        }
        $promocion=$form->getData();
        return $this->render("emp/regpromocion.html.twig",array("promociones"=>$promocion,"promocion"=>null,"form"=>$form->createView()));
    }



    /**
     *
     * @Route("/emp/promociones/all",name="listpromo");
     *
     */
    /**public function listarAction(Request $request){
        $form =$this->createForm(PromocionType::class);
        $form->handleRequest($request);
        $ms='';
        //$promociones= $this->promAll();
        if ($form->isSubmitted() && $form->isValid()){
            $promocion= $form->getData();
            $promocion->setEstado(1);
            $em=$this->getDoctrine()->getManager();
            $em->persist($promocion);
            $em->flush();
            //$promociones= $this->promAll();
            $ms="La promocion  ha sido ingresada con exito";
            $this->addFlash('success',"$ms");
            //return $this->render("sa/promociones.html.twig",array("promociones"=>$promociones,"promocion"=>null,"form"=>$form->createView()));
        }
        //return $this->render("emp/regpromocion.html.twig",array("promociones"=>$promociones,"promocion"=>null,"form"=>$form->createView()));

    }  **/
}
