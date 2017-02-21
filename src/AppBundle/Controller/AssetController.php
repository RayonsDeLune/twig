<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/asset")
 */
class AssetController extends Controller
{

    /**
     * @Route("/test")
     */
    public function testAction()
    {
        $form = $this->createForm(\AppBundle\Form\ProduitType::class);
        $form->add("Submit", \Symfony\Component\Form\Extension\Core\Type\ButtonType::class,
                    array("attr"=>array(
                        "onClick"=>"ajouterProd();"
                    )));
        
                
        return $this->render('AppBundle:Asset:test.html.twig', array(
                        "monForm"=>$form->createView()
        ));
    }

}
