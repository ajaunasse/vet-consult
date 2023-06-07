<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\ExamenStep;
use App\Repository\ClinicExamenRepository;
use App\Repository\ClinicSignValueRepository;
use App\Repository\ConsultationFlowRepository;
use App\Repository\ExamenStepRepository;
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
        private ExamenStepRepository $examenStepRepository,
        private ClinicExamenRepository $clinicExamenRepository,
        private ClinicSignValueRepository $clinicSignValueRepository,
        private EntityManagerInterface $entityManager
    ) {

    }

    #[Route('/{id}', name: 'post', options: ['expose' => true], methods: ['POST'])]
    public function post(Request $request, int $id) {
        return $this->json(
            $this->consultationFlowRepository->find($id), 200, [], ['groups' => 'get']
        );
    }

    #[Route('/get/{id}', name: 'get', options: ['expose' => true], methods: ['GET'])]
    public function getById(int $id) {
        return $this->json(
            $this->consultationFlowRepository->find($id), 200, [], ['groups' => 'get']
        );
    }

    #[Route('/{id}/add-step', name: 'add_step', options: ['expose' => true], methods: ['POST'])]
    public function save(Request $request, int $id): JsonResponse
    {
        $stepData = json_decode($request->getContent(), true);
        $consultationFlow =  $this->consultationFlowRepository->find($id);
        $previousStep = null;
        $triggerValue = null;

        if(isset($stepData['previousStepId'])){
            $previousStep = $this->examenStepRepository->find((int) $stepData['previousStepId']);
        }
        $key = $stepData['key'] ?? null;
        if($key !== null) {
            $step = $this->examenStepRepository->find((int) $key);
        } else {
            $step = new ExamenStep();
        }
        $step->setName(trim($stepData['name']));
        $step->setPosition((int) $stepData['position']);
        $step->setConsultationFlow($consultationFlow);
        $step->setPreviousExamen($previousStep);

        if(isset($stepData['triggerValue']) && isset($stepData['triggerExamen'])){
            $triggerValue = $this->clinicSignValueRepository->findOneBy(['name'=> $stepData['triggerValue']]);
            $triggerExamen = $this->clinicExamenRepository->findOneBy(['id'=> (int) $stepData['triggerExamen']]);
            $step->setTriggerValue($triggerValue);
            $step->setTriggerExamen($triggerExamen);
        }


        foreach ($stepData['examens'] as $examem) {
            $examen = $this->clinicExamenRepository->find($examem['id']);
            $step->addExamen($examen);
        }


        $this->entityManager->persist($step);


        $this->entityManager->flush();

        return $this->json([], 201);
    }

    #[Route('/remove-step/{id}', name: 'remove_step', options: ['expose' => true], methods: ['DELETE'])]
    public function deleteStep(Request $request, int $id): JsonResponse
    {
        $step = $this->examenStepRepository->find($id);

        $this->entityManager->remove($step);
        $this->entityManager->flush();

        return $this->json([], 201);
    }
}