<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class ContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'unit_name' => $this->unit_name,
            'rent_amount' => $this->rent_amount,
            'start_date' => $this->start_date != null ? $this->start_date->format('Y-m-d') : null,
            'end_date' => $this->end_date != null ? $this->end_date->format('Y-m-d') : null,
            'status' => $this->status,
        ];
    }
}
