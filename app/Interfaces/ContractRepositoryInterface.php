<?php

namespace App\Interfaces;

use App\Models\Contract;

interface ContractRepositoryInterface
{
    public function findById(int $id): ?Contract;
}
