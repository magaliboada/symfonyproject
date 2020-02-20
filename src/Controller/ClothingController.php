<?php

namespace App\Controller;

use App\Entity\Clothing;
use App\Form\ClothingType;
use App\Repository\ClothingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/clothing")
 */
class ClothingController extends AbstractController
{
    /**
     * @Route("/", name="clothing_index", methods={"GET"})
     */
    public function index(ClothingRepository $clothingRepository): Response
    {
        return $this->render('clothing/index.html.twig', [
            'clothings' => $clothingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="clothing_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $clothing = new Clothing();
        $form = $this->createForm(ClothingType::class, $clothing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($clothing);
            $entityManager->flush();

            return $this->redirectToRoute('clothing_index');
        }

        return $this->render('clothing/new.html.twig', [
            'clothing' => $clothing,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="clothing_show", methods={"GET"})
     */
    public function show(Clothing $clothing): Response
    {
        return $this->render('clothing/show.html.twig', [
            'clothing' => $clothing,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="clothing_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Clothing $clothing): Response
    {
        $form = $this->createForm(ClothingType::class, $clothing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clothing_index');
        }

        return $this->render('clothing/edit.html.twig', [
            'clothing' => $clothing,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="clothing_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Clothing $clothing): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clothing->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($clothing);
            $entityManager->flush();
        }

        return $this->redirectToRoute('clothing_index');
    }
}
