<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 *  @Route("/ajax")
 */
class AjaxController extends Controller
{
    /**
     * @Route("/listerProduits", name="ajax_listerProduits")
     */
    public function listerProduitsAction()
    {
        // récupérer les produits à partir du repository
        $produits = $this->getDoctrine()->getRepository("AppBundle:Produit")->triProduits();
        
        return $this->render('AppBundle:Ajax:lister_produits.html.twig', array(
            "produits"=>$produits
        ));
    }
    
    /**
     * @Route("/sup_prod/{id}", name="ajax_sup_prod")
     * 
     */
    public function supProdAction($id)
    {
        // supprime ce produit
        $qb = new \Doctrine\ORM\QueryBuilder ( $this->getDoctrine()->getManager() );
        $qb->delete()->from("AppBundle:Produit", "p")
                ->where("p.id=:prodId")
                ->setParameter("prodId", $id)
                ->getQuery()
                ->execute();
        
        return $this->redirectToRoute("ajax_listerProduits");
//        return new \Symfony\Component\HttpFoundation\Response("produit supprimé");
    }
    
    /**
     * @Route("/ajouter_prod", name="ajax_ajouter_prod")
     */
    public function ajouterProdAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $dto=new \AppBundle\Entity\Produit();
        $form = $this->createForm(\AppBundle\Form\ProduitType::class, $dto);
        $form->handleRequest($request);
        
        // enregistrer mon produit en base
        $this->getDoctrine()->getManager()->persist($dto);
        $this->getDoctrine()->getManager()->flush();
        
        
        return $this->redirectToRoute("ajax_listerProduits");
    }
    
    /**
     * @Route("/lister_json", name="ajax_lister_json")
     * 
     */
    public function listerJSONAction()
    {
        // récup liste produits
        $produits = $this->getDoctrine()->getRepository("AppBundle:Produit")->triProduits();
        
        $res = array();
        foreach ($produits as $prod)
        {
            $p = new \AppBundle\DTO\ProduitDTO();
            $p->prix = $prod->getPrix();
            $p->titre = $prod->getTitre();
            $p->id = $prod->getId();
            $res[]=$p;
        }
        
        //renvoie du JSON
        return $this->json($res);
    }
    
    

}
