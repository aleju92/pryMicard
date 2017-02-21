<?php

namespace AppBundle\Controller;

use AppBundle\Form\EmpresaType;
use AppBundle\Form\SolicitudType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Empresa;

class EmpresasController extends Controller
{
    /**
     * @Route("/emp/registro", name="registroemp")
     */

    public function empAction(Request $request)
    {
        
        return $this->render("emp/regempresa.html.twig");
    }

    /**
     * @Route("/emp/miiempresa", name="perfilemp")
     */

    public function indexAction()
    {
        return $this->render("emp/miiempresa.html.twig");
    }

    /**
     * @Route("/emp/solicitud", name="solicitudemp")
     */

    public function soliAction(Request $request)
    {
        $empresa = new Empresa();
        $form = $this->createForm('AppBundle\Form\SolicitudType', $empresa);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($empresa);
            $em->flush($empresa);


             $this->get('session')->getFlashBag()->add(
                    'mensaje',
                    'Solicitud enviada correctamente este atento a una llamada desde nuestra central ' 
                    );

             return $this->redirectToRoute('solicitudemp');
        }
        


        return $this->render('emp/solicitud.html.twig', array(
            'empresa' => $empresa,
            'form' => $form->createView(),
        ));
    }

    /**
     *
     * @Route("/emp/registro",name="reg_empresa");
     *
     */
    public function registrarAction(Request $request){
        $emp= new Empresa();
        $form=$this->createForm(EmpresaType::class, $emp);
        $form->handleRequest($request);
        $em=$this->getDoctrine()->getManager();
        $em->persist($emp);
        $em->flush();
        $Emp=$this->EmpAll();
        return $this->render("PwMCMainBundle:emp:registroe.html.twig",array("mensaje"=>$ms,"Admin"=>$Emp));
    }

    private function empAll(){
        $em=$this->getDoctrine()->getManager();
        $empresas= $em->getRepository('AppBundle:Empresa')->findAll();
        return $empresas;
    }






}
