<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class WhatsAppController extends Controller
{
    public function sendWhatsAppMessage($to, $message)
    {
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from = config('services.twilio.whatsapp_from');

        try {
            $twilio = new Client($sid, $token);
            $message = $twilio->messages->create(
                "whatsapp:{$to}",
                [
                    'from' => $from,
                    'body' => $message,
                ]
            );
            return true;
        } catch (\Exception $e) {
            Log::info("Intentando enviar WhatsApp a {$to}: " . $message);
            return false;
        }
    }
}