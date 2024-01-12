<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use App\Repository\LogoRepository;
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
    public function index(ItemRepository $itemRepository, CategoryRepository $categoryRepository): Response
    {
        $item = $itemRepository->findAll();
        $category = $categoryRepository->findAll();
        return $this->render('pages/home.html.twig', [
            'items' => $item,
            'categories' => $category
        ]);
    }
    #[Route('/logo/{id}', name: 'render_logo')]
    public function renderLogo(int $id, LogoRepository $logoRepository): Response
    {
        $logo = $logoRepository->find($id);

        return $this->render('logo/logo.html.twig', [
            'logo' => $logo,
        ]);
    }
}
