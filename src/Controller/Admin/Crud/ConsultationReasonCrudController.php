<?php

namespace App\Controller\Admin\Crud;

use App\Entity\ConsultationReason;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ConsultationReasonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ConsultationReason::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInPlural('Motifs de consultation')
            ->setEntityLabelInSingular('Motif de consultation')

            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un motif de consultation')
            ->setPageTitle(Crud::PAGE_EDIT, 'Éditer un motif de consultation')
            ;
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
