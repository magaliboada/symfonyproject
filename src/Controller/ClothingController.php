<?php

namespace App\Controller;

use App\Entity\Clothing;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClothingController extends AbstractController
{
    /**
     * @Route("/clothing", name="clothing")
     */
    public function index()
    {
        return $this->render('clothing/index.html.twig', [
            'controller_name' => 'ClothingController',
        ]);
    }

    /**
     * @Route("/clothing/create", name="create_clothing")
     */
    public function createClothing(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Clothing();
        $product->setPrice(19.99);

        $entityManager->persist($product);

        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }
}
