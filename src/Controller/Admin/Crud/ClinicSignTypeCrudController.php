<?php

namespace App\Controller\Admin\Crud;

use App\Entity\ClinicSignType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ClinicSignTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClinicSignType::class;
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
