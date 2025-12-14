<?php

namespace App\Controller;

use App\Entity\Barber;
use App\Entity\Reservation;
use App\Repository\BarberRepository;
use App\Repository\ReservationRepository;
use App\Form\BarberType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_BARBER')]
class BarberDashboardController extends AbstractController
{
    // ---------------------------------------------
    // 1. Dashboard View (Fetches requests or redirects to creation) - Route: /barber/dashboard
    // ---------------------------------------------
    #[Route('/barber/dashboard', name: 'app_barber_dashboard')]
    public function dashboard(BarberRepository $barberRepository, ReservationRepository $reservationRepository): Response
    {
        /** @var \App\Entity\User $currentUser */
        $currentUser = $this->getUser();

        // Check if a Barber profile exists for the current user
        $barber = $barberRepository->findOneBy(['user' => $currentUser]);

        if (!$barber) {
            $this->addFlash('warning', 'Please complete your barber profile setup to access the dashboard.');
            // CRITICAL: Redirect to the profile creation page
            return $this->redirectToRoute('app_barber_new'); 
        }

        // Fetch all PENDING reservation requests
        $pendingRequests = $reservationRepository->findBy([
            'barber' => $barber,
            'status' => 'pending',
        ], ['requestedTime' => 'ASC']);

        return $this->render('barber/dashboard.html.twig', [
            'barber' => $barber,
            'pendingRequests' => $pendingRequests,
        ]);
    }

    // ---------------------------------------------
    // 2. Barber Profile Creation - Route: /barber/new
    // ---------------------------------------------
    #[Route('/barber/new', name: 'app_barber_new')]
    public function newBarber(Request $request, EntityManagerInterface $entityManager, BarberRepository $barberRepository): Response
    {
        /** @var \App\Entity\User $currentUser */
        $currentUser = $this->getUser();

        // Check if the profile already exists
        if ($barberRepository->findOneBy(['user' => $currentUser])) {
            $this->addFlash('info', 'Your barber profile already exists.');
            return $this->redirectToRoute('app_barber_dashboard');
        }

        $barber = new Barber();
        $form = $this->createForm(BarberType::class, $barber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Link the new Barber profile to the currently logged-in User
            $barber->setUser($currentUser);

            $entityManager->persist($barber);
            $entityManager->flush();

            $this->addFlash('success', 'Your Barber profile has been successfully created! Redirecting to dashboard.');
            return $this->redirectToRoute('app_barber_dashboard');
        }

        return $this->render('barber/new.html.twig', [
            'barberForm' => $form->createView(),
        ]);
    }

    // ---------------------------------------------
    // 3. Status Update Action - Route: /barber/reservation/{id}/{status}
    // ---------------------------------------------
    #[Route('/barber/reservation/{id}/{status}', name: 'app_reservation_status', methods: ['GET'])]
    public function updateReservationStatus(
        Reservation $reservation, 
        string $status,
        EntityManagerInterface $entityManager
    ): Response
    {
        /** @var \App\Entity\User $currentUser */
        $currentUser = $this->getUser();
        
        // Security check: Ensure the logged-in barber owns this reservation's barber profile
        $barber = $reservation->getBarber();
        if ($barber === null || $barber->getUser() !== $currentUser) {
             $this->addFlash('error', 'You do not have permission to modify this reservation.');
             return $this->redirectToRoute('app_barber_dashboard');
        }

        // Validate the status change
        if (!in_array($status, ['accepted', 'rejected'])) {
            $this->addFlash('error', 'Invalid status provided.');
            return $this->redirectToRoute('app_barber_dashboard');
        }
        
        // Update and save
        $reservation->setStatus($status);
        $entityManager->flush();

        $this->addFlash('success', 'Reservation has been ' . $status . '!');
        
        return $this->redirectToRoute('app_barber_dashboard');
    }
}