<?php

namespace App\Controller;

use App\Entity\Chapitre;
use App\Form\ChapitreType;
use App\Repository\ChapitreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/chapitre")
 */
class ChapitreController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/", name="chapitre_index", methods={"GET"})
     */
    public function index(ChapitreRepository $chapitreRepository): Response
    {
        return $this->render('chapitre/index.html.twig', [
            'chapitres' => $chapitreRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ENSEIGNANT")
     * @Route("/new", name="chapitre_new", methods={"GET","POST"})
     */
    public function new(Request $request, Security $security): Response
    {
        $chapitre = new Chapitre();
        $form = $this->createForm(ChapitreType::class, $chapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $security->getUser();
            $chapitre->setCreatedBy($user);
            $entityManager->persist($chapitre);
            $entityManager->flush();

            return $this->redirectToRoute('chapitre_index');
        }

        return $this->render('chapitre/new.html.twig', [
            'chapitre' => $chapitre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="chapitre_show", methods={"GET"})
     */
    public function show(Chapitre $chapitre): Response
    {
        return $this->render('chapitre/show.html.twig', [
            'chapitre' => $chapitre,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="chapitre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Chapitre $chapitre): Response
    {
        $form = $this->createForm(ChapitreType::class, $chapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chapitre_index');
        }

        return $this->render('chapitre/edit.html.twig', [
            'chapitre' => $chapitre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ENSEIGNANT")
     * @Route("/{id}", name="chapitre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Chapitre $chapitre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chapitre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chapitre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chapitre_index');
    }
}
