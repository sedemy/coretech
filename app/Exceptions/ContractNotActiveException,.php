<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContractNotActiveException extends Exception
{
    public function render(Request $request): JsonResponse
    {

        return failedResponse($this->getMessage(), $this->getCode() ?: 400);

    }
}
