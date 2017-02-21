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
        if($form->isSubmitted())
        {
            //mp($form);
            $em=$this->getDoctrine()->getManager();
            $empresa=$em->find('AppBundle:Empresa', 1);
            if($form->isValid()){
                $promocion=$form->getData();
                $promocion->setEstProm(1);
                $promocion->setEmpPromFk($empresa);
                $em=$this->getDoctrine()->getManager();
                $em->persist($promocion);
                $em->flush();
                
                $ms = "Promocion registrada con exito";
                $this->addFlash('success',"$ms");
                return $this->render("emp/regpromocion.html.twig",array("form"=>$form->createView()));
            }else{
                $ms = "error";
                $this->addFlash('error',"$ms");
                return $this->render("emp/regpromocion.html.twig",array("form"=>$form->createView()));
            }
        }
        $ms = "submit pero no valido";
        $this->addFlash('error',"$ms");
        return $this->render("emp/regpromocion.html.twig",array("form"=>$form->createView()));
    }

    /**
     * @Route("/emp/promociones/listar", name="listpromo")
     */
    public function listPromoAction(Request $request)
    {
        $promociones=$this->promAll();
        $categorias=$this->cargarCat();
        return $this->render('emp/promociones.html.twig',array('categorias'=>$categorias,'promociones'=>$promociones));
    }

    /**
     * @Route("/emp/promociones/modificar", name="modifpromo")
     */
    public function modPromAction(Request $request,$id)
    {
        $promocion=$this->promAll();
        $em=$this->getDoctrine()->getManager();
        $promociones=$em->find('AppBundle:Promocion',$id);
        if ($promocion==null)
        {
            $ms="La promocion no existe";
            $this->addFlash('error',"$ms");
            return $this->redirectToRoute("listpromo");
        }else{
            try{
                $form=$this->createForm(PromocionType::class,$promocion);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid())
                {
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($promocion);
                    $em->flush();
                    $ms="Promocion Modificada";
                    $this->addFlash('succes',"$ms");
                    return $this->redirectToRoute("listarpromo");
                }
            }catch(\PDOException $exception){
                $this->addFlash('error',"Ya existe una promocion con el mismo nombre");
                return $this->redirectToRoute('listarpromo');
            }

        }
        return $this->redirect('emp/promociones.html.twig',array("promociones"=>$promociones,"form2"=>$form->createView()));
    }

    /**
     * @Route("/emp/promociones/eliminar", name="elimpromo")
     */

    public function delPromoAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $promociones=$this->promAll();
        $promocion=$em->find('AppBundle:Promocion',$id);
        if ($promocion==null)
        {
            $ms="La promocion no existe";
            $this->addFlash('error',"$ms");
            return $this->redirectToRoute("listpromo");
        }else{
            $form=$this->createForm($promocion);
            $form->handleRequest($request);
            $form->get('estado')->setData($promocion->getEstado());
        }
    }


    private function cargarCat()
    {
        $em=$this->getDoctrine()->getManager();
        $categorias= $em->getRepository('AppBundle:Categoria')->findAll();
        return $categorias;
    }
    private function promAll(){
        $em=$this->getDoctrine()->getManager();
        $promociones= $em->getRepository('AppBundle:Promocion')->findAll();
        return $promociones;
    }
}
