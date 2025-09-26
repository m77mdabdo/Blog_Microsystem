<?php

namespace App\Http\Controllers\Payment;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function create(Post $post)
    {
        return view('payment.create', compact('post'));
    }

   public function createStripePaymentIntent(Request $request, Post $post)
{
    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

    $paymentIntent = $stripe->paymentIntents->create([
        'amount' => 500, // $5
        'currency' => 'usd',
        'payment_method_types' => ['card'],
        'metadata' => [
            'post_id' => $post->id,
        ],
    ]);

    return ['clientSecret' => $paymentIntent->client_secret];
}


   public function confirm(Request $request)
{
    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
    $paymentIntent = $stripe->paymentIntents->retrieve($request->query('payment_intent'));

    if ($paymentIntent->status === 'succeeded') {
        $postId = $paymentIntent->metadata->post_id ?? null;

        if ($postId) {
            $post = \App\Models\Post::find($postId);
            if ($post) {
                $post->is_paid = true;
                $post->status = 'published';
                $post->save();
                $post->refresh();
            }
        }

        return redirect()->route('posts.index')->with('success', 'Payment successful! Your post is now active.');
    }

    return redirect()->route('payment.create')->with('error', 'Payment failed! Try again.');
}


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

        if ($event->type === 'payment_intent.succeeded') {
            $paymentIntent = $event->data->object ?? null;

            if ($paymentIntent && isset($paymentIntent->metadata->post_id)) {
                $post = Post::find($paymentIntent->metadata->post_id);

                if ($post) {
                    $post->is_paid = true;
                    $post->save();
                }
            }
        }

        return response()->json(['status' => 'success']);
    }
}
