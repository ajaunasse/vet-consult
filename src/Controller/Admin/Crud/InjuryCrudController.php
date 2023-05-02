<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Injury;
use App\Form\MajorInjuryClinicSignType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InjuryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Injury::class;
    }

    public function configureFields(string $pageName): iterable
    {
            yield IdField::new('id')->hideOnForm();
            yield TextField::new('name');
            yield CollectionField::new('majorClinicSigns')
                ->setEntryType(MajorInjuryClinicSignType::class)
                ->allowAdd()
                ->allowDelete()
            ;
    }
}
