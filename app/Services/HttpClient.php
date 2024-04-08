<?php

namespace App\Services;

use App\Helpers\Utilities;

class HttpClient
{
    private $client;

    /**
     * Initialize new curl session
     */
    public function init(): void
    {
        $this->client = curl_init();
    }

    /**
     * Sends a POST request
     * 
     * @param array $payload data to be sent to the api
     * @return bool|string
     */
    public function post(array $payload, string $txnid): bool|string
    {
        curl_setopt($this->client, CURLOPT_URL, $_ENV['API_BASE_URL'] . $txnid . '/post');
        curl_setopt($this->client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->client, CURLOPT_POST, true);
        curl_setopt($this->client, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($this->client, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->client, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' . $_ENV['API_TOKEN'],
            'Content-Type: application/json'
        ]);

        return curl_exec($this->client);
    }

    /**
     * Determine if error occurs during the request
     * 
     * @return bool
     */
    public function hasError(): bool
    {
        return curl_errno($this->client) > 0;
    }

    /**
     * Destroy the current curl session
     * 
     * @return void
     */
    public function destroy(): void
    {
        curl_close($this->client);
    }
}