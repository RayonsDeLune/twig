<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ServiceController extends Controller
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscriptionAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        // récupère le logger pour le journal de log
        $this->get("logger")->debug("coucou");
        
        $client = new \AppBundle\Entity\Client();
        $form = $this->createForm(\AppBundle\Form\ClientType::class, $client);
        $form->add("submit", \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);
        $form->handleRequest($request);
                
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->get("client_service")->inscrire($client);
            return new \Symfony\Component\HttpFoundation\Response("Inscription réussie");
        }
        
        return $this->render('AppBundle:Service:inscription.html.twig', array(
            "monForm"=>$form->createView()
        ));
    }

}
