<?php

namespace App\Controller;

use App\Repository\ConsultationReasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(private ConsultationReasonRepository $consultationReasonRepository) {

    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'reasons' => $this->consultationReasonRepository->findAll(),
        ]);
    }
}
