<?php

namespace App\Controller\Admin;

use App\Entity\Cd;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CdCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cd::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('reference_number'),
            IntegerField::new('stock'),
            DateField::new('published_at')->hideOnForm(),
            TextField::new('publisher'),
            TextField::new('description'),
            TextField::new('illustration'),
            IntegerField::new('total_duration')->hideOnForm(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDateFormat('medium');
    }

}
