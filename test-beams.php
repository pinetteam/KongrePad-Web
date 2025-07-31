<?php

// Pusher Beams credentials
$instanceId = 'YOUR_INSTANCE_ID'; // .env'den alınmalı
$secretKey = 'YOUR_SECRET_KEY'; // .env'den alınmalı

// Notification data
$interests = ['meeting-2-announcement'];
$title = 'Test Bildirim - ' . date('H:i:s');
$body = 'Bu bir test bildirimidir';

// Payload (Flutter format)
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
    ],
    'fcm' => [
        'notification' => [
            'title' => $title,
            'body' => $body,
        ],
        'data' => [
            'type' => 'announcement'
        ],
    ],
];

// API URL
$url = "https://{$instanceId}.pushnotifications.pusher.com/publish_api/v1/instances/{$instanceId}/publishes/interests";

// cURL request
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $secretKey,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // SSL doğrulamasını kapat

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "=== PUSHER BEAMS TEST ===\n";
echo "URL: $url\n";
echo "Interests: " . implode(', ', $interests) . "\n";
echo "Title: $title\n";
echo "Body: $body\n";
echo "\n";

if ($error) {
    echo "CURL Error: $error\n";
} else {
    echo "HTTP Code: $httpCode\n";
    echo "Response: $response\n";
    
    if ($httpCode == 200) {
        echo "\n✅ Notification sent successfully!\n";
        echo "\n📱 To receive this notification, Flutter app must:\n";
        echo "1. Be subscribed to interest: " . $interests[0] . "\n";
        echo "2. Have push notifications enabled\n";
        echo "3. Have a valid FCM/APNs token\n";
    } else {
        echo "\n❌ Failed to send notification!\n";
    }
} 