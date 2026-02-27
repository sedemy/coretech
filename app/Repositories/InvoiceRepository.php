<?php

namespace App\Repositories;

use App\Dtos\CreateInvoiceDTO;
use App\Dtos\InvoicesListDTO;
use App\Enums\InvoiceStatusEnum;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Models\Contract;
use App\Models\Invoice;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function findById(int $id)
    {
        return Invoice::find($id);
    }

    public function create(CreateInvoiceDTO $invoiceDTO, Contract $contract, $newSequence, $taxAmount)
    {
        return Invoice::create([
            'contract_id' => $invoiceDTO->contract_id,
            'invoice_number' => $newSequence,
            'status' => InvoiceStatusEnum::PENDING,
            'due_date' => $invoiceDTO->due_date,
            'subtotal' => $contract->rent_amount,
            'tax_amount' => $taxAmount,
            'total' => $contract->rent_amount + $taxAmount,
        ]);
    }

    public function getSameSequenceCount($tenantId)
    {
        return Invoice::where(
            'invoice_number',
            'like',
            'INV-' . $tenantId . '-' . date('Ym') . '-%'
        )->count();
    }

    public function updateStatus(Invoice $invoice, $status)
    {
        $invoice->status = $status;

        $invoice->paid_at = now();

        $invoice->save();
    }

    public function getInvoicesList(InvoicesListDTO $dto, Contract $contract)
    {
        $query = Invoice::query()->where('contract_id', $contract->id);

        if (!empty($dto->invoice_number)) {
            $query->where('invoice_number', 'like', '%' . $dto->invoice_number . '%');
        }

        if (!empty($dto->status)) {
            $query->where('status', $dto->status);
        }

        if (!empty($dto->due_date)) {
            $query->whereDate('due_date', $dto->due_date);
        }

        if (!empty($dto->paid_at)) {
            $query->whereDate('paid_at', $request->paid_at);
        }

        return $query->get();
    }
}
