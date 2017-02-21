<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 */
class SecurityController extends Controller
{

    /**
     *  @Security("has_role('ROLE_ADMIN') or has_role('ROLE_MODO')")
     * @Route("/securityByAnnotation")
     */
    public function securityByAnnotationAction()
    {
        return $this->render('AppBundle:Security:security_by_annotation.html.twig', array(
                        // ...
        ));
    }

    /**
     * 
     * @Route("/secuByCode")
     */
    public function secuByCodeAction()
    {
        $this->denyAccessUnlessGranted("ROLE_SIMPLE");
        return $this->render('AppBundle:Security:security_by_annotation.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        // renvoie vers le formulaire de login
        return $this->render("AppBundle:Security:login.html.twig", array('last_username' => $lastUsername,
                    'error' => $error));
    }

}
