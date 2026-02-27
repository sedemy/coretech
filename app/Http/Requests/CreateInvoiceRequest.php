<?php

namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'due_date' => ['required', 'date', 'after:today'],
            'tax_type' => ['required', 'string', 'in:VatTax,MunicipalFeeTax,TourismTax'],
        ];
    }
}
