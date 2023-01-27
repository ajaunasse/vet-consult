<?php

namespace App\Controller\Admin\Crud;

use App\Entity\ConsultationFlow;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ConsultationFlowCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ConsultationFlow::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
       return Crud::new()
//            // ...
//
//            // the first argument is the "template name", which is the same as the
//            // Twig path but without the `@EasyAdmin/` prefix
            ->overrideTemplate('crud/new', 'admin/consultation_flow/new.html.twig');
//
//            ->overrideTemplates([
//                'crud/index' => 'admin/pages/index.html.twig',
//                'crud/field/textarea' => 'admin/fields/dynamic_textarea.html.twig',
//            ])
//            ;
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
