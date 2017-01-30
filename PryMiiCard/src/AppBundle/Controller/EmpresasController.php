<?php

namespace AppBundle\Controller;

use AppBundle\Form\EmpresaType;
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
        $form = $this->createForm(EmpresaType::class);
        $form->handleRequest($request);
        return $this->render("emp/regempresa.html.twig",array("form"=>$form->createView()));
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

    public function soliAction()
    {
        return $this->render('emp/solicitud.html.twig');
    }

    /**
     *
     * @Route("/emp/registro",name="reg_empresa");
     *
     */
    public function addEmpAction($nomEmp,$usrEmp,$pasEmp,$rucEmp,$tlfEmp,$pagEmp,$logEmp,$slogEmp){
        $emp= new Empresa();
        $emp->setNomEmp($nomEmp);
        $emp->setUsrEmp($usrEmp);
        $emp->setPasEmp($pasEmp);
        $emp->setRucEmp($rucEmp);
        $emp->setTlfEmp($tlfEmp);
        $emp->setPagEmp($pagEmp);
        $emp->setLogEmp($logEmp);
        $emp->setSlgEmp($slogEmp);

        $em=$this->getDoctrine()->getManager();
        $em->persist($emp);
        $em->flush();
        $Emp=$this->EmpAll();
        $ms="La Empresa (".$nomEmp.") ha sido registrada con exito";
        return $this->render("PwMCMainBundle:emp:registroe.html.twig",array("mensaje"=>$ms,"Admin"=>$Emp));
    }

    private function empAll(){
        $em=$this->getDoctrine()->getManager();
        $empresas= $em->getRepository('AppBundle:Empresa')->findAll();
        return $empresas;
    }






}
