<?php

namespace MorningTrain\Foundation\React;

use GuzzleHttp\Client;

class Renderer
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var bool
     */
    protected $active;

    public function __construct(string $host)
    {
        $this->active = true;
        $this->client = new Client(['base_uri' => $host]);
    }

    public function getMarkup(string $component, array $props = [], array $env = [])
    {
        try {
            $response = $this->client->post('', [
                'json' => [
                    'component' => $component,
                    'props' => $props,
                    'env' => (object)$env
                ]
            ]);

            $this->active = true;
            return $response->getBody()->getContents();

        } catch (\Exception $ex) {
            $this->active = false;
            return '';
        }
    }

    public function isActive()
    {
        return $this->active;
    }

}
