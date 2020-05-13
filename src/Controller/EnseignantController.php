<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Enseignant;
use App\Entity\Diplome;
use App\Form\EnseignantType;
use App\Repository\EnseignantRepository;
use App\Services\Impl\AdresseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/enseignant")
 */
class EnseignantController extends AbstractController
{

    private $adresseService;

    public function __construct(AdresseService $service)
    {
        $this->adresseService = $service;
    }
    
    /**
     * @Route("/", name="enseignant_index", methods={"GET"})
     */
    public function index(EnseignantRepository $enseignantRepository): Response
    {
        return $this->render('enseignant/index.html.twig', [
            'enseignants' => $enseignantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="enseignant_new", methods={"GET","POST"})
     */
    public function new(Request $request, Security $security): Response
    {
        $enseignant = new Enseignant();
        $adresse = new Adresse();
        $form = $this->createForm(EnseignantType::class, $enseignant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $security->getUser();
            $adresse->setTelephone($enseignant->getAdresse()->getTelephone());
            $adresse->setBoitePostale($enseignant->getAdresse()->getBoitePostale());
            $adresse->setEmail($enseignant->getAdresse()->getEmail());
            $this->adresseService->save($adresse);
            $enseignant->setCreatedBy($user);
            $entityManager->persist($enseignant);
            $entityManager->flush();

            return $this->redirectToRoute('enseignant_index');
        }

        return $this->render('enseignant/new.html.twig', [
            'enseignant' => $enseignant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="enseignant_show", methods={"GET"})
     */
    public function show(Enseignant $enseignant): Response
    {
        return $this->render('enseignant/show.html.twig', [
            'enseignant' => $enseignant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="enseignant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Enseignant $enseignant): Response
    {
        $form = $this->createForm(EnseignantType::class, $enseignant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enseignant_index');
        }

        return $this->render('enseignant/edit.html.twig', [
            'enseignant' => $enseignant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="enseignant_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Enseignant $enseignant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enseignant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($enseignant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('enseignant_index');
    }
}
