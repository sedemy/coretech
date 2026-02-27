<?php

namespace App\Http\Resources;

use App\Enums\InvoiceStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class ContractSummaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        $total_invoiced = $this->invoices()->sum('total');
        $total_paid = $this
            ->invoices()
            ->whereIn('status', [InvoiceStatusEnum::PAID, InvoiceStatusEnum::PARTIALLY_PAID])
            ->sum('total');

        return [
            'contract_id' => $this->id,
            'total_invoiced' => $total_invoiced,
            'total_paid,' => $total_paid,
            'outstanding_balance,' => $total_invoiced - $total_paid,
            'invoices_count' => $this->invoices()->count(),
            'latest_invoice_date' => $this->invoices()->orderBy('id', 'desc')->first()?->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
