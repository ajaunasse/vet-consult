<?php
declare(strict_types=1);

namespace App\Normalizer;

use App\Entity\ClinicExamen;
use App\Entity\ClinicSignValue;
use App\Entity\ConsultationFlow;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class ConsultationFlowNormalizer  implements NormalizerInterface
{

    public function normalize(mixed $object, string $format = null, array $context = [])
    {
        /** @var  ConsultationFlow $object */
        $data = [
            'id' => $object->getId(),
            'reason' => [
                'id' => $object->getReason()->getId(),
                'value' => $object->getReason()->getValue()
            ]
        ] ;

        foreach ($object->getExamenSteps() as $step) {
            $stepData = [
                'key' => $step->getId(),
                'name' => $step->getName(),
                'position' => (int) $step->getPosition(),
                'examens' => []
            ];
            foreach ($step->getExamens() as $examen) {
                $availableValues =$examen->getAvailableValues()->toArray() ;
               array_map(
                    function (ClinicSignValue $value) {
                        return $value->getName();
                    },
                    $availableValues,
                );
                /** @var ClinicExamen $examen */
                $stepData['examens'][] = [
                  'id' => $examen->getId(),
                  'name' => $examen->getFullValue(),
                  'values' => implode(',', $examen->getAvailableValues()->toArray()),
                  'availableValues' => array_map(
                      function (ClinicSignValue $value) {
                          return $value->getName();
                      },
                      $availableValues,
                  )
                ];
            }
            if($step->getPosition() === 1) {
                $data['steps'][] = $stepData;
                continue;
            }
            $stepData['previousStepKey'] = $step->getPreviousExamen()->getId();
            $stepData['previousStep'] = [
                'name'=> $step->getPreviousExamen()->getName(),
                'position' => $step->getPreviousExamen()->getPosition(),
            ];

            foreach ($step->getPreviousExamen()->getExamens() as $examen) {
                $availableValues =$examen->getAvailableValues()->toArray() ;
                array_map(
                    function (ClinicSignValue $value) {
                        return $value->getName();
                    },
                    $availableValues,
                );
                /** @var ClinicExamen $examen */
                $stepData['previousStep']['examens'][] = [
                    'id' => $examen->getId(),
                    'name' => $examen->getFullValue(),
                    'values' => implode(',', $examen->getAvailableValues()->toArray()),
                    'availableValues' => array_map(
                        function (ClinicSignValue $value) {
                            return $value->getName();
                        },
                        $availableValues,
                    )
                ];
            }
            $stepData['triggerValue'] = $step->getTriggerValue()?->getName();


            $data['steps'][] = $stepData;
        }

        return $data;
    }

    public function supportsNormalization(mixed $data, string $format = null)
    {
        return $data instanceof ConsultationFlow;
    }
}