<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class SecurityController extends Controller
{
	/**
	 * @Route("/usuario/login", name="login")
	 */
	public function loginAction(Request $request)
	{
		$authenticationUtils = $this->get('security.authentication_utils');
		
		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();
		
		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();
<<<<<<< HEAD
				
=======


>>>>>>> b9c0b647b32d3c261d98b6cf54354715138a2da4
		return $this->render('security/login.html.twig', array(
				'last_username' => $lastUsername,
				'error'         => $error,
		));
	}
<<<<<<< HEAD
	
=======
    /**
     * @Route("/sa/login", name="loginsa")
     */
    public function loginSAAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        print_r($error);
//        die;
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('security/salogin.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logutAction(){

    }
>>>>>>> b9c0b647b32d3c261d98b6cf54354715138a2da4
}

