<?php

namespace App\Controller\Admin;

use App\Entity\Penalty;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PenaltyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Penalty::class;
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
