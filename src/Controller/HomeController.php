<?php

namespace App\Controller;

use App\Repository\ItemRepository;
use App\Repository\LogoRepository;
use App\Repository\PagesRepository;
use App\Repository\NavbarRepository;
use App\Repository\CategoryRepository;
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
    #[Route('/navbar', name: 'navbar')]
    public function navbar(NavbarRepository $navbarRepository): Response
    {
        $navbar = $navbarRepository->findAll();
        return $this->render('partials/_navbar.html.twig', [
            'navbars' => $navbar
        ]);
    }
    #[Route('/pages', name: 'navbar')]
    public function pages(PagesRepository $pagesRepository): Response
    {
        $pages = $pagesRepository->findAll();
        return $this->render('partials/_pages.html.twig', [
            'pages' => $pages
        ]);
    }
}
