<?php

namespace App\Service\Announcement;

use Pusher\PushNotifications\PushNotifications;
use Illuminate\Support\Facades\Http;

class Beams
{
    protected PushNotifications $beamsClient;
    protected string $instanceId;
    protected string $secretKey;

    /**
     * Beams constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->instanceId = config('services.pusher.beams_instance_id');
        $this->secretKey = config('services.pusher.beams_secret_key');
        
        $this->beamsClient = new PushNotifications([
            'instanceId' => $this->instanceId,
            'secretKey'  => $this->secretKey,
        ]);
    }

    /**
     * Bildirim gönderme işlemi.
     *
     * @param array $interests İlgi alanları (ör. kullanıcı grupları)
     * @param string $title Bildirim başlığı
     * @param string $body Bildirim içeriği
     * @param array $data Ek veri (isteğe bağlı)
     * @return array Başarı veya hata mesajı
     */
    public function sendNotification(array $interests, string $title, string $body, array $data = []): array
    {
        try {
            // Direkt HTTP request kullan (SSL problemi için)
            $url = "https://{$this->instanceId}.pushnotifications.pusher.com/publish_api/v1/instances/{$this->instanceId}/publishes/interests";
            
            // Flutter'ın beklediği format
            $payload = [
                'interests' => $interests,
                'web' => [
                    'notification' => [
                        'title' => $title,
                        'body' => $body,
                        'icon' => 'https://app.kongrepad.com/icon.png'
                    ]
                ],
                'apns' => [
                    'aps' => [
                        'alert' => [
                            'title' => $title,
                            'body' => $body,
                        ],
                    ],
                    'data' => array_merge(['type' => 'announcement'], $data),
                ],
                'fcm' => [
                    'notification' => [
                        'title' => $title,
                        'body' => $body,
                    ],
                    'data' => array_merge(['type' => 'announcement'], $data),
                ],
            ];
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Content-Type' => 'application/json',
            ])
            ->withOptions([
                'verify' => false, // SSL doğrulamasını kapat
            ])
            ->post($url, $payload);
            
            if ($response->successful()) {
                return [
                    'success' => true,
                    'response' => $response->json(),
                ];
            } else {
                return [
                    'success' => false,
                    'error' => $response->body(),
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error'   => $e->getMessage(),
            ];
        }
    }
    
    /**
     * Keypad bildirimi gönder
     */
    public function sendKeypadNotification(array $interests, string $title, string $body, string $hallId): array
    {
        return $this->sendNotification($interests, $title, $body, [
            'type' => 'keypad',
            'hall_id' => $hallId
        ]);
    }
    
    /**
     * Debate bildirimi gönder
     */
    public function sendDebateNotification(array $interests, string $title, string $body, string $hallId): array
    {
        return $this->sendNotification($interests, $title, $body, [
            'type' => 'debate',
            'hall_id' => $hallId
        ]);
    }
}
