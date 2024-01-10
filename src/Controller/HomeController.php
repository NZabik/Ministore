<?php

namespace App\Controller;

use App\Repository\ItemRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', 'home.index', methods: ['GET'])]
    // public function index(): Response
    // {
    //     return $this->render('pages/home.html.twig');
    // }
    public function index(ItemRepository $itemRepository): Response
    {
        $mobiles = $itemRepository->findBy(['category' => 1]);
        $watches = $itemRepository->findBy(['category' => 2]);
        return $this->render('pages/home.html.twig', [
            'mobiles' => $mobiles,
            'watches' => $watches
        ]);
    }
}
?>