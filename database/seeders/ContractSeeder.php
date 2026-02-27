<?php

namespace Database\Seeders;

use App\Enums\ContractStatusEnum;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Contract::factory()->create([
            'tenant_id' => '1111111111',
            'start_date' => '2026-04-01',
            'end_date' => '2026-05-01',
            'rent_amount' => 100,
            'status' => ContractStatusEnum::ACTIVE,
        ]);

        \App\Models\Contract::factory()->create([
            'tenant_id' => '2222222222',
            'start_date' => '2026-04-01',
            'end_date' => '2026-05-01',
            'rent_amount' => 100,
            'status' => ContractStatusEnum::EXPIRED,
        ]);

        \App\Models\Contract::factory()->create([
            'tenant_id' => '3333333333',
            'start_date' => '2026-04-01',
            'end_date' => '2026-05-01',
            'rent_amount' => 100,
            'status' => ContractStatusEnum::DRAFT,
        ]);

        \App\Models\Contract::factory()->create([
            'tenant_id' => '4444444444',
            'start_date' => '2026-04-01',
            'end_date' => '2026-05-01',
            'rent_amount' => 100,
            'status' => ContractStatusEnum::TERMINATED,
        ]);
    }
}
