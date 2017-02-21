<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TagController extends Controller
{
    /**
     * @Route("/include")
     */
    public function includeAction()
    {
        return $this->render('AppBundle:Tag:include.html.twig', array(
            "book"=>array("titre"=>"Le rouge et le noir",
                "urlImage"=>"blabla",
                "dateParution"=>1830)
        ));
    }
    
    /**
     * @Route("/armesPrestiges", name="armesPrestiges")
     */
    public function embedArmesPrestiges()
    {
        $produits=$this->getDoctrine()->getRepository("AppBundle:Produit")->listerArmesPrestiges();
         
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Tag:armesPrestiges.html.twig",
                array('mesProduits'=>$produits));
    }
    
     /**
     * @Route("/armesFamiliales", name="armesFamiliales")
     */
    public function embedArmesFamiliales()
    {
        $produits=$this->getDoctrine()->getRepository("AppBundle:Produit")->listerArmesFamiliales();
         
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Tag:armesFamille.html.twig",
                array('mesProduits'=>$produits));
    }
    
    /**
     * @Route("/embed")
     */
    public function embedAction()
    {
         return $this->render('AppBundle:Tag:embed.html.twig', array(
                    ));
    }
    
    /**
     * @Route("/macro")
     */
    public function macroAction()
    {
         return $this->render('AppBundle:Tag:macro.html.twig', array(
                    ));
    }

}
