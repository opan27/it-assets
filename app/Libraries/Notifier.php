<?php

namespace App\Libraries;

class Notifier
{
    protected $host = 'http://localhost:3000'; // alamat Socket.IO server

    public function sendToUser($userId, $message)
    {
        $ch = curl_init($this->host . "/notify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "userId"  => $userId,
            "message" => $message
        ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }
}
