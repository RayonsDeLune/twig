<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Service;

/**
 * Description of ClientService
 *
 * @author Hélène 
 */
class ClientService implements \AppBundle\Service\IClientService
{

    /**
     *
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $em;
    

    /**
     * 
     * @var IMailService
     */
    private $emailService;
    
    /**
     * 
     * @var \Symfony\Bridge\Monolog\Logger
     */
    private $logger;
    

    function __construct(\Doctrine\ORM\EntityManagerInterface $em, IMailService $emailService, \Symfony\Bridge\Monolog\Logger $logger)
    {
        $this->em = $em;
        $this->emailService = $emailService;
        $this->logger = $logger;
    }

    public function inscrire(\AppBundle\Entity\Client $client)
    {
        // faire l'inscription du client en bdd (persist)
        $client->setRole("ROLE_SIMPLE");
        $this->em->persist($client);
        $this->em->flush();

        // enoyer un mail de confirmation
        $this->emailService->envoyerMail("test@test.fr", "Validez votre inscription", "Corps du message");

        // ajouter dans le journal des log qu'un nouveau client s'est inscrit
        $this->logger->debug("Inscription d'un nouveau client");
    }

}
