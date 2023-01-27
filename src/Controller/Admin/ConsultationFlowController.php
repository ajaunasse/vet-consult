<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsultationFlowController extends AbstractController
{
    #[Route('/admin/consultation/flow', name: 'admin_consultation_flow')]
    public function index(): Response
    {
        return $this->render('admin/consultation_flow/index.html.twig', [
        ]);
    }
}
