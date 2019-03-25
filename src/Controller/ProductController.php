<?php

namespace App\Controller;


use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    public function list()
    {
        $entityManager = $this->getDoctrine()->getManager();
        /** @var ProductRepository $productRepository */
        $productRepository = $entityManager->getRepository(Product::class);
        $products = $productRepository->findAllOrderedByName();

        return $this->render(
            "index.html.twig",
            [
                "products" => $products
            ],
            new Response("", 200)
        );
    }

    public function show($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        /** @var ProductRepository $productRepository */
        $productRepository = $entityManager->getRepository(Product::class);
        $product = $productRepository->find($id);

        return $this->render(
            "product_details.html.twig", [
            "product" => $product
        ],
            new Response("", 200)
        );
    }
}