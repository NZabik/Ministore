<?php

namespace App\Controller\Admin;

use App\Entity\Item;
use App\Entity\Logo;
use App\Entity\User;
use App\Entity\Orders;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Evaluation 2024');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linktoRoute('Retour au site', 'fa fa-home', 'home.index');
        yield MenuItem::linkToCrud('User', 'fas fa-users', User::class)->setDefaultSort(['id' => 'ASC']);
        yield MenuItem::linkToCrud('Item', 'fas fa-mobile-screen', Item::class)->setDefaultSort(['id' => 'ASC']);
        yield MenuItem::linkToCrud('Category', 'fas fa-layer-group', Category::class)->setDefaultSort(['id' => 'ASC']);
        yield MenuItem::linktoRoute('Orders', 'fas fa-shopping-cart', 'app_orders_admin');
        yield MenuItem::linktoCrud('Logo', 'fas fa-image', Logo::class);
    }
}
