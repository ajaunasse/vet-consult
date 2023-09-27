<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\ClinicExamen;
use App\Entity\Consultation;
use App\Entity\ExamenStep;
use App\Entity\Injury;
use App\Repository\ConsultationFlowRepository;
use App\Repository\ConsultationReasonRepository;
use App\Repository\ExamenStepRepository;
use App\Repository\InjuryRepository;
use App\Service\Guesser\InjuryGuesser;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

final class ConsultationController extends AbstractController
{

    public function __construct(
        private ConsultationFlowRepository $consultationFlowRepository,
        private EntityManagerInterface $entityManager,
        private InjuryGuesser $injuryGuesser,
        private Security $security,
        private ConsultationReasonRepository $consultationReasonRepository
    ) {

    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('consultation/index.html.twig', [
            'reasons' => $this->consultationReasonRepository->findAll(),
        ]);
    }

    #[Route('/consultation/new', name: 'app_consultation_new', methods: 'POST')]
    public function new(Request $request): Response
    {
        $reasonId = (int) $request->request->get('reason') ?? null;
        if($reasonId === null) {
            throw new NotFoundHttpException();
        }

        $flow  = $this->consultationFlowRepository->findOneBy(['reason' => $reasonId]);

        if($flow === null) {
            $this->addFlash('danger', 'Aucune données trouvées pour ce motif de consultation');
            return $this->redirectToRoute('app_home');
        }
        $nextStep = $flow->getFirstStep();

        if($nextStep === null) {
            $this->addFlash('danger', 'Aucune données trouvées pour ce motif de consultation');
            return $this->redirectToRoute('app_home');
        }
        $consultation = new Consultation();
        $consultation->setConsultationFlow($flow);
        $consultation->setReasons($flow->getReason());
        $consultation->setCurrentStep($nextStep);
        $consultation->setUser($this->security->getUser());
        $consultation->setCreatedAt(new DateTimeImmutable());

        $this->entityManager->persist($consultation);
        $this->entityManager->flush();


        return $this->redirectToRoute('app_consultation_current_step', [
            'consultationId' => $consultation->getId(),
            'stepId' => $nextStep->getId()
        ]);
    }

    /**
     * @ParamConverter("consultation", options={"id" = "consultationId"})
     * @ParamConverter("currentStep", options={"id" = "stepId"})
     */
    #[Route('/consultation/{consultationId}/step/{stepId}', name: 'app_consultation_current_step', methods: ['GET'])]
    public function currentStep(Consultation $consultation): Response
    {
        return $this->render('consultation/examen_step.html.twig', [
            'consultation' => $consultation
        ]);
    }

    /**
     * @ParamConverter("consultation", options={"id" = "consultationId"})
     * @ParamConverter("currentStep", options={"id" = "stepId"})
     */
    #[Route('/consultation/{consultationId}/step/{stepId}/validate', name: 'app_consultation_validate_step', methods: ['POST'])]
    public function validateStep(
        Request $request,
        Consultation $consultation,
        ExamenStep $currentStep
    ): Response
    {

        $nextStepPosition = $currentStep->getPosition() + 1;
        $values = $request->request->all();

        $flow = $consultation->getConsultationFlow();

        $nextStep = $flow->findNextStep($nextStepPosition, $values, $currentStep->getId());

        if($nextStep === null) {
            return $this->redirectToRoute(
                'app_consultation_guess_injury',
                ['consultationId' => $consultation->getId(),]
            );
        }


        if($nextStep->isMultiFocal()) {
            return $this->render('consultation/multi_focal.html.twig', [
                'consultation' => $consultation
            ]);
        }

        if($nextStep->getLinkedConsultationFlow() !== null) {
            $newConsultationFlow = $nextStep->getLinkedConsultationFlow();
            $consultation->setConsultationFlow($newConsultationFlow);
            $consultation->setCurrentStep($newConsultationFlow->getFirstStep());
            $consultation->setSymptoms([]);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_consultation_current_step', [
                'consultationId' => $consultation->getId(),
                'stepId' => $newConsultationFlow->getFirstStep()->getId()
            ]);
        }

        $consultation->addPreviousExamensStep($currentStep);
        $consultation->setCurrentStep($nextStep);
        foreach ($currentStep->getExamens() as $examen) {
            if(!isset($values[$examen->getId()])) {
                continue;
            }
            /** @var ClinicExamen $examen */
            $consultation->addSymptom(
                $examen,
                $examen->findValue((int) $values[$examen->getId()])
            );
        }

        $this->entityManager->flush();


        return $this->redirectToRoute('app_consultation_current_step', [
            'consultationId' => $consultation->getId(),
            'stepId' => $nextStep->getId()
        ]);
    }

    /**
     * @ParamConverter("consultation", options={"id" = "consultationId"})
     */
    #[Route('/consultation/{consultationId}/guess-injury', name: 'app_consultation_guess_injury', methods: ['GET'])]
    public function guessInjury(Consultation $consultation): Response
    {
        $injury = $this->injuryGuesser->guess($consultation->getSymptoms());

        if($injury !== null) {
            $consultation->setInjury($injury);
            $this->entityManager->flush();
        }

        return $this->render('consultation/guess_injury.html.twig', [
            'injury' => $this->injuryGuesser->guess($consultation->getSymptoms()),
            'consultation' => $consultation
        ]);
    }
}