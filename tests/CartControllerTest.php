<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class CartControllerTest extends WebTestCase
{
    public function testAddItemTotalQuantity()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/product/14'); //todo change id (1 ->12)

        $form = $crawler->selectButton('Ajouter')->form();
        $form->setValues(['quantity' => 4]);
        $client->submit($form);  //todo methode add cart controller jms appelee

        $this->assertCount(1,  $crawler->filter('html:contains("Mon panier 4")'));
    }
}
