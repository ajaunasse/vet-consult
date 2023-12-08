<?php
declare(strict_types=1);

namespace App\Controller\ContactRequest;

use App\Entity\ClinicExamen;
use App\Entity\Consultation;
use App\Entity\ContactRequest;
use App\Entity\ExamenStep;
use App\Entity\Injury;
use App\Entity\User;
use App\Form\ContactRequestType;
use App\Repository\ConsultationFlowRepository;
use App\Repository\ConsultationReasonRepository;
use App\Repository\ContactRequestRepository;
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

final class ContactRequestController extends AbstractController
{

    public function __construct(
        private Security $security,
        private ContactRequestRepository $contactRequestRepository,
        private EntityManagerInterface $entityManager
    ) {

    }
    #[Route('/contact-request', name: 'app_contact_request_index', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        $user = $this->security->getUser();
        return $this->render('contactRequest/index.html.twig', [
            'contactRequests' => $this->contactRequestRepository->findBy(['user' => $user]),
        ]);
    }

    #[Route('/contact-request/new', name: 'app_contact_request_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $user = $this->security->getUser();
        $contactRequest = new ContactRequest();
        if($user instanceof User) {
            $contactRequest = ContactRequest::fromUser($user);
            $contactRequest->setCreatedAt(new DateTimeImmutable());
        }
        $form = $this->createForm(ContactRequestType::class, $contactRequest);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()  ) {

            $contactRequest = $form->getData();
            $contactRequest->setCreatedAt(new DateTimeImmutable());
            $this->entityManager->persist($contactRequest);
            $this->entityManager->flush();
            $this->addFlash('success', 'Merci pour votre message, votre demande a bien été prise en compte !');
            return $this->redirectToRoute('app_contact_request_index');
        }

        return $this->render('contactRequest/new.html.twig', [
            'form' => $form,
            'contactRequest' => $contactRequest,
        ]);
    }
}