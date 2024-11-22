<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;


class TwilioSMSController extends Controller
{
    /**
     * Send SMS via Twilio.
     *
     * @return response()
     */
    public function index()
    {
        $receiverNumber = "+25402622569"; // Change to the number you want to send the SMS to
        $message = "This is testing from ItSolutionStuff.com"; // The message to send

        try {
            // Fetch credentials from environment file
            $account_sid = env("TWILIO_SID");
            $auth_token = env("TWILIO_TOKEN");
            $twilio_number = env("TWILIO_FROM");

            // Create Twilio Client
            $client = new Client($account_sid, $auth_token);

            // Send the SMS
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message
            ]);

            // Log success and return a response
            Log::info('SMS Sent Successfully to ' . $receiverNumber);
            return response()->json(['message' => 'SMS Sent Successfully.']);
        } catch (Exception $e) {
            // Log error and return a response
            Log::error("Error: " . $e->getMessage());
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
