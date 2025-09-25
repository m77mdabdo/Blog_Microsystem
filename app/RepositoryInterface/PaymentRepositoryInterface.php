<?php

namespace App\RepositoryInterface;

interface PaymentRepositoryInterface
{
    public function createIntent($amount, $currency);
    public function confirmPayment($paymentIntentId);
}
