<?php

namespace App\DataTransferObjects;

use App\Http\Requests\GroupUserRequest;

final class UserData extends AbstractBaseData
{
    public function __construct(
        public readonly int $userId,
    ) {
    }

    public static function fromGroupUserRequest(GroupUserRequest $request): self
    {
        return new UserData(
            userId: $request->getUserId()
        );
    }
}
