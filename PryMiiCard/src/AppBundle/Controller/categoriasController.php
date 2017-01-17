<?php

namespace AppBundle\Controller;

use AppBundle\Form\CategoriaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Categoria;
use Symfony\Component\HttpFoundation\Response;
//use PwMCMainBundle\Form\CategoriaType;

class categoriasController extends Controller
{
	/**
	 *
         * @Route("/sa/categorias/nuevo",name="catgegoria_add");
	 *
	 */
    public function addCatAction(Request $request){
        $form =$this->createForm(CategoriaType::class);
        $form->handleRequest($request);
        $ms='';
        $categorias= $this->catAll();
        if ($form->isSubmitted() && $form->isValid()){
            $Categoria= $form->getData();
            $Categoria->setEstado(1);
            $em=$this->getDoctrine()->getManager();
            $em->persist($Categoria);
            $em->flush();
            $categorias= $this->catAll();
            $ms="La categoria  ha sido ingresada con exito";
            //$form="";
            return $this->render("sa/categorias.html.twig",array("menssaje"=>$ms,"categorias"=>$categorias,"categoria"=>null,"form"=>$form->createView()));

        }
    	//$form=$this->createForm(new CategoriaType(),$Categoria);
    	//$form->handleRequest($request);

    	return $this->render("sa/categorias.html.twig",array("menssaje"=>$ms,"categorias"=>$categorias,"categoria"=>null,"form"=>$form->createView()));
    	//return $this->render("sa/categorias.html.twig",array("menssaje"=>$ms,"categorias"=>$categorias));
    }

    /**
     *
     */
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
    
    /**
     *
     * @Route("/sa/categorias/all",name="catgegoria_all");
     *
     */
    public function getCatsAction(){
    	$categorias= $this->catAll();
    	/*
    	$ms="Categorias<br>";
    	foreach ($categorias as $categoria){
    		$ms.=$categoria->getId()."=".$categoria->getDesCat()."<br>";
    	}
    	//return new Response("<html><body>hola</body></html>");
    	return new Response($ms);*/    	    	
    	return $this->render("sa/categorias.html.twig",array("menssaje"=>'',"categorias"=>$categorias,"categoria"=>null));
    }
    /**
     *
     * @Route("/sa/categorias/xid/{id}",name="get_Categoria",requirements={"id": "\d+"});
     *
     */
    public function getCatXidAction($id){
        $form =$this->createForm(CategoriaType::class);
        $categorias= $this->catAll();
    	$em=$this->getDoctrine()->getManager(); 
    	$categoria=$em->find('AppBundle:Categoria',$id);
    	if ($categoria==null){
    	    $ms="La categoria con id=".$id." no EXISTE";
        }else{
    	    $ms="";
        }
        return $this->render("sa/categorias.html.twig",array("menssaje"=>$ms,"categorias"=>$categorias,"categoria"=>$categoria,"form"=>$form->createView()));
//        return new Response ($categoria->getId()."=".$categoria->getDesCat()."<br>");
    }

    public function getCatsactAction(){
        $em=$this->getDoctrine()->getManager();
        $categorias= $em->find('AppBundle:Categoria');
        return $categorias;
    }

    private function catAll(){
    	$em=$this->getDoctrine()->getManager();
    	$categorias= $em->getRepository('AppBundle:Categoria')->findAll();
    	return $categorias;
    }
}
