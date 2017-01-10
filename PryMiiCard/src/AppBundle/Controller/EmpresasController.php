<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Empresa;

class EmpresasController extends Controller
{
    /**
     * @Route("/emp/registro", name="registroemp")
     */

    public function empAction()
    {
        return $this->render('emp/registroe.html.twig');
    }

    /**
     * @Route("/emp/solicitud", name="solicitudemp")
     */

    public function soliAction()
    {
        return $this->render('emp/solicitud.html.twig');
    }

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
        return $this->render("PwMCMainBundle:emp:registroe.html.twig",array("menssaje"=>$ms,"Admin"=>$Emp));
    }

    public function modEmpAction($nomEmp)
    {

    }






}
