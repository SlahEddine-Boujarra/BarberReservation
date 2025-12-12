<?php

namespace App\Controller;

use App\Entity\Barber;
use App\Form\BarberType;
use App\Repository\BarberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/barber')]
final class BarberController extends AbstractController
{
    #[Route(name: 'app_barber_index', methods: ['GET'])]
    public function index(BarberRepository $barberRepository): Response
    {
        return $this->render('barber/index.html.twig', [
            'barbers' => $barberRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_barber_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $barber = new Barber();
        $form = $this->createForm(BarberType::class, $barber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($barber);
            $entityManager->flush();

            return $this->redirectToRoute('app_barber_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('barber/new.html.twig', [
            'barber' => $barber,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_barber_show', methods: ['GET'])]
    public function show(Barber $barber): Response
    {
        return $this->render('barber/show.html.twig', [
            'barber' => $barber,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_barber_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Barber $barber, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BarberType::class, $barber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_barber_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('barber/edit.html.twig', [
            'barber' => $barber,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_barber_delete', methods: ['POST'])]
    public function delete(Request $request, Barber $barber, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$barber->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($barber);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_barber_index', [], Response::HTTP_SEE_OTHER);
    }
}
