<?php

namespace App\Controller\Admin\Crud;

use App\Entity\ConsultationReason;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ConsultationReasonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ConsultationReason::class;
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
