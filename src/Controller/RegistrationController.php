<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationApprenantFormType;
use App\Form\RegistrationEnseignantFormType;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\UserAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder,
                             GuardAuthenticatorHandler $guardHandler, UserAuthenticator $authenticator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Génération du token d'activation du compte utilisateur
            $user->setActivationToken(md5(uniqid()));
            $user->setRoles(['ROLE_ADMIN']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();



            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/apprenant", name="app_apprenant_register")
     */
    public function apprenantRegister(Request $request, UserPasswordEncoderInterface $passwordEncoder,
                             GuardAuthenticatorHandler $guardHandler, UserAuthenticator $authenticator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationApprenantFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_APPRENANT']);

            // Génération du token d'activation du compte utilisateur
            $user->setActivationToken(md5(uniqid()));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            /*
            // do anything else you need here, like send an email
            $message = (new \Swift_Message('Activation de votre compte'))
                //Expéditeur
                ->setFrom('smlfolong@gmail.com')
                //Destinataire
                ->setTo($user->getEmail())
                // Contenu du mail
                ->setBody(
                    $this->renderView('email/activation.html.twig', ['token' => $user->getActivationToken()]),
                    'text/html'
                )
            ;
            // Envoie du mail
            $mailer->send($message);
            */

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/enseignant", name="app_enseignant_register")
     */
    public function enseignantRegister(Request $request, UserPasswordEncoderInterface $passwordEncoder,
                             GuardAuthenticatorHandler $guardHandler, UserAuthenticator $authenticator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationEnseignantFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_ENSEIGNANT']);

            // Génération du token d'activation du compte utilisateur
            $user->setActivationToken(md5(uniqid()));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            /*
            // do anything else you need here, like send an email
            $message = (new \Swift_Message('Activation de votre compte'))
                //Expéditeur
                ->setFrom('smlfolong@gmail.com')
                //Destinataire
                ->setTo($user->getEmail())
                // Contenu du mail
                ->setBody(
                    $this->renderView('email/activation.html.twig', ['token' => $user->getActivationToken()]),
                    'text/html'
                )
            ;
            // Envoie du mail
            $mailer->send($message);
            */

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/enseignant.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/activation/{token}", name="activation")
     */
    public function activationUserAccount($token, UserRepository $userRepository) {
        //On vérifie si un utilisateur a ce token
        $user = $userRepository->findOneBy(['activation_token' => $token]);

        //Si aucun utilisateur n'existe avec ce token
        if (!$user) {
            // Erreur 404
            throw $this->createNotFoundException('Cet utilisateur n\'existe pas');
        }

        // On supprime le token
        $user->setActivationToken(null);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // On envoie un message flash
        $this->addFlash('message', 'Votre compte bien été activé');

        // On redirige l'utilisateur vers l'accueil
        return $this->redirectToRoute('home');
    }
}
