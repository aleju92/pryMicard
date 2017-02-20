<?php

namespace AppBundle\Controller;

use AppBundle\Form\AdministradorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
     * @Route("/sa/logout", name="sa_logout")
     */
    public function logutAction(){
    
    }
    
    /**
     * @Route("/sa/admins/index", name="administradores_index")
     */
    public function indexAdmisAction(Request $request){
        $Admins=$this->AdminAll();
        $form=$this->createForm(AdministradorType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() &&$form->isValid()){
                //encriptacion
                $Admin=$form->getData();
                $password=$this->get('security.password_encoder')
                          ->encodePassWord($Admin,$Admin->getPasswordTemp());
                $Admin->setPassAdm($password);
                //Dar formato a la  Foto
                $img=$form['photoAdm']->getData();
                $ext=$img->guessExtension();
                $file_name =time().".".$ext;
                //Subir la foto al servidor
                $img->move("AdminPerfil",$file_name);

                //Datos adicionales del administrador
                $Admin->setPhotoAdm($file_name);
                $Admin->setTipAdm(1);
                $Admin->setEstAdm(1);

                $em=$this->getDoctrine()->getManager();
                $em->persist($Admin);
                $em->flush();
                $this->addFlash('success','Nuevo Ejecutivo de ventas  ingresado');
                return $this->redirectToRoute('administradores_index');

        }
        return $this->render("sa/admins.html.twig",array("Admins"=>$Admins,"form"=>$form->createView()));
    }


    /**
     * @Route("/sa/admins/xid/{id}",  name="getAdmin")
     */
    public function  getAdminXidAction(Request $request,$id){

        $Admins = $this->AdminAll();
        $em = $this->getDoctrine()->getManager();
        $admin = $em->find("AppBundle:Administrador", $id);

        if ($admin == null) {
            $this->addFlash('error','Error!! Accion no permitida, usuario no encontrado');
            return $this->redirectToRoute('administradores_index');
            }
        else{
            $form = $this->createFormBuilder()
                        ->add('nomAdm',HiddenType::class,array('data'=>$admin->getNomAdm()))
                        ->add('apeAdm',HiddenType::class,array('data'=>$admin->getApeAdm()))
                        ->add('PasswordTemp',PasswordType::class,array('label'=>'Contraseña nueva','data'=>$admin->getPasswordTemp()))
                        ->add('Guardar',SubmitType::class)
                        ->getForm();
            //$form->get('nomAdm')->setData($admin->getNomAdm());
            //$form->get('apeAdm')->setData($admin->getApeAdm());

            dump($form);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                    //encriptacion
                    //dump($form);
                    //die();

                    $admin->setPasswordTemp($form->get('PasswordTemp')->getData());
                    $password=$this->get('security.password_encoder')
                        ->encodePassWord($admin,$admin->getPasswordTemp());
                    $admin->setPassAdm($password);
                    $em=$this->getDoctrine()->getManager();
                    $em->flush();
                    $this->addFlash('success','Cambios del Ejecutivo de ventas  ingresados');
                    return $this->redirectToRoute('administradores_index');

            }
            return $this->render("sa/admins.html.twig",array("Admins"=>$Admins,"Form"=>$form->createView()));
        }

    }
    /**
     * @Route("/sa/admins/delete/{id}",  name="deleteAdmin")
     */
    public function  deleteAdmAction(Request $request,$id){

        $Admins = $this->AdminAll();
        $em = $this->getDoctrine()->getManager();
        $admin = $em->find("AppBundle:Administrador", $id);

        if ($admin == null) {
            $this->addFlash('error','Error!! Accion no permitida, usuario no encontrado');
            return $this->redirectToRoute('administradores_index');
        }
        else{
            $form = $this->createFormBuilder()
                ->add('nomAdm',HiddenType::class)
                ->add('apeAdm',HiddenType::class)
                ->add('estAdm',HiddenType::class)
                ->add('Si',SubmitType::class)
                ->getForm();

            $form->get('nomAdm')->setData($admin->getNomAdm());
            $form->get('apeAdm')->setData($admin->getApeAdm());
            $form->get('estAdm')->setData($admin->getEstAdm());

            $form->handleRequest($request);
            if($form->isSubmitted()){
                if($form->isValid()){
                    $ms="EL Ejecutivo ".$admin->getNomAdm()." ".$admin->getApeAdm();
                    if($admin->getEstAdm()==1){
                        $admin->setEstAdm(0);
                        $ms.=" fue Deshabilitadao";
                    }else{
                        $admin->setEstAdm(1);
                        $ms.="fue Habilitadao";
                    }
                    $em=$this->getDoctrine()->getManager();
                    //$em->persist($admin);
                    $em->flush();
                    $this->addFlash('success',$ms);
                    return $this->redirectToRoute('administradores_index');
                }else{
                    dump($admin,$form);
                    die();
                }
            }
            return $this->render("sa/admins.html.twig",array("Admins"=>$Admins,"form3"=>$form->createView()));
        }

    }


    /**
     * @Route("/sa/Mi_Perfil", name="miPerfilSa")
     */
    public function miPerfil(Request $request){
        $adminUser=$this->getUser();
        $em=$this->getDoctrine()->getManager();
        //$adminUser=$em->find("AppBundle:Administrador", $idUser);
            //$form=$this->createForm(AdministradorType::class, $adminUser);
            $form=$this->createFormBuilder($adminUser)
                    ->add('nomAdm',TextType::class,array('label'=>'Nombres','required'=>true))
                    ->add('apeAdm',TextType::class,array('label'=>'Apellido','required'=>true))
                    ->add('emAdm',EmailType::class,array('label'=>'Email Personal'))
                    ->add('PasswordTemp',HiddenType::class)
                    ->add('path',HiddenType::class,array('mapped'=>false))
                    ->add('photoAdm',FileType::class,array('label'=>'Foto Personal','data_class' => null))
                    ->add('useAdm',TextType::class,array('label'=>'Nombre de Usuario'))
                    ->add('Guardar',SubmitType::class)
                    ->getForm();
            $form->get('PasswordTemp')->setData('pass');
            $form->get('path')->setData($adminUser->getPathPhotoAdm());
            $formV=$this->createFormBuilder($adminUser)
                ->add('PasswordTemp',PasswordType::class)
                ->add('Verificar',SubmitType::class)
                ->getForm();
            $form->handleRequest($request);
            if($form->isSubmitted()){
                if( $form->isValid()){
                    $adminUser=$form->getData();

                    //encriptacion de passwprd
                    $password=$this->get('security.password_encoder')
                        ->encodePassword($adminUser,$adminUser->getPasswordTemp());
                    $adminUser->setPassAdm($password);
                    if(! $form->get('photoAdm')->isEmpty()) {
                        //Subir la foto
                        $img = $form['photoAdm']->getData();
                        $ext = $img->guessExtension();
                        $file_name = time() . "." . $ext;

                        //subir la foto al repositorio
                        $img->move("AdminPerfil", $file_name);

                        $adminUser->setPhotoAdm($file_name);
                    }

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

        return $this->render("sa/miperfil.html.twig",array('Form'=>$form->createView(),'FormV'=>$formV->createView()));
    }



    /**
     * @Route("/sa/MiiPerfil/PassWord", options={"expose"=true}, name="SaAdmPass")
     */
    public function verificarPassword(Request $request){
        if ($request->isXmlHttpRequest()){
            $adminUser=$this->getUser();
            $form=$this->createFormBuilder()
                ->add('PasswordTemp')
                ->getForm();
            dump($request->request);

            $form->handleRequest($request);
            dump($form);
            return new JsonResponse(array('form'=>$form->get('PasswordTemp')->getData(),'user'=>$adminUser->getId()));

        }else{
            $this->addFlash('error','Error!!,Accion no permitida');
            return $this->redirectToRoute('miPerfilSa');
        }

    }
    /*
    public function verificarPassword(Request $request){
        if ($request->isXmlHttpRequest()){
            $passText=$request->get('passText');
            $idUser=$request->get('idUser');
            $em=$this->getDoctrine()->getManager();
            $adminUser=$em->find("AppBundle:Administrador", $idUser);
            $password=$this->get('security.password_encoder')
                ->encodePassWord($adminUser,$passText);
            if($password==$adminUser->getPassAdm()){
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
                return new JsonResponse(array('mensaje'=>'Error!, la contraseña no coincide','typems'=>'danger','passw'=>$password));
            }
        }else{
            $this->addFlash('error','Error!!,Accion no permitida');
            return $this->redirectToRoute('miPerfilSa');
        }

    }*/
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
    private function UserAll(){
        $em=$this->getDoctrine()->getManager();
        $Users= $em->getRepository('AppBundle:Usuario')->findAll();
        return $Users;
    }

    /**
     * @Route("/sa/users/index", name="Users_index")
     */
    public function indexUsersAction(Request $request){
        $Users=$this->UserAll();
        return $this->render("sa/users.html.twig",array("Users"=>$Users));
    }


    /**
     * @Route("/sa/users/delete", options={"expose"=true}, name="delete_User")
     */
    public function deleteUserAction(Request $request)
    {
        // verificar que solo se puede acceder a este controlador mediante una llamada ajax
        if ($request->isXMLHttpRequest()) {
            $id = $request->get('id');
            $em = $this->getDoctrine()->getManager();
            $user = $em->find("AppBundle:Usuario", $id);

            $ms="EL Ejecutivo ".$user->getNombre()." ".$user->getApellido();
            if($user->getEstado()==1){
                $user->setEstado(0);
                $ms.=" fue Deshabilitadao";
            }else{
                $user->setEstado(1);
                $ms.="fue Habilitadao";
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // obtener la lista de comentarios actualizada
            $userslist= $this->UserAll();
            // Obtener solo el HTML del render no las cabeceras
            $userslist_html = $this->render('sa/formDet.html.twig',array(
                'Users'=> $userslist
            ))->getContent();

            // Enviar la respuesta codificada como json
            return new JsonResponse(array(
                    'tymes'=>'success',
                    'mensaje' => $ms,
                    'userlist_html' => $userslist_html
                )
            );
        }else{
            $this->addFlash('error','Acion no permitida');
            return $this->redirectToRoute('Users_index');
        }
    }

    /**
     * @Route("/sa/users/editpassword", options={"expose"=true}, name="passedit_User")
     */
    public function editpassUserAction(Request $request)
    {
        // verificar que solo se puede acceder a este controlador mediante una llamada ajax
        if ($request->isXMLHttpRequest()) {
            $id = $request->get('id');
            $passWord=$request->get('passWord');
            $em = $this->getDoctrine()->getManager();
            $user = $em->find("AppBundle:Usuario", $id);



            $password=$this->get('security.password_encoder')
                ->encodePassWord($user,$passWord);
            $user->setPassword($password);
            $em->flush();
            $ms="la contasña del usuario ".$user->getNombre()." ".$user->getApellido()." ha sido modificadad";

            // Enviar la respuesta codificada como json
            return new JsonResponse(array(
                    'tymes'=>'success',
                    'mensaje' => $ms
                )
            );
        }else{
            $this->addFlash('error','Acion no permitida');
            return $this->redirectToRoute('Users_index');
        }
    }

}
