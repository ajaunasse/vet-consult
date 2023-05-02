<?php

namespace App\Controller\Admin\Crud;

use App\Entity\ConsultationFlow;
use App\Entity\ConsultationReason;
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


    public function configureFields(string $pageName): iterable
    {
        return [
            yield AssociationField::new('reason')->setCrudController(ConsultationReason::class)
        ];
    }

}
