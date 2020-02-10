<?php

namespace App\Controller;

use App\Entity\Clothing;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClothingController extends AbstractController
{
    /**
     * @Route("/clothing/index", name="index")
     */
    public function index()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Clothing::class);
        $clothings = $repository->findAll();

        //        var_dump($products);

        if (!$clothings) {
            throw $this->createNotFoundException(
                'No clothing found.'
            );
        }
        //        return new Response('Check out this great product: ');

        return $this->render('clothing/show_all.html.twig', ['clothings' => $clothings]);
    }

    /**
     * @Route("/clothing/create", name="create_clothing")
     */
    public function createClothing(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Clothing();
        $product->setPrice(5.0);
        $product->setSize("XS");

        $entityManager->persist($product);

        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }
}
