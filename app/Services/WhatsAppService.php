<?php

namespace App\Services;

//use UltraMsg\WhatsAppApi;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $instanceId;
    protected $token;
    protected $client;

    public function __construct()
    {
        $this->instanceId = config('services.ultramsg.instance_id');
        $this->token = config('services.ultramsg.token');
        //$this->client = new WhatsAppApi($this->instanceId, $this->token);
        $this->client =  new Client([
            'verify' => storage_path('cacert.pem'), // Chemin vers le fichier cacert.pem
        ]);
    }

    public function sendMessage($to, $message)
    {
        // Log::info('Sending message to WhatsApp', ['to' => $to, 'message' => $message]);

        // $response = $this->client->sendChatMessage($to, $message);

        // Log::info('WhatsApp API response', ['response' => $response]);

        // return $response;

        Log::info('Sending message to WhatsApp', ['to' => $to, 'message' => $message]);

        $url = "https://api.ultramsg.com/{$this->instanceId}/messages/chat";
        $response = $this->client->post($url, [
            'query' => ['token' => $this->token],
            'json' => [
                'to' => $to,
                'body' => $message
            ]
        ]);

        $responseBody = json_decode($response->getBody(), true);

        Log::info('WhatsApp API response', ['response' => $responseBody]);

        return $responseBody;
    }
}
