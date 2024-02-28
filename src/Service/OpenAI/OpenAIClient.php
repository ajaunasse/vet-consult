<?php

declare(strict_types=1);

namespace App\Service\OpenAI;

use Symfony\Contracts\HttpClient\HttpClientInterface;

final class OpenAIClient
{

    private const COMPLETION_URL = 'https://api.openai.com/v1/chat/completions';
    private const DEFAULT_MODEL = 'gpt-3.5-turbo';
    private const HEADER_AUTHORIZATION_KEY = 'Bearer %s';

    public function __construct(private HttpClientInterface $client, private string $apiKey) {

    }

    public function guessInjury(string $consultationReason, array $symptoms): array
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => sprintf(self::HEADER_AUTHORIZATION_KEY, $this->apiKey)
        ];

        $message = 'I\'ve a dog in consultation because of '.$consultationReason . '.\\n';
        $message .= 'I did a bunch of examens in order to find the neurological disorder. \\n';
        $message .= 'Here is the list of the examen and the result I did :\\n';
        foreach ($symptoms as $symptom ) {
            $message .= $symptom . '\\n';
        }
        $message .= 'Could you help me to find the neurological disorder ?';
        dd($message);
        $body = [
            'model' => self::DEFAULT_MODEL,
            'message' => [
                [
                    'role' => 'system',
                    'content' => 'You are a helpful assistant.'
                ],
                [
                    'role' => 'user',
                    'content' => $message
                ]

            ]
        ];

     //   dd(json_encode($body));
        try {
            $result = $this->client->request('POST', self::COMPLETION_URL, [
                'headers' => $headers,
                'body' => json_encode($body)
            ]);
        } catch (\Exception $e) {
            dd($e);

        }

        dd($result);
    }
}