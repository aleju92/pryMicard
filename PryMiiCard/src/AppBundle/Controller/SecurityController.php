<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Usuario;


class SecurityController extends Controller
{
	/**
	 * @Route("/usuario/login", name="login")
	 */
	public function loginuserAction(Request $request)
	{
				
		$authenticationUtils = $this->get('security.authentication_utils');
		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();
		
		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();
<<<<<<< HEAD
=======
		
>>>>>>> 5acba37f2caa573abfc432cd0695f6b0bc978ea2
		return $this->render('security/login.html.twig', array(
					'last_username' => $lastUsername,
					'error'         => $error,
		));
		
		
	}
<<<<<<< HEAD

    /**
     * @Route("/sa/login", name="loginsa")
     */
    public function loginSAAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('security/salogin.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
=======
	
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
	
	/*/**
	 * @Route("/emp/login", name="emplogin")
	 */
	/*public function loginsaAction(Request $request)
	{
		$authenticationUtils=$this->get('security.authentication_utils');
		$error=$authenticationUtils->getLastAuthenticationError();
		$lastUsername=$authenticationUtils->getLastUsername();
	
		return $this->render('security/login.html.twig',array(
				'last_username'=> $lastUsername,
				'error'=> $error,
		));
	}*/
>>>>>>> 5acba37f2caa573abfc432cd0695f6b0bc978ea2

    /*/**
     * @Route("/logout", name="logout")
     */
    /*public function logutAction(){

    }*/

<<<<<<< HEAD
    }
=======
>>>>>>> 5acba37f2caa573abfc432cd0695f6b0bc978ea2
}

