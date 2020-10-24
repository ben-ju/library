<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Entity\Category;
use App\Entity\Cd;
use App\Entity\Dvd;
use App\Entity\Novel;
use App\Entity\Penalty;
use App\Entity\Plage;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(AuthorCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Library');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Category', 'fa fa-folder-open', Category::class);
        yield MenuItem::linkToCrud('Author', 'fa fa-folder-open', Author::class);
        yield MenuItem::linkToCrud('Cd', 'fa fa-folder-open', Cd::class);
        yield MenuItem::linkToCrud('Dvd', 'fa fa-folder-open', Dvd::class);
        yield MenuItem::linkToCrud('Novel', 'fa fa-folder-open', Novel::class);
        yield MenuItem::linkToCrud('Penalty', 'fa fa-folder-open', Penalty::class);
        yield MenuItem::linkToCrud('Plage', 'fa fa-folder-open', Plage::class);
        yield MenuItem::linkToCrud('User', 'fa fa-folder-open', User::class);
    }

}
