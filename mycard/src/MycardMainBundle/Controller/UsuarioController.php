<?php

namespace MycardMainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function registrarAction($nombre)
    {
        return new Response("<html><body>Resgistro de Usuario".$nombre."</body></html>")
    }
}
