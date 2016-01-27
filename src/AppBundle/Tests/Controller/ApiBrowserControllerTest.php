<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiBrowserControllerTest extends WebTestCase
{

    public function testApiBrowsers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/browsers');

        $this->assertTrue($client->getResponse()->isSuccessful());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertContains('name', $client->getResponse()->getContent());

    }

    public function testApiBrowser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/browsers/1');

        $this->assertTrue($client->getResponse()->isSuccessful());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertContains('name', $client->getResponse()->getContent());

    }
}
