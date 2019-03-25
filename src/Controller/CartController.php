<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class CartController extends AbstractController
{
    private $session;
    private $cart;


    public function __construct()
    {
        $this->session = new Session();
        $this->cart = $this->session->get('cart');
    }

    public function add(Request $request)
    {
        if (!$this->session->has('cart')) {
            $this->session->set('cart',array());
        }

        if (array_key_exists($request->get('id'), $this->cart) && $request->get('quantity')) {
            $this->cart[$request->get('id')] += (int)$request->get('quantity');
        } else {
            if ($request->get('quantity') != null) {
                $this->cart[$request->get('id')] = (int)$request->get('quantity');
            } else {
                $this->cart[$request->get('id')] = 1;
            }
        }
        $this->session->set('cart', $this->cart);

        $quantityProducts = null;
        $entityManager = $this->getDoctrine()->getManager();
        $productRepository = $entityManager->getRepository(Product::class);

        if ($this->cart) {
            foreach ($this->cart as $key => $value) {
                $product = $productRepository->find($key);
                $quantityProducts += $this->cart[$product->getId()];
            }
        }

        $this->session->set('quantities', $quantityProducts);

        $this->session->getFlashBag()->add('info', 'Le produit a bien été ajouté au panier en '. $request->get('quantity') .' exemplaire(s)');

        return $this->redirect("/");
    }

    public function show()
    {
        $listProducts = [];
        $total = null;

        $entityManager = $this->getDoctrine()->getManager();
        $productRepository = $entityManager->getRepository(Product::class);

        if ($this->cart) {
            foreach ($this->cart as $key => $value) {
                $product = $productRepository->find($key);
                $listProducts[] = $product;
                $total += ($product->getPrice() * $this->cart[$product->getId()]);
            }
        }

        return $this->render('cart_details.html.twig', [
            'cart'=> $this->cart,
            'products' => $listProducts,
            'total' => $total
        ],
            new Response("", 200)
        );
    }

    public function reset()
    {
        $this->session->set('cart', []);
        $this->session->clear();
        $this->session->getFlashBag()->add('info', 'Votre panier a été vidé');

        $this->session->set('quantities', null);

        return $this->redirect("/");
    }
}