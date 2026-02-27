<?php

namespace App\Services;

use App\Dtos\CreateInvoiceDTO;
use App\Dtos\InvoicesListDTO;
use App\Enums\ContractStatusEnum;
use App\Enums\InvoiceStatusEnum;
use App\Interfaces\ContractRepositoryInterface;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Interfaces\PaymentRepositoryInterface;
use App\Models\Contract;
use App\Models\Invoice;
use App\Services\TaxTypes\TaxTypeService;

class InvoiceService
{
    public function __construct(
        private ?InvoiceRepositoryInterface $invoiceRepository = null,
        private ?ContractRepositoryInterface $contractRepository = null,
        private ?PaymentRepositoryInterface $paymentRepository = null,
    ) {}

    public function createInvoice(CreateInvoiceDTO $invoiceDTO): Invoice
    {
        $contract = $this->contractRepository->findById($invoiceDTO->contract_id);

        if (empty($contract)) {
            throwError('Contract not found');
        }

        if ($contract->status != ContractStatusEnum::ACTIVE) {
            throwError('Contract is not active');
        }

        $sameSquenceCount = $this->invoiceRepository->getSameSequenceCount($invoiceDTO->tenant_id);

        $newSequence = 'INV-' . $invoiceDTO->tenant_id . '-' . date('Ym') . '-'
            . str_pad(($sameSquenceCount + 1), 4, '0', STR_PAD_LEFT);

        // $taxType = match ($invoiceDTO->tax_type) {
        //     'vat' => new VatTax(),
        //     'municipal_fee' => new MunicipalFeeTax(),
        //     'tourism' => new TourismTax(),
        //     default => throwError('Invalid tax type'),
        // };

        $taxTypeClass = 'App\\Services\\TaxTypes\\' . $invoiceDTO->tax_type;
        $taxType = new $taxTypeClass;
        $taxAmount = (new TaxTypeService($taxType))->calcTax($contract->rent_amount);

        return $this->invoiceRepository->create($invoiceDTO, $contract, $newSequence, $taxAmount);
    }

    public function recordPayment($dto)
    {
        \DB::beginTransaction();

        try {
            $invoice = $this->invoiceRepository->findById($dto->invoice_id);

            if (empty($invoice)) {
                throwError('Invoice not found');
            }

            if ($invoice->status == InvoiceStatusEnum::PAID) {
                throwError('Thie invoice has paid before');
            }

            if ($invoice->status == InvoiceStatusEnum::CANCELLED) {
                throwError('Thie invoice has cancelled before');
            }

            if ($invoice->status == InvoiceStatusEnum::OVERDUE) {
                throwError('Thie invoice Overdue');
            }

            if (auth()->user()->balance < $dto->amount) {
                throwError('Balance is not enough');
            }

            $sumPayments = $invoice->payments()->sum('amount');

            if (($sumPayments + $dto->amount) > $invoice->total) {
                throwError('Amout is more than invoice total you need to pay only ' . ($invoice->total - $sumPayments));
            }

            $payment = $this->paymentRepository->recordPayment($dto);

            // $sumPayments = $invoice->payments()->sum('amount');
            $sumPayments += $dto->amount;

            if ($sumPayments >= $invoice->total) {
                $this->invoiceRepository->updateStatus($invoice, InvoiceStatusEnum::PAID);
            }

            if ($sumPayments < $invoice->total) {
                $this->invoiceRepository->updateStatus($invoice, InvoiceStatusEnum::PARTIALLY_PAID);
            }


            auth()->user()->balance -= $dto->amount;
            auth()->user()->save();

            \DB::commit();

            return $payment;
        } catch (\Exception $e) {
            \DB::rollBack();
            throwError($e->getMessage());
        }
    }

    public function getInvoicesList(InvoicesListDTO $dto, $contract)
    {
        $contract = $this->contractRepository->findById($contract->id);

        if (empty($contract)) {
            throwError('Contract not found');
        }

        return $this->invoiceRepository->getInvoicesList($dto, $contract);
    }

    public function getContractSummary(Contract $contract)
    {
        $contract = $this->contractRepository->findById($contract->id);

        if (empty($contract)) {
            throwError('Contract not found');
        }
        
    }
}
