<?php

namespace App\DataTransferObjects;

use App\Http\Requests\GroupExpenseRequest;
use App\Http\Requests\GroupUserRequest;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupDeleteRequest;
use App\Http\Requests\GroupGetRequest;
use App\Http\Requests\GroupUpdateRequest;

final class GroupData extends AbstractBaseData
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?int $id = null
    ) {
    }

    public static function fromCreateRequest(GroupCreateRequest $request): self
    {
        return new GroupData(
            name: $request->getName()
        );
    }

    public static function fromUpdateRequest(GroupUpdateRequest $request): self
    {
        return new GroupData(
            name: $request->getName(),
            id: $request->getId(),
        );
    }

    public static function fromGetRequest(GroupGetRequest $request): self
    {
        return new GroupData(
            name: $request->getName(),
            id: $request->getId(),
        );
    }

    public static function fromDeleteRequest(GroupDeleteRequest $request): self
    {
        return new GroupData(
            name: $request->getName(),
            id: $request->getId(),
        );
    }

    public static function fromGroupUserRequest(GroupUserRequest $request): self
    {
        return new GroupData(
            id: $request->getGroupId(),
        );
    }

    public static function fromGroupExpenseRequest(GroupExpenseRequest $request): self
    {
        return new GroupData(
            id: $request->getGroupId(),
        );
    }
}
