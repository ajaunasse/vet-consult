<?php
declare(strict_types=1);

namespace App\Service\Guesser;

use App\Entity\ConsultationReason;
use App\Entity\Injury;
use App\Repository\InjuryRepository;

final class InjuryGuesser
{
    public function __construct(private InjuryRepository $injuryRepository) {

    }

    public function guess(array $symptoms): ?Injury
    {
        $possibleInjuries = $this->injuryRepository->findAll();

        foreach ($possibleInjuries as $injury) {
            /** @var Injury $injury */
            if($injury->matchWithSymptom($symptoms)) {
                return $injury;
            }

        }

        return null;

    }
}