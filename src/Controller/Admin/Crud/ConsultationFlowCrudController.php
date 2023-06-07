<?php

namespace App\Controller\Admin\Crud;

use App\Entity\ConsultationFlow;
use App\Entity\ConsultationReason;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ConsultationFlowCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ConsultationFlow::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->overrideTemplate('crud/new', 'admin/consultation_flow/new.html.twig')
            ->overrideTemplate('crud/edit', 'admin/consultation_flow/edit.html.twig')
            ->setEntityLabelInPlural('Graphe de consultation')
            ->setPageTitle(Crud::PAGE_NEW, 'Création d\'un graphe de consultation')
            ->setPageTitle(Crud::PAGE_EDIT, 'Édition d\'un graphe de consultation')
            ->setEntityLabelInSingular('Graphe de consultation')
            ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-plus')
                    ->setCssClass(' action-new btn btn-success')
                    ->setLabel('Nouveau graphe de consultation');
            })

            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield IdField::new('id')->hideOnForm(),
            yield AssociationField::new('reason')->setLabel('Consultation raison')
        ];
    }

}
