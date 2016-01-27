<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiBrowserVersionControllerTest extends WebTestCase
{

    public function testApiBrowserVersions()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/browser_versions');

        $this->assertTrue($client->getResponse()->isSuccessful());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertContains('browser', $client->getResponse()->getContent());
        $this->assertContains('version', $client->getResponse()->getContent());

    }

    public function testApiBrowserVersion()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/browser_versions/1');

        $this->assertTrue($client->getResponse()->isSuccessful());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertContains('browser', $client->getResponse()->getContent());
        $this->assertContains('version', $client->getResponse()->getContent());

    }
}
