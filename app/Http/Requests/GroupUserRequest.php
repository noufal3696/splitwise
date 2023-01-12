<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getGroupId(): int
    {
        return $this->id;
    }
}
