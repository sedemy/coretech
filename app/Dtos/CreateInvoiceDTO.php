<?php

namespace App\Dtos;

use App\Http\Requests\CreateInvoiceRequest;
use App\Models\Contract;

class CreateInvoiceDTO
{
    public function __construct(
        public readonly int $contract_id,
        public readonly string $due_date,
        public readonly int $tenant_id,
        public readonly string $tax_type,
    ) {}

    public static function fromRequest(CreateInvoiceRequest $request, Contract $contract): self
    {
        return new self(
            contract_id: $contract->id,
            due_date: $request->validated('due_date'),
            tenant_id: $request->user()->tenant_id,
            tax_type:  $request->validated('tax_type'),
        );
    }
}
