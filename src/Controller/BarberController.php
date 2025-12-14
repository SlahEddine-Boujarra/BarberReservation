<?php

namespace App\Controller;

use App\Entity\Barber;
use App\Form\BarberType;
use App\Repository\BarberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/barber')]
final class BarberController extends AbstractController
{
    // List all barbers
    #[Route(name: 'app_barber_index', methods: ['GET'])]
    public function index(BarberRepository $barberRepository): Response
    {
        return $this->render('barber/index.html.twig', [
            'barbers' => $barberRepository->findAll(),
        ]);
    }

    // Show a single barber
    #[Route('/{id}', name: 'app_barber_show', methods: ['GET'])]
    public function show(?Barber $barber): Response
    {
        if (!$barber) {
            throw $this->createNotFoundException('Barber not found.');
        }

        return $this->render('barber/show.html.twig', [
            'barber' => $barber,
        ]);
    }

    // Edit a barber
    #[Route('/{id}/edit', name: 'app_barber_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ?Barber $barber, EntityManagerInterface $entityManager): Response
    {
        if (!$barber) {
            throw $this->createNotFoundException('Barber not found.');
        }

        // Optional security: only the owner can edit
        if ($barber->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('You are not allowed to edit this barber.');
        }

        $form = $this->createForm(BarberType::class, $barber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Barber updated successfully.');

            return $this->redirectToRoute('app_barber_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('barber/edit.html.twig', [
            'barber' => $barber,
            'form' => $form,
        ]);
    }

    // Delete a barber
    #[Route('/{id}', name: 'app_barber_delete', methods: ['POST'])]
    public function delete(Request $request, ?Barber $barber, EntityManagerInterface $entityManager): Response
    {
        if (!$barber) {
            throw $this->createNotFoundException('Barber not found.');
        }

        // Optional security: only the owner can delete
        if ($barber->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('You are not allowed to delete this barber.');
        }

        $token = $request->request->get('_token');
        if ($this->isCsrfTokenValid('delete'.$barber->getId(), $token)) {
            $entityManager->remove($barber);
            $entityManager->flush();

            $this->addFlash('success', 'Barber deleted successfully.');
        } else {
            $this->addFlash('error', 'Invalid CSRF token.');
        }

        return $this->redirectToRoute('app_barber_index', [], Response::HTTP_SEE_OTHER);
    }
}
