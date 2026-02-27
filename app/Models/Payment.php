<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'amount',
        'payment_method',
        'reference_number',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
        'payment_method' => PaymentMethodEnum::class,
        'paid_at' => 'datetime',
    ];

    protected $table = 'payments';

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
