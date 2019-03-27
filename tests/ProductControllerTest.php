<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function setUp()
    {
        self::bootKernel();
    }

    public function testList()
    {
        $client = static::createClient(
            array(
                'environment' => 'test',
                'debug'       => false,
            )
        );

        $crawler = $client->request('GET', '/');

        $this->assertCount(12, $crawler->filter('.card'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}