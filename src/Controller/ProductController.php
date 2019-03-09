<?php

namespace App\Controller;


use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    public function list() {
        $entityManager = $this->getDoctrine()->getManager();
        /** @var ProductRepository $productRepository */
        $productRepository = $entityManager->getRepository(Product::class);
        $products = $productRepository->findAllOrderedByName();

        return $this->render(
            "list.html.twig", [
                "products" => $products
            ],
            new Response("", 200)
        );
    }
}