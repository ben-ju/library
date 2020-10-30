<?php

namespace App\Controller\Admin;

use App\Entity\Dvd;
use Doctrine\DBAL\Types\BooleanType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DvdCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dvd::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextField::new('reference_number')->hideOnForm(),
            IntegerField::new('stock'),
            DateField::new('published_at'),
            TextField::new('publisher'),
            TextField::new('description'),
            TextField::new('illustration'),
            BooleanField::new('has_bonus'),
            IntegerField::new('duration'),
            AssociationField::new('authors'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDateFormat('medium');
    }

}
