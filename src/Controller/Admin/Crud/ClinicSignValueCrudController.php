<?php

namespace App\Controller\Admin\Crud;

use App\Entity\ClinicSignValue;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ClinicSignValueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClinicSignValue::class;
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
