<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupExpenseRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function getGroupId(): int
    {
        return $this->id;
    }

    public function getExpenseId(): ?int
    {
        return $this->expense_id;
    }
}
