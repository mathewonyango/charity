<?php

namespace App\Http\Controllers;

use App\Models\Paystack;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class PaystackController extends Controller
{
    // Redirect to Paystack payment gateway
    public function redirectToGateway(Request $request)
    {
        try {
            // Prepare the payment details
            $paymentData = [
                "email"    => "mathewsagumbah@gmail.com", // Replace with actual email
                "orderID"  => "01010", // Order ID or unique identifier
                "amount"   => 5, // Amount in the lowest currency unit (e.g., kobo, cents)
                "quantity" => 1, // Quantity of the items
                "currency" => "KE", // Currency
                "reference"=> Paystack::genTranxRef(), // Transaction reference
                "metadata" => json_encode(['key_name' => 'value']), // Metadata related to the payment
            ];

            // Store the payment details in the database
            $paystack = Paystack::create($paymentData);

            // Redirect to Paystack payment gateway
            return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            return Redirect::back()->with('message', ['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }

    // Handle the Paystack callback after payment
    public function handleGatewayCallback(Request $request)
    {
        // Fetch the payment data
        $paymentDetails = Paystack::getPaymentData();

        // Assuming the data from Paystack contains the transaction reference
        $reference = $paymentDetails['data']['reference'];

        // Find the payment record by reference
        $paystack = Paystack::where('reference', $reference)->first();

        // Update the payment status based on the response
        if ($paystack) {
            // Check the payment status (this will depend on the actual response from Paystack)
            $status = $paymentDetails['data']['status']; // Example: "success", "failed", etc.
            $paystack->status = $status;
            $paystack->save();
        }

        // Optionally, you can use dd() to debug and check the payment details
        dd($paymentDetails);

        // Return a response, redirect or return view based on your needs
        return redirect()->route('paystack.success')->with('status', 'Payment processed successfully');
    }


    // personal consuption
    // Payment for an event
    public function eventPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'event_id' => 'required|exists:events,id',
            'amount' => 'required|numeric|min:1',
            'quantity' => 'required|integer|min:1',
            'currency' => 'required|string',
            'reference' => 'required|string|unique:paystack,reference',
            'metadata' => 'nullable|json',
            'user_id'=>'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $payment = Paystack::create([
            'email' => $request->email,
            'order_id' => $request->order_id ?? null,
            'amount' => $request->amount,
            'quantity' => $request->quantity,
            'currency' => $request->currency,
            'reference' => $request->reference,
            'metadata' => $request->metadata ?? '{}',
            'status' => 'pending',
            'event_id' => $request->event_id,
            'user_id'=>$request->user_id,

        ]);

        return response()->json(['message' => 'Event payment initiated successfully', 'data' => $payment], 201);
    }

    // Contribution payment
    public function makeContribution(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'contribution_id' => 'required|exists:contributions,id',
            'amount' => 'required|numeric|min:1',
            'quantity' => 'required|integer|min:1',
            'currency' => 'required|string',
            'reference' => 'required|string|unique:paystack,reference',
            'metadata' => 'nullable|json',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $payment = Paystack::create([
            'email' => $request->email,
            'order_id' => $request->order_id ?? null,
            'amount' => $request->amount,
            'quantity' => $request->quantity,
            'currency' => $request->currency,
            'reference' => $request->reference,
            'metadata' => $request->metadata ?? '{}',
            'status' => 'pending',
            'user_id'=>$request->user_id,
            'contribution_id' => $request->contribution_id,
        ]);

        return response()->json(['message' => 'Contribution payment initiated successfully', 'data' => $payment], 201);
    }

}



