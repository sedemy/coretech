<?php

namespace App\Http\Requests;

use App\Enums\InvoiceStatusEnum;

// use Illuminate\Foundation\Http\FormRequest;

class InvoicesRequest extends BaseApiRequest
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
            'invoice_number' => ['nullable'],
            'status' => ['nullable', 'string', 'in:'. implode(',', InvoiceStatusEnum::toArray())],
            'due_date' => ['nullable','date'],
            'paid_at' => ['nullable','date'],

        ];
    }
}
