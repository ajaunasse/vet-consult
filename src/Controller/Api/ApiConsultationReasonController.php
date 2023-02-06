<?php
declare (strict_types=1);

namespace App\Controller\Api;

use App\Repository\ConsultationReasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/consultation-reason', name: 'api_consultation_reason_')]
final class ApiConsultationReasonController extends AbstractController
{
    public function __construct(private ConsultationReasonRepository $consultationReasonRepository) {

    }

    #[Route('/get-all', name: 'get', options: ['expose' => true], methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $consultationReasons = $this->consultationReasonRepository->findAll();
        return $this->json($consultationReasons, 200, [], ['groups' => 'get']);
    }

}