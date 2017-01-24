<?php

namespace AppBundle\Controller;

use AppBundle\Form\CategoriaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Categoria;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class categoriasController extends Controller
{
	/**
	 *
         * @Route("/sa/categorias/index",name="catgegoria_index");
	 *
	 */
    public function indexCatAction(Request $request){
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
            $this->addFlash('success',"$ms");
            return $this->render("sa/categorias.html.twig",array("categorias"=>$categorias,"categoria"=>null,"form"=>$form->createView()));
        }
    	return $this->render("sa/categorias.html.twig",array("categorias"=>$categorias,"categoria"=>null,"form"=>$form->createView()));
    }
    
     /**
     *
     * @Route("/sa/categorias/editar/{id}",name="Categoria_edit",requirements={"id": "\d+"});
     *
     */
    public function editCatAction(Request $request,$id){
        $categorias= $this->catAll();
    	$em=$this->getDoctrine()->getManager(); 
    	$categoria=$em->find('AppBundle:Categoria',$id);
    	if ($categoria==null){
    	    $ms="La categoria con id=".$id." no EXISTE";
            $this->addFlash('error',"$ms");
            return $this->redirectToRoute("catgegoria_index");
        }else{
    	    try{
                $form =$this->createForm(CategoriaType::class, $categoria);
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()){
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($categoria);
                    $em->flush();
                    $ms="Categoria modificada con id ".$id;
                    $this->addFlash('success',"$ms");
                    return $this->redirectToRoute("catgegoria_index");
                    //return $this->render("sa/categorias.html.twig",array("menssaje"=>$ms,"categorias"=>$categorias,"categoria"=>$categoria,"form"=>$form->createView()));
                }
            }catch (\PDOException $exception){
                    $this->addFlash('error',"Error!, no puede haber dos categorias con el mismo nombre");
                    return $this->redirectToRoute("catgegoria_index");
            }

        }
        //return $this->render("sa/formCat.html.twig",array("menssaje"=>$ms,"form"=>$form->createView()));
        return $this->render("sa/categorias.html.twig",array("categorias"=>$categorias,"form2"=>$form->createView()));
//        return new Response ($categoria->getId()."=".$categoria->getDesCat()."<br>");
    }


    /**
     *
     * @Route("/sa/categorias/delete/{id}",name="Categoria_delete",requirements={"id": "\d+"});
     *
     */
    public function deleteCatAction(Request $request, $id){
        $em=$this->getDoctrine()->getManager();
        $categorias= $this->catAll();
        $categoria=$em->find('AppBundle:Categoria',$id);
        if(!$categoria){
            $ms="No existe esa categoria con el registro: ".$id;
            $this->addFlash('error',"$ms");
            return $this->redirectToRoute("catgegoria_index");
        }else{
            $ms="";
            $form=$this->createFormBuilder($categoria)
                        ->add('desCat', TextType::class,array('disabled'=>true))
                        ->add('Si',SubmitType::class)
                        ->getForm();
            $form->handleRequest($request);
            echo ($categoria->getDesCat());
            if($form->isSubmitted()&& $form->isValid()){
                $ms="LA CATEGORIA :".$categoria->getDesCat();
                if($categoria->getEstado()==1){
                    $categoria->setEstado(0);
                    $ms.=" fue Deshabilitada";
                }
                else{
                    $categoria->setEstado(1);
                    $ms.=" fue Habilitada";
                }
                $em->flush();
                $this->addFlash('success',"$ms");
                return $this->redirectToRoute("catgegoria_index");
            }
        }
        return $this->render("sa/categorias.html.twig",array("categorias"=>$categorias,"form3"=>$form->createView()));
    }

    /*public function deleteCatAction($id){
        $em=$this->getDoctrine()->getManager();
        $categoria=$em->find('AppBundle:Categoria',$id);
        if(!$categoria){
            $ms="No existe esa categoria con el registro: ".$id;
        }else{
            $ms="Ha sido eliminada la categoria con Código: ".$id;
            if($categoria->getEstado()==1)
                $categoria->setEstado(0);
            else
                $categoria->setEstado(1);
            $em->flush();
        }
        return $this->redirectToRoute("catgegoria_index");
        //return $this->render("PwMCMainBundle:sa:categorias.html.twig",array("menssaje"=>$ms,"categorias"=>$categorias));
    }*/
    private function catAll(){
    	$em=$this->getDoctrine()->getManager();
    	$categorias= $em->getRepository('AppBundle:Categoria')->findAll();
    	return $categorias;
    }
}
