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

		return $this->render('security/login.html.twig', array(
					'last_username' => $lastUsername,
					'error'         => $error,
		));
		
		
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
	

    /*/**
     * @Route("/logout", name="logout")
     */
    /*public function logutAction(){

    }*/

}

