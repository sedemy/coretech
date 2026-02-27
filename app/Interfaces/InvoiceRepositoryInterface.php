<?php

namespace App\Interfaces;

use App\Dtos\CreateInvoiceDTO;
use App\Dtos\InvoicesListDTO;
use App\Models\Contract;
use App\Models\Invoice;

interface InvoiceRepositoryInterface
{
    public function findById(int $id);

    public function create(
        CreateInvoiceDTO $createInvoiceDTO,
        Contract $contract,
        $newSequence,
        $taxAmount
    );

    public function getSameSequenceCount(int $tenantId);

    public function updateStatus(Invoice $invoice, $status);

    public function getInvoicesList(InvoicesListDTO $dto, Contract $contract);
}
