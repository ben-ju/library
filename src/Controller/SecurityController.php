<?php

namespace App\Controller;

use App\Controller\Manager\RegistrationManager;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Services\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="logout")
     * @param SessionService $sessionService
     */
    public function logout(SessionService $sessionService): void
    {
        $sessionService->clearSession();
    }


    /**
     * @Route("/register", name="registration")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param RegistrationManager $registrationManager
     * @return Response
     */
    public function registration(Request $request,
                                 UserPasswordEncoderInterface $encoder,
                                 RegistrationManager $registrationManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            $manager->persist($user);
            $manager->flush();
// TODO find a way to send mail with the template given in the event const
            $registrationManager->sendRegistrationMail($user);

            return $this->redirectToRoute('home');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
