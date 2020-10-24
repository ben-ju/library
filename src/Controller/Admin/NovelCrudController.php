<?php

namespace App\Controller\Admin;

use App\Entity\Novel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NovelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Novel::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
