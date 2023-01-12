<?php

namespace App\Http\Requests;

use App\Models\Group;
use Illuminate\Foundation\Http\FormRequest;

class GroupGetRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function getName(): string
    {
        $group = Group::findOrfail($this->getId());
        return $group->name;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
