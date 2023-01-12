<?php

namespace App\Http\Requests;

use App\Models\Group;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'required', 'max:255', Rule::unique(Group::class)->ignore($this->getId())],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => __('Please choose another name. This name has been already taken')
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
