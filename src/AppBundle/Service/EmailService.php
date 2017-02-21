<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Service;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Description of EmailService
 *
 * @author Hélène 
 */
class EmailService implements \AppBundle\Service\IMailService
{
    
    /**
     * 
     * @var \Swift_Mailer
     */
    private $mailer;
    
    function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
    
    public function envoyerMail($mailTo, $mailSubject, $mailBody)
    {
        $msg = \Swift_Message::newInstance();
        $msg->setTo($mailTo);
        $msg->setFrom("helene@test.fr");
        $msg->setSubject($mailSubject);
        $msg->setBody($mailBody);
        $this->mailer->send($msg);
        
        throw new Exception("MAL FAIT !! ");
    }

}
