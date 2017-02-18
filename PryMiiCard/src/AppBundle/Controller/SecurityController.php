<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Usuario;
use Symfony\Component\Security\Http\Firewall\ExceptionListener;
use Symfony\Component\Security\Core\Exception\AuthenticationException;


class SecurityController extends Controller
{
	/**
	 * @Route("/usuario/login", name="login")
	 */
	public function loginuserAction(Request $request)
	{
		try{
            $authenticationUtils = $this->get('security.authentication_utils');
            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();

            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();

            return $this->render('security/login.html.twig', array(
                'last_username' => $lastUsername,
                'error'         => $error,
            ));
        }catch (ExceptionListener $falid){
		    dump($falid);
		    die();
        }

		
		
	}

	/**
	 * @Route("/sa/login", name="sadmnlogin")
	 */
	public function loginsaAction(Request $request)
	{	
		$authenticationUtils=$this->get('security.authentication_utils');
		$error=$authenticationUtils->getLastAuthenticationError();
		$lastUsername=$authenticationUtils->getLastUsername();
		
		return $this->render('security/salogin.html.twig',array(
				'last_username'=> $lastUsername,
				'error'=> $error,
		));
	}

    /**
     * @Route("/emp/login", name="emplogin")
     */
    public function loginempAction(Request $request)
    {
        $authenticationUtils=$this->get('security.authentication_utils');
        $error=$authenticationUtils->getLastAuthenticationError();
        $lastUsername=$authenticationUtils->getLastUsername();

        return $this->render('security/emplogin.html.twig',array(
            'last_username'=> $lastUsername,
            'error'=> $error,
        ));
    }

    /**
     * @Route("/admin/login", name="adminlogin")
     */
    public function loginadmAction(Request $request)
    {
        $authenticationUtils=$this->get('security.authentication_utils');
        $error=$authenticationUtils->getLastAuthenticationError();
        $lastUsername=$authenticationUtils->getLastUsername();

        return $this->render('security/adimlogin.html.twig',array(
            'last_username'=> $lastUsername,
            'error'=> $error,
        ));
    }
    /**
     * @Route("/admin/logout", name="user_logout")
     */
    public function logutadminAction(){

    }
    /**
     * @Route("/emp/logout", name="user_logout")
     */
    public function logutempAction(){

    }

    /*/**
     * @Route("/logout", name="logout")
     */
    /*public function logutAction(){

    }*/

}

