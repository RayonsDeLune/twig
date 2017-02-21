<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FiltreController extends Controller
{
    /**
     * @Route("/test")
     */
    public function testAction()
    {
        return $this->render('AppBundle:Filtre:test.html.twig', array(
            // ...
        ));
    }

}
