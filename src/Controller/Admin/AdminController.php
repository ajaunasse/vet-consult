<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Crud\ClinicExamenCrudController;
use App\Entity\ClinicExamen;
use App\Entity\ClinicSignType;
use App\Entity\ClinicSignValue;
use App\Entity\ConsultationFlow;
use App\Entity\ConsultationReason;
use App\Entity\Injury;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $urlRedirect = $this->adminUrlGenerator
            ->setController(ClinicExamenCrudController::class)
            ->generateUrl()
        ;
        return $this->redirect($urlRedirect);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Vet Consult');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Administration');
        yield MenuItem::linkToCrud('Motif de consultation', 'fas fa-hospital', ConsultationReason::class);
        yield MenuItem::linkToCrud('Atteinte neurologique', 'fas fa-brain', Injury::class);
        yield MenuItem::linkToCrud('Examen clinique', 'fas fa-stethoscope', ClinicExamen::class);
        yield MenuItem::linkToCrud('Type de Signe clinique', 'fas fa-list', ClinicSignType::class);
        yield MenuItem::linkToCrud('Valeur des signes cliniques', 'fas fa-list', ClinicSignValue::class);
        yield MenuItem::linkToCrud('Consultation flow', 'fas fa-list', ConsultationFlow::class);
    }
}
