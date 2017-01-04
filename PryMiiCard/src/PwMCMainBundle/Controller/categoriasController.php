<?php

namespace PwMCMainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PwMCMainBundle\Entity\Categoria;
use Symfony\Component\HttpFoundation\Response;
//use PwMCMainBundle\Form\CategoriaType;

class categoriasController extends Controller
{
    public function addCatAction($descripcion){
    	$Categoria= new Categoria();
    	$Categoria->setDesCat($descripcion);
    	$Categoria->setEstado(1);
    	
    	$categorias= $this->catAll();
    	$em=$this->getDoctrine()->getManager();
    	$em->persist($Categoria);
    	$em->flush();
    	//$form=$this->createForm(new CategoriaType(),$Categoria);
    	//$form->handleRequest($request);
    	$ms="La categoria ".$descripcion." ha sido ingresada con exito";
    	//return $this->render("PwMCMainBundle:sa:formCat.html.twig",array("menssaje"=>$ms,"form",$form->createView()));
    	return $this->render("PwMCMainBundle:sa:categorias.html.twig",array("menssaje"=>$ms,"categorias"=>$categorias));
    }
    public function editCatAction($id,$descripcion){
    	/*if(isset($descripcion)||$descripcion==" "){
    		$ms="Descripcion no definida";
    	}else{*/
    	$categorias= $this->catAll();
	    	$em=$this->getDoctrine()->getManager();
	    	$categoria=$em->find('PwMCMainBundle:Categoria',$id);
	    	if(!$categoria){
	    		$ms="No existe esa categoria con el registro: ".$id;
	    	}else{
	    		$ms="Ha sido modificada la categoria con Código: ".$id;
	    		$categoria->setDesCat($descripcion);
	    		$em->flush();
	    	}
    	//}*/
    	return $this->render("PwMCMainBundle:sa:categorias.html.twig",array("menssaje"=>$ms,"categorias"=>$categorias));    	
    }
    public function deleteCatAction($id,$estado){
    	$categorias= $this->catAll();
    	$em=$this->getDoctrine()->getManager();
    	$categoria=$em->find('PwMCMainBundle:Categoria',$id);
    	if(!$categoria){
    		$ms="No existe esa categoria con el registro: ".$id;
    	}else{
    		$ms="Ha sido eliminada la categoria con Código: ".$id;
	    	$categoria->setEstado($estado);
	    	$em->flush();
    	}
    	return $this->render("PwMCMainBundle:sa:categorias.html.twig",array("menssaje"=>$ms,"categorias"=>$categorias));
    }
    public function getCatsAction(){
    	$categorias= $this->catAll();
    	/*
    	$ms="Categorias<br>";
    	foreach ($categorias as $categoria){
    		$ms.=$categoria->getId()."=".$categoria->getDesCat()."<br>";
    	}
    	//return new Response("<html><body>hola</body></html>");
    	return new Response($ms);*/    	    	
    	return $this->render("PwMCMainBundle:sa:categorias.html.twig",array("menssaje"=>'',"categorias"=>$categorias));
    }
    public function getCatXidAction($id){
    	$em=$this->getDoctrine()->getManager(); 
    	$categoria=$em->find('PwMCMainBundle:Categoria',$id);
    	return new Response ($categoria->getId()."=".$categoria->getDesCat()."<br>");
    }
    private function catAll(){
    	$em=$this->getDoctrine()->getManager();
    	$categorias= $em->getRepository('PwMCMainBundle:Categoria')->findAll();
    	return $categorias;
    }
}
