<?php

namespace App\Controller\Admin;

use App\Entity\Dvd;
use Doctrine\DBAL\Types\BooleanType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
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
            IdField::new('id'),
            TextField::new('reference_number'),
            IntegerField::new('stock'),
            DateField::new('published_at'),
            TextField::new('publisher'),
            TextField::new('description'),
            TextField::new('illustration'),
            IntegerField::new('duration'),
            BooleanField::new('has_bonus'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDateFormat('medium');
    }

}
