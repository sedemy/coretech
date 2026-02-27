<?php

namespace App\Http\Controllers;

use App\Dtos\CreateInvoiceDTO;
use App\Dtos\InvoicesListDTO;
use App\Dtos\RecordPaymentDTO;
use App\Http\Requests\CreateInvoiceRequest;
use App\Http\Requests\InvoicesRequest;
use App\Http\Requests\RecordPaymentRequest;
use App\Http\Resources\ContractSummaryResource;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\PaymentResource;
use App\Models\Contract;
use App\Models\Invoice;
use App\Services\InvoiceService;

class InvoiceController extends Controller
{
    public InvoiceService $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function create(CreateInvoiceRequest $request, Contract $contract)
    {
        
        try {
            $this->authorize('create', $contract);

            $dto = CreateInvoiceDTO::fromRequest($request, $contract);

            $invoice = $this->invoiceService->createInvoice($dto);

            // return $invoice;

            return successResponse(InvoiceResource::make($invoice), 'Successfully created', 201)
            // return InvoiceResource::make($invoice)
            //     ->response()
            //     ->setStatusCode(201)
            ;
        } catch (\Exception $e) {
            return failedResponse($e->getMessage());
            // return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }


    public function recordPayment(RecordPaymentRequest $request, Invoice $invoice)
    {
        $this->authorize('recordPayment', $invoice);

        

        $dto = RecordPaymentDTO::fromRequest($request, $invoice);
        
        try {
            $payment = $this->invoiceService->recordPayment($dto);

            return successResponse(PaymentResource::make($payment), 'Successfully recorded');
        } catch (\Exception $e) {
            return failedResponse($e->getMessage());
        }


    }


    public function invoicesList(InvoicesRequest $request, Contract $contract)
    {
        
        $this->authorize('invoicesList', $contract);

        $dto = InvoicesListDTO::fromRequest($request, $contract);
        
        $invoices = $this->invoiceService->getInvoicesList($dto, $contract);
                
        return successResponse(InvoiceResource::collection($invoices));
    }


    public function invoiceDetails(Invoice $invoice)
    {
        $this->authorize('invoiceDetails', $invoice);
        return successResponse(InvoiceResource::make($invoice));
    }


    public function contractSummary(Contract $contract)
    {
        $this->authorize('contractSummary', $contract);


        // return $invoices = $contract->invoices()->get();

        // $totalInvoiced = $invoices->sum('total');

        // $totalPaid = $invoices->sum(function ($invoice) {
        //     return $invoice->payments()->sum('amount');
        // });

        // $outstandingBalance = $totalInvoiced - $totalPaid;

        // return [
        //     'total_invoiced' => $totalInvoiced,
        //     'total_paid' => $totalPaid,
        //     'outstanding_balance' => $outstandingBalance,
        // ];



        return successResponse(ContractSummaryResource::make($contract));
    }
    
}
