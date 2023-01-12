<?php

namespace App\DataTransferObjects;

use App\Http\Requests\GroupExpenseRequest;

final class ExpenseData extends AbstractBaseData
{
    public function __construct(
        public readonly ?int $amount = null,
        public readonly ?int $id = null
    ) {
    }

    public static function fromGroupExpenseRequest(GroupExpenseRequest $request): self
    {
        return new ExpenseData(
            amount: $request->getAmount(),
            id: $request->getExpenseId()
        );
    }
}
