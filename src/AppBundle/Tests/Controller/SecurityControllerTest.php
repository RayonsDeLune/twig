<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testSecuritybyannotation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/securityByAnnotation');
    }

}
