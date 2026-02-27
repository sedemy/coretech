<?php

namespace App\Models;

use App\Enums\ContractStatusEnum;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'unit_name',
        'customer_name',
        'start_date',
        'end_date',
        'rent_amount',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => ContractStatusEnum::class,
        'rent_amount' => 'decimal:2',
    ];

    protected $table = 'contracts';

    public function tenant(){
        return $this->belongsTo(User::class, 'tenant_id', 'tenant_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
