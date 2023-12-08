<?php

declare(strict_types=1);

namespace App\Controller\Admin\Crud;

use App\Entity\ClinicExamen;
use App\Entity\ContactRequest;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

final class ContactRequestCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string {
        return ContactRequest::class;
    }

    public function configureCrud(Crud $crud): Crud {
        return Crud::new()
            ->setEntityLabelInPlural('Demande de contact');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->remove(Crud::PAGE_INDEX, 'new')
            ->remove(Crud::PAGE_INDEX, 'edit')
            ->remove(Crud::PAGE_INDEX, 'delete')
            ->add(Crud::PAGE_INDEX, 'detail')
            ->remove(Crud::PAGE_DETAIL, 'edit')
            ->remove(Crud::PAGE_DETAIL, 'delete')
            ;
    }

}