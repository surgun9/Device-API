<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiDeviceControllerTest extends WebTestCase
{

    public function testApiDevices()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/devices');

        $this->assertTrue($client->getResponse()->isSuccessful());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertContains('brand', $client->getResponse()->getContent());
        $this->assertContains('model', $client->getResponse()->getContent());
        $this->assertContains('os', $client->getResponse()->getContent());
        $this->assertContains('browser', $client->getResponse()->getContent());
        $this->assertContains('browser_version', $client->getResponse()->getContent());

    }

    public function testApiDevice()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/devices/1');

        $this->assertTrue($client->getResponse()->isSuccessful());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertContains('brand', $client->getResponse()->getContent());
        $this->assertContains('model', $client->getResponse()->getContent());
        $this->assertContains('os', $client->getResponse()->getContent());
        $this->assertContains('browser', $client->getResponse()->getContent());
        $this->assertContains('browser_version', $client->getResponse()->getContent());

    }
}
