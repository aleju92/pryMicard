<?php

namespace ProyMCMainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProyMCMainBundle:Default:index.html.twig');
    }
}
