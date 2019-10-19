<?php

namespace Domain\Exercise\Services;

use GuzzleHttp\Client;

class GlotService
{
    public function run(string $language, string $code)
    {
        $client = new Client();

        $response = $client->post("https://run.glot.io/languages/$language/latest",
            [
                'headers' => [
                    'Authorization' => 'Token ' . config('services.glot.secret'),
                    'Content-type' => 'application/json'
                ],
                'json' => [
                    "files" => [
                        [
                            "name" => "main." . config("services.glot.file_extensions.$language"),
                            "content" => $code
                        ]
                    ]
                ]
            ]);

        return json_decode($response->getBody()->getContents());
    }
}