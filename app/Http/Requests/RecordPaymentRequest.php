<?php

namespace App\Http\Requests;

use App\Enums\PaymentMethodEnum;

// use Illuminate\Foundation\Http\FormRequest;

class RecordPaymentRequest extends BaseApiRequest
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
            'amount' => ['required', 'numeric', 'min:0.01'],
            'payment_method' => ['required', 'string', 'in:' . @implode(',',PaymentMethodEnum::toArray())],
        ];
    }
}
