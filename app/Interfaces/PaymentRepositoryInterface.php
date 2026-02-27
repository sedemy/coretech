<?php

namespace App\Interfaces;

use App\Dtos\RecordPaymentDTO;
use App\Models\Payment;

interface PaymentRepositoryInterface
{
    public function recordPayment(RecordPaymentDTO $dto): Payment;
}
