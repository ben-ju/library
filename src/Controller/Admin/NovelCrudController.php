<?php

namespace App\Controller\Admin;

use App\Entity\Novel;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NovelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Novel::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextField::new('reference_number')->hideOnForm(),
            IntegerField::new('stock'),
            IntegerField::new('pages'),
            TextField::new('original_language'),
            TextField::new('isbn'),
            DateField::new('published_at'),
            TextField::new('publisher'),
            TextField::new('description')->hideOnIndex(),
            TextField::new('illustration')->hideOnIndex(),
            AssociationField::new('authors'),
            AssociationField::new('categories'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDateFormat('medium');
    }

}
