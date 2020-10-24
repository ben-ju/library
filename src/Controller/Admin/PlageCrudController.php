<?php

namespace App\Controller\Admin;

use App\Entity\Plage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PlageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Plage::class;
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
