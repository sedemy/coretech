<?php

namespace App\Http\Resources;

use App\Http\Resources\ContractResource;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'contract_id' => $this->contract_id,
            'invoice_number' => $this->invoice_number,
            'subtotal' => $this->subtotal,
            'tax_amount' => $this->tax_amount,
            'status' => $this->status,
            'due_date' => $this->due_date,
            'paid_at' => $this->paid_at != null ? $this->paid_at->format('Y-m-d H:i:s') : null,
            'total' => $this->total,
            'remaining_balance' => $this->contract?->tenant?->balance,
            'contract' => ContractResource::make($this->contract),
            'payments' => PaymentResource::collection($this->payments),
        ];
    }
}
