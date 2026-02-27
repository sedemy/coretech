<?php

namespace App\Repositories;

use App\Dtos\RecordPaymentDTO;
use App\Interfaces\PaymentRepositoryInterface;
use App\Models\Payment;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function recordPayment(RecordPaymentDTO $dto): Payment
    {
        return Payment::create([
            'invoice_id' => $dto->invoice_id,
            'amount' => $dto->amount,
            'payment_method' => $dto->payment_method,
            'reference_number' => 'PAY-' . time() . '-' . rand(),
            'paid_at' => now(),
        ]);
    }
}
