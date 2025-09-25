<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\User;

class PaymentController extends Controller
{
   
    public function createCheckoutLink(Request $request)
    {
        $user = User::where('access_token', $request->header('access_token'))->first();

        if (!$user) {
            return response()->json(['msg' => 'Invalid access token'], 401);
        }

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

       $session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'usd',
            'product_data' => [
                'name' => 'Post Payment'
            ],
            'unit_amount' => 1000, // بالسنت
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'http://localhost:8000/payment-success?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => 'http://localhost:8000/payment-cancel',
]);


        return response()->json([
            'checkout_url' => $session->url
        ]);
    }

    // Webhook Stripe لتأكيد الدفع
    public function handleWebhook(Request $request)
{
    $payload = $request->getContent();

    if (!$payload) {
        return response()->json(['error' => 'Empty payload'], 400);
    }

    $event = json_decode($payload);

    if (!$event || !isset($event->type)) {
        return response()->json(['error' => 'Invalid event data'], 400);
    }

    if ($event->type === 'checkout.session.completed') {
        $session = $event->data->object ?? null;

        if ($session) {
            $user_id = $session->client_reference_id ?? null;

            if ($user_id) {
                $user = User::find($user_id);
                if ($user) {
                    $user->is_paid = true;
                    $user->save();
                }
            }
        }
    }

    return response()->json(['status' => 'success']);
}

}
