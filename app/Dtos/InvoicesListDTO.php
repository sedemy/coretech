<?php

namespace App\Dtos;

use App\Http\Requests\InvoicesRequest;
use App\Models\Contract;

class InvoicesListDTO
{
    public function __construct(
        public readonly int $contract_id,
        public readonly ?string $status,
        public readonly ?string $invoice_number,
        public readonly ?string $due_date,
        public readonly ?string $paid_at,
    ) {}

    public static function fromRequest(InvoicesRequest $request, Contract $contract): self
    {
        return new self(
            contract_id: $contract->id,
            status: $request->validated('status'),
            invoice_number: $request->validated('invoice_number'),
            due_date: $request->validated('due_date'),
            paid_at: $request->validated('paid_at'),
        );
    }
}
