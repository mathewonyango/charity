<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http; // Use the Http facade

class InfobipSMSController extends Controller
{ /**
    * Send an SMS using Infobip API
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
   public function sendSMS(Request $request)
   {
     // Validate the incoming request
     $validated = $request->validate([
        'phone_number' => 'required|string', // Ensure phone number is provided and is a string
        'message' => 'required|string', // Ensure message is provided
    ]);

    // Extract phone number and message from the validated request
    $receiverNumber = $validated['phone_number'];
    $message = $validated['message'];

    try {
        // Create a new Guzzle client
        $client = new Client();

        // Prepare the request to the Infobip API
        $response = $client->post('https://api.infobip.com/sms/2/text/advanced', [
            'headers' => [
                'Authorization' => 'App ' . env('INFOBIP_API_KEY'), // Use environment variable for API key
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'json' => [
                'messages' => [
                    [
                        'destinations' => [
                            ['to' => $receiverNumber]
                        ],
                        'from' => env('INFOBIP_SENDER_NUMBER'), // Use an environment variable for the sender number
                        'text' => $message
                    ]
                ]
            ]
        ]);

        // Check the response status
        if ($response->getStatusCode() == 200) {
            return response()->json([
                'status' => 'success',
                'message' => 'SMS Sent Successfully.',
                'response' => json_decode($response->getBody()->getContents())
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send SMS.',
                'error' => $response->getStatusCode() . ' ' . $response->getReasonPhrase()
            ], 400);
        }
    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }

}
}
