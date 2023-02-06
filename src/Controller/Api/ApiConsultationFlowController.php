<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\ConsultationFlow;
use App\Entity\ConsultationFlowExamens;
use App\Repository\ClinicExamenRepository;
use App\Repository\ConsultationFlowRepository;
use App\Repository\ConsultationReasonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/consultation-flow', name: 'api_consultation_flow_')]
final class ApiConsultationFlowController extends AbstractController
{

    public function __construct(
        private ConsultationFlowRepository $consultationFlowRepository,
        private ConsultationReasonRepository $consultationReasonRepository,
        private ClinicExamenRepository $clinicExamenRepository,
        private EntityManagerInterface $entityManager
    ) {

    }

    #[Route('/get/{id}', name: 'get', options: ['expose' => true], methods: ['GET'])]
    public function getById(int $id) {

        return $this->json(
            $this->consultationFlowRepository->find($id), 200, [], ['groups' => 'get']
        );
    }

    #[Route('/save', name: 'save', options: ['expose' => true], methods: ['POST'])]
    public function save(Request $request): JsonResponse
    {
        $flowData = json_decode($request->getContent(), true);

        $flow = new ConsultationFlow();

        if($flowData['id'] !== null)  {
            $flow = $this->consultationFlowRepository->find($flowData['id']);
        }

        $flow->setReason($this->consultationReasonRepository->find((int) $flowData['reason']));
        foreach ($flowData['examens'] as $examen) {
            $consultationFlowExamen = new ConsultationFlowExamens();
            $consultationFlowExamen->setClinicExamen($this->clinicExamenRepository->find($examen['id']));
            $consultationFlowExamen->setPosition($examen['position']);
            $flow->addExamen($consultationFlowExamen);

        }
        $this->entityManager->persist($flow);
        $this->entityManager->flush();

        return $this->json($flow, 200, [], ['groups' => 'get']);
    }
}