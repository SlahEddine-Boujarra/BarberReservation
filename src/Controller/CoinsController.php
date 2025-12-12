<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Entity\User;
#[Route('/coins')]
#[IsGranted('ROLE_USER')]
class CoinsController extends AbstractController
{
    #[Route('/', name: 'app_coins_shop')]
    public function shop(): Response
    {
        return $this->render('coins/shop.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

     #[Route('/purchase/{amount}', name: 'app_coins_purchase', methods: ['POST'])]
    public function purchase(int $amount, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        // Validate amount (only allow predefined packages)
        $validAmounts = [10, 50, 100, 500];
        if (!in_array($amount, $validAmounts)) {
            $this->addFlash('error', 'Invalid coin package selected.');
            return $this->redirectToRoute('app_coins_shop');
        }

        // In a real application, you would process payment here
        // For now, we'll just add the coins directly
        $user->addCoins($amount);
        $entityManager->flush();

        $this->addFlash('success', "Successfully purchased {$amount} coins!");
        return $this->redirectToRoute('app_coins_shop');
    } 
}