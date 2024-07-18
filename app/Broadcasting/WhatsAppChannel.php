<?php

namespace App\Broadcasting;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Services\WhatsAppService;



class WhatsAppChannel
{
    protected $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }

    public function send($notifiable, $notification)
    {
        if (!method_exists($notification, 'toWhatsApp')) {
            return;
        }

        $message = $notification->toWhatsApp($notifiable);

        $to = $notifiable->routeNotificationFor('whatsapp');

        $this->whatsAppService->sendMessage($to, $message);
    }

    // public function send($notifiable, Notification $notification)
    // {
    //     if (!method_exists($notification, 'toWhatsApp')) {
    //         return;
    //     }

    //     $message = $notification->toWhatsApp($notifiable);

    
    //     $url = config('services.whatsapp.url');
    //     $token = config('services.whatsapp.token');

    //     $client = new Client([
    //         'base_uri' => $url,
    //         'verify' => storage_path('cacert.pem'), // Path to the CA bundle
    //         'headers' => [
    //             'Authorization' => 'Bearer ' . $token,
    //             'Content-Type' => 'application/json',
    //         ]
    //     ]);

    //     $response = $client->post('', [
    //         'json' => [
    //             'messaging_product' => 'whatsapp',
    //             'to' => $notifiable->routeNotificationForWhatsApp(),
    //             'type' => 'template',
    //             'template' => [
    //                 'name' => $message['name'],
    //                 'language' => [
    //                     'code' => $message['language']
    //                 ],
    //                 'components' => [
    //                 [
    //                     'type' => 'body',
    //                     'parameters' => $message['parameters']
    //                 ]
    //             ]
    //             ]
    //         ]
    //     ]);

    //     if ($response->getStatusCode() !== 200) {
    //         // Handle the failure case
    //         throw new \Exception('Failed to send WhatsApp message: ' . $response->getBody());
    //     }

    //     // $response = Http::withHeaders([
    //     //     'Authorization' => 'Bearer ' . $token,
    //     //     'Content-Type' => 'application/json',
    //     // ])->post($url, [
    //     //     'messaging_product' => 'whatsapp',
    //     //     'to' => $notifiable->routeNotificationForWhatsApp(),
    //     //     'type' => 'template',
    //     //     'template' => [
    //     //         'name' => $message['name'],
    //     //         'language' => [
    //     //             'code' => $message['language']
    //     //         ]
    //     //     ]
    //     // ]);

    //     // if (!$response->successful()) {
    //     //     // Handle the failure case
    //     //     throw new \Exception('Failed to send WhatsApp message: ' . $response->body());
    //     // }
    // }
}
