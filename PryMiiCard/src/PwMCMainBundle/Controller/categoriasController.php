<?php

namespace PwMCMainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PwMCMainBundle\Entity\Categoria;

class categoriasController extends Controller
{
    public function addCatAction($descripcion){
    	$Categoria= new Categoria();
    	$Categoria->setDesCat($descripcion);
    	
    	$em=$this->getDoctrine()->getManager();
    	$em->persist($Categoria);
    	$em->flush();
    	
    	$ms="La categoria ".$descripcion." ha sido ingresada con exito";
    	return $this->render("PwMCMainBundle:sa:categorias.html.twig",array("menssaje"=>$ms));
    }
}
