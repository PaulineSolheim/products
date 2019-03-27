<?php

namespace App\Tests;

use App\Controller\CartController;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;



class CartControllerTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testAddItemTotalQuantity()
    {
        $productRepository = $this->entityManager->getRepository(Product::class);
        /** @var Product $product */
        $product = $productRepository->findBy(["name" => "Product-1"])[0];
        $quantity = 2;
        $cartController = new CartController();
        $total = $cartController->calculateTotal([
            $product->getId() => $quantity
        ], $productRepository);

        $this->assertEquals(($product->getPrice() * $quantity), $total);

    }
}
