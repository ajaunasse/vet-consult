<?php

namespace App\Command;

use App\Entity\Consultation;
use App\Entity\User;
use App\Repository\ConsultationRepository;
use App\Repository\InjuryRepository;
use App\Repository\UserRepository;
use App\Service\OpenAI\OpenAIClient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Stopwatch\Stopwatch;

#[AsCommand(
    name: 'app:test-open-ai',
    description: 'Add a short description for your command',
)]
class TestOpenAICommand extends Command
{
    private SymfonyStyle $io;

    private const POSITIVE_VALUE = [
        'Oui',
        'Diminuée ou absente',
        'Normal ou augmenté'
    ];
    public function __construct(
        private ConsultationRepository $consultationRepository,
        private OpenAIClient $openAIClient,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        /** @var Consultation $consultation */
        $consultation = $this->consultationRepository->createQueryBuilder('c')
            ->where('c.injury IS NOT NULL')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        $promptSymptom = [];
        foreach ($consultation->getSymptoms() as $symptom) {
            $examenName = $symptom['examen'];
            if(str_contains($symptom['examen'], '-')) {
                $examenName = explode('-', $symptom['examen'])[1];
            }

            $promptSymptom[] = $examenName . ' : ' . $symptom['symptom']['name'];
        }

        $openAiResult = $this->openAIClient->guessInjury($consultation->getReasons()->getValue(), $promptSymptom);
        dd($openAiResult);
        return Command::SUCCESS;
    }
}
