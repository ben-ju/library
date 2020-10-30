<?php

namespace App\Controller\Admin;

use App\Entity\Penalty;
use Doctrine\DBAL\Types\FloatType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PenaltyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Penalty::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ChoiceField::new('type')->setChoices([
                'One day' => 'one_day',
                'Seven days' => 'seven_days',
                'Fourteen days' => 'fourteen_days',
                'Blacklisted' => 'blacklisted',
            ])->hideOnForm(),
            NumberField::new('amount')->setNumDecimals(2),
            DateField::new('date')->hideOnForm(),
            AssociationField::new('user')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDateFormat('medium');
    }
}
