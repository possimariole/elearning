<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Entity\Apprenant;
use App\Entity\Adresse;
use App\Form\InscriptionType;
use App\Repository\InscriptionRepository;
use App\Services\Impl\ApprenantService;
use App\Services\Impl\AdresseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inscription")
 */
class InscriptionController extends AbstractController
{

    private $apprenantService;
    private $adresseService;

    public function __construct(ApprenantService $apprenantService, AdresseService $adresseService)
    {
        $this->apprenantService = $apprenantService;
        $this->adresseService = $adresseService;
    }

    /**
     * @Route("/", name="inscription_index", methods={"GET"})
     */
    public function index(InscriptionRepository $inscriptionRepository): Response
    {
        return $this->render('inscription/index.html.twig', [
            'inscriptions' => $inscriptionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="inscription_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $inscription = new Inscription();
        $apprenant = new Apprenant();
        $adresse = new Adresse();
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $apprenant->setNom($inscription->getApprenant()->getNom());
            $apprenant->setPrenom($inscription->getApprenant()->getPrenom());
            $apprenant->setDateNaiss($inscription->getApprenant()->getDateNass());
            $apprenant->setPays($inscription->getApprenant()->getPays());
            $apprenant->setVille($inscription->getApprenant()->getVille());
            $apprenant->setSexe($inscription->getApprenant()->getSexe());
            $apprenant->setLieuNaissance($inscription->getApprenant()->getLieuNaissance());

            $adresse->setEmail($inscription->getApprenant()->getAdresse()->getEmail());
            $adresse->setTelephone($inscription->getApprenant()->getAdresse()->getTelephone());
            $adresse->setBoitePostale($inscription->getApprenant()->getAdresse()->getBoitePostale());

            $this->adresseService->save($adresse);
            $this->apprenantService->save($apprenant);

            $entityManager->persist($inscription);
            $entityManager->flush();

            return $this->redirectToRoute('inscription_index');
        }

        return $this->render('inscription/new.html.twig', [
            'inscription' => $inscription,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inscription_show", methods={"GET"})
     */
    public function show(Inscription $inscription): Response
    {
        return $this->render('inscription/show.html.twig', [
            'inscription' => $inscription,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="inscription_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Inscription $inscription): Response
    {
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inscription_index');
        }

        return $this->render('inscription/edit.html.twig', [
            'inscription' => $inscription,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inscription_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Inscription $inscription): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscription->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inscription);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inscription_index');
    }
}
