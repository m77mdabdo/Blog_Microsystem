<?php

namespace App\Repositories;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\RepositoryInterface\PaymentRepositoryInterface;

class StripePaymentRepository implements PaymentRepositoryInterface
{
    protected $amount;
    protected $currency;

    public function __construct()
    {
        Stripe::setApiKey(config('stripe.secret'));
        $this->amount = env('POST_PAYMENT_AMOUNT', 10); // السعر بالدولار
        $this->currency = env('POST_PAYMENT_CURRENCY', 'usd');
    }

    public function createIntent($amount, $currency)
    {
        return PaymentIntent::create([
            'amount' => $this->amount * 100, // Stripe بيشتغل بالـ cents
            'currency' => $this->currency,
            'payment_method_types' => ['card'],
        ]);
    }

    public function confirmPayment($paymentIntentId)
    {
        $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
        return $paymentIntent->status === 'succeeded';
    }
}
