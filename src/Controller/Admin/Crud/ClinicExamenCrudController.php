<?php

namespace App\Controller\Admin\Crud;

use App\Entity\ClinicExamen;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ClinicExamenCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClinicExamen::class;
    }

    public function configureFields(string $pageName): iterable
    {
            yield IdField::new('id')->hideOnForm();
            yield AssociationField::new('type')->setCrudController(ClinicSignTypeCrudController::class);
            yield AssociationField::new('availableValues')
                ->setTemplatePath('admin/clinic_examen/available_values.html.twig')
                ->setCrudController(ClinicSignValueCrudController::class)
                ;
    }
}
