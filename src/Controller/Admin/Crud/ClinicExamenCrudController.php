<?php

namespace App\Controller\Admin\Crud;

use App\Entity\ClinicExamen;
use App\Form\SubExamenType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClinicExamenCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClinicExamen::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInPlural('Examen cliniques')
            ->setEntityLabelInSingular('Examen clinique')

            ->setPageTitle('new', 'Création d\'un examen clinique')
            ->setPageTitle('edit', 'Édition d\'un examen clinique')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
            yield IdField::new('id')->hideOnForm();
            yield AssociationField::new('type')
                ->setCrudController(ClinicSignTypeCrudController::class);
            yield TextField::new('subTitle')
                ->setLabel('Sous examens (laisser vide si = Examen Type)');
            yield AssociationField::new('availableValues')
                ->setTemplatePath('admin/clinic_examen/available_values.html.twig')
                ->setCrudController(ClinicSignValueCrudController::class)
                ->setLabel('Valeurs possibles')
                ;
    }
}
