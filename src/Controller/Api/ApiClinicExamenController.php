<?php
declare (strict_types=1);

namespace App\Controller\Api;

use App\Repository\ClinicExamenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/clinic-examen', name: 'api_clinic_examen_')]
final class ApiClinicExamenController extends AbstractController
{
    public function __construct(private ClinicExamenRepository $clinicExamenRepository) {

    }

    #[Route('/get-name', name: 'get', options: ['expose' => true], methods: ['GET'])]
    public function getName(): JsonResponse
    {
        $clinicExamens = $this->clinicExamenRepository->findAll();

        return $this->json($clinicExamens, 200, [], ['groups' => 'get']);
    }

}