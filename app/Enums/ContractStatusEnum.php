<?php

namespace App\Enums;

enum ContractStatusEnum: string
{
    case DRAFT = 'draft';
    case ACTIVE = 'active';
    case EXPIRED = 'expired';
    case TERMINATED = 'terminated';

    public static function toArray(): array
    {
        return array_column(ContractStatusEnum::cases(), 'value');
    }
}
