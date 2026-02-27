<?php

namespace App\Policies;

use App\Models\Contract;
use App\Models\Invoice;
use App\Models\User;

class InvoicePolicy
{
    public function __construct()
    {
        //
    }

    public function create(User $user, Contract $contract): bool
    {
        return $user->tenant_id === $contract->tenant_id;
    }

    public function recordPayment(User $user, Invoice $invoice): bool
    {
        return $user->tenant_id === $invoice->contract->tenant_id;
    }

    public function invoicesList(User $user, Contract $contract): bool
    {
        return $user->tenant_id === $contract->tenant_id;
    }

    public function invoiceDetails(User $user, Invoice $invoice): bool
    {
        return $user->tenant_id === $invoice->contract->tenant_id;
    }

    public function contractSummary(User $user, Contract $contract): bool
    {
        return $user->tenant_id === $contract->tenant_id;
    }
}
