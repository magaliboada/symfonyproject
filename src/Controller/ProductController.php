<?php

namespace App\Controller;

use App\Entity\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="show_all")
     */
    public function showAll()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Product::class);
        $products = $repository->findAll();

//        var_dump($products);

        if (!$products) {
            throw $this->createNotFoundException(
                'No products found.'
            );
        }
//        return new Response('Check out this great product: ');

         return $this->render('product/show_all.html.twig', ['products' => $products]);
    }

    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function show(Product $product)
    {

//        $product = $repository->find($id);

//        // look for a single Product by name
//        $product = $repository->findOneBy(['name' => 'Keyboard']);
//        // or find by name and price
//        $product = $repository->findOneBy([
//            'name' => 'Keyboard',
//            'price' => 1999,
//        ]);
//
//        // look for multiple Product objects matching the name, ordered by price
//        $products = $repository->findBy(
//            ['name' => 'Keyboard'],
//            ['price' => 'ASC']
//        );

//        $product = $this->getDoctrine()
//            ->getRepository(Product::class)
//            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return new Response('Check out this great product: '.$product->getType()->getName());
    }

    /**
     * @Route("/create", name="create_product")
     */
    public function createProduct(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $type = $this->getDoctrine()->getRepository(ProductType::class)->find(1);

        $product->setType($type);
        $product->setPrice(19.99);

        $entityManager->persist($product);

        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    /**
     * @Route("/product/edit/{id}")
     */
    public function update($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setName('New product name!');
        $entityManager->flush();

        return $this->redirectToRoute('product_show', [
            'id' => $product->getId()
        ]);
    }
}
