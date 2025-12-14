<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\SecurityBundle\Security; // We'll need this to log the user in immediately

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request, 
        UserPasswordHasherInterface $userPasswordHasher, 
        EntityManagerInterface $entityManager,
        Security $security // Inject the Security component
    ): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // 1. Hash the Password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // 2. Set the Role
            $submittedRole = $form->get('role')->getData(); 
            $user->setRoles([$submittedRole]);

            // 3. Save the User
            $entityManager->persist($user);
            $entityManager->flush();

            // 4. Log the user in immediately (optional, but highly recommended)
            $security->login($user);

            // 5. 🛑 ROLE-BASED REDIRECTION
            if ($submittedRole === 'ROLE_BARBER') {
                // Redirect Barbers to the barber index page
                $this->addFlash('success', 'Welcome! Please set up your business details.');
                return $this->redirectToRoute('app_barber_new'); 
            }
            
            // Default redirection for 'ROLE_USER' (general customer)
            $this->addFlash('success', 'Registration successful! Welcome to Fresha.');
            return $this->redirectToRoute('app_home'); 
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}