<?php

namespace App\Http\Requests;

use App\Models\User;

class GroupAddUserRequest extends GroupUserRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'in:' . User::allOtherUsers()->pluck('id')],
        ];
    }
}
