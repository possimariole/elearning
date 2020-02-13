<?php

namespace App\Controller;

use App\Entity\Dispenser;
use App\Form\DispenserType;
use App\Repository\DispenserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dispenser")
 */
class DispenserController extends AbstractController
{
    /**
     * @Route("/", name="dispenser_index", methods={"GET"})
     */
    public function index(DispenserRepository $dispenserRepository): Response
    {
        return $this->render('dispenser/index.html.twig', [
            'dispensers' => $dispenserRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="dispenser_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dispenser = new Dispenser();
        $form = $this->createForm(DispenserType::class, $dispenser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dispenser);
            $entityManager->flush();

            return $this->redirectToRoute('dispenser_index');
        }

        return $this->render('dispenser/new.html.twig', [
            'dispenser' => $dispenser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dispenser_show", methods={"GET"})
     */
    public function show(Dispenser $dispenser): Response
    {
        return $this->render('dispenser/show.html.twig', [
            'dispenser' => $dispenser,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dispenser_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dispenser $dispenser): Response
    {
        $form = $this->createForm(DispenserType::class, $dispenser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dispenser_index');
        }

        return $this->render('dispenser/edit.html.twig', [
            'dispenser' => $dispenser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dispenser_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dispenser $dispenser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dispenser->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dispenser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dispenser_index');
    }
}
