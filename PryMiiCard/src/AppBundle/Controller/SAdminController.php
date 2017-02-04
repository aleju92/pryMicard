<?php

namespace AppBundle\Controller;

use AppBundle\Form\AdministradorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Administrador;
use Symfony\Component\HttpFoundation\JsonResponse;
class SAdminController extends Controller
{
	/**
	 * @Route("/sa", name="indexSAdmin")
	 */
	
    public function indexAction()
    {
        return $this->render('sa/index.html.twig');
    }
    
    /**
     * 
     * @Route("/sa/{page}",name="pageSelect");
     * 
     */
   /* public function pageselectAction($page)
    {
    	switch ($page) {
            case 'categorias':
                return $this->redirectToRoute('catgegoria_index');
                break;
            case 'admins':
                return $this->redirectToRoute('administradores_all');
                break;
            case 'Mi_Perfil':
                return $this->redirectToRoute("miPerfilSa",array("idUser"=>1));
                break;
            case 'login':
                return $this->redirectToRoute("loginsa");
                break;
            default:
                return $this->redirectToRoute('indexSAdmin');
        }
    }*/

    /**
     * @Route("/sa/admins/all", name="administradores_all")
     */
    public function getAdmisAction(){
        $Admin=$this->AdminAll();
        $ms='';
        return $this->render("sa/admins.html.twig",array("menssaje"=>$ms,"Admins"=>$Admin,"Admin"=>null));
    }

    /**
     * @Route("/sa/admins/xid/{id}", name="getAdmin")
     */
    public function  getAdminXidAction($id){
        $Admins=$this->AdminAll();
        $ms='';
        $em=$this->getDoctrine()->getManager();
        $admin=$em->find("AppBundle:Administrador", $id);
        if($admin==null){
            $ms="El usuario administrador con id=".$id."No se encientra registrado";
        }
        return $this->render("sa/admins.html.twig",array("menssaje"=>$ms,"Admins"=>$Admins,"Admin"=>$admin));
    }

    /**
     * @Route("/sa/Mi_Perfil/{idUser}", name="miPerfilSa")
     */
    public function miPerfil(Request $request, $idUser){
        //$this->getUser();
        $em=$this->getDoctrine()->getManager();
        $adminUser=$em->find("AppBundle:Administrador", $idUser);
        if(!$adminUser){
            return $this->redirectToRoute('indexSAdmin');
        }else{
            $form=$this->createForm(AdministradorType::class, $adminUser);
            $form->get('path')->setData($adminUser->getPathPhotoAdm());
            $form->handleRequest($request);
            if($form->isSubmitted()){
                if( $form->isValid()){
                    $adminUser=$form->getData();

                    //encriptacion de passwprd
                    $password=$this->get('security.password_encoder')
                        ->encodePassword($adminUser,$adminUser->getPasswordTemp());
                    $adminUser->setPassAdm($password);

                    //Subir la foto
                    $img=$form['photoAdm']->getData();
                    $ext=$img->guessExtension();
                    $file_name=time().".".$ext;

                    //subir la foto al repositorio
                    $img->move("AdminPerfil",$file_name);

                    $adminUser->setPhotoAdm($file_name);

                    $em->persist($adminUser);
                    $em->flush();
                    $ms="Sus datos han sido modificado correctamente";
                    $tms='success';
                }else{
                    $ms="Error!!!, los datos son incorrectos ";
                    $tms='error';
                }
                $this->addFlash($tms,$ms);
            }
        }
        return $this->render("sa/miperfil.html.twig",array('Form'=>$form->createView()));
    }

    /**
     * @Route("/sa/MiiPerfil/PassWord", options={"expose"=true}, name="SaAdmPass")
     */
    public function verificarPassword(Request $request){
        if ($request->isXmlHttpRequest()){
            $passText=$request->get('passText');
            $idUser=$request->get('idUser');
            $em=$this->getDoctrine()->getManager();
            $adminUser=$em->find("AppBundle:Administrador", $idUser);
            if($passText==$adminUser->getPassAdm()){
                $form=$this->createFormBuilder($adminUser)
                            ->add('PasswordTemp',RepeatedType::class, array(
                                'type' => PasswordType::class,
                                'first_options' => array('label' =>'Nueva Contraseña'),
                                'second_options' => array('label' => 'Confirme su nueva contraseña')))
                            ->add('cambiar',SubmitType::class)
                            ->getForm();

                $formRende=$this->render("sa/formRender.html.twig",array('Form1'=>$form->createView()))->getContent();
                return new JsonResponse(array('id'=>$idUser,'mensaje'=>'la contraseña coincide','typems'=>'success','Form'=>$formRende));
            }else{
                return new JsonResponse(array('mensaje'=>'Error!, la contraseña no coincide','typems'=>'danger'));
            }
        }else{
            $this->addFlash('error','Error!!,Accion no permitida');
            return $this->redirectToRoute('miPerfilSa');
        }

    }
    /**
     * @Route("/sa/MiiPerfil/PassWordEdit", options={"expose"=true}, name="SaAdmPassEdit")
     */
    public function changePassWord(Request $request){
        if($request->isXmlHttpRequest()){
            //creamos el form
            $form=$this->createFormBuilder()
                ->add('PasswordTemp',RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'first_options' => array('label' =>'Nueva Contraseña'),
                    'second_options' => array('label' => 'Confirme su nueva contraseña')))
                ->add('cambiar',SubmitType::class)
                ->getForm();
  //          dump($request->get('form'));
    //        $form1=$this->createFormBuilder()->getForm();

//            $form1=$request->get('form');
            $form->handleRequest($request);
            if($form->isValid()){
                return new JsonResponse(array('message'=>'formulario valido','pass'=>$form->get('PasswordTemp')->getData(),'id'=>$request->get('idUser')));
            }else{
                return new JsonResponse(array('message'=>'formulario  no valido','Form'=>$this->render("sa/formRender.html.twig",array('Form1'=>$form->createView()))));
            }

        }else{
            $this->addFlash('error','Error!!,Accion no permitida');
            return $this->redirectToRoute('miPerfilSa');
        }
    }
    private function AdminAll(){
        $em=$this->getDoctrine()->getManager();
        $Administadores= $em->getRepository('AppBundle:Administrador')->findAll();
        return $Administadores;
    }
}
