<?php

namespace MycardMainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MycardMainBundle:Default:index.html.twig');
    }
}
