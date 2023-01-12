<?php

namespace App\Http\Requests;

class GroupAddExpenseRequest extends GroupExpenseRequest
{
    public function rules(): array
    {
        return [
            'amount' => ['required', 'integer']
        ];
    }
}
