<?php

namespace App\Services;

use App\DataTransferObjects\ExpenseData;
use App\DataTransferObjects\GroupData;
use App\DataTransferObjects\UserData;
use App\Models\Expense;
use App\Models\Group;
use App\Models\GroupUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GroupService
{
    public function store(GroupData $groupDTO): void
    {
        $group = new Group();
        $group->name = $groupDTO->name;
        $group->identifier = Str::slug($groupDTO->name);
        $group->user_id = Auth::id();
        $group->save();
    }

    public function update(GroupData $groupDTO): void
    {
        $group = Group::find($groupDTO->id);
        $group->name = $groupDTO->name;
        $group->identifier = Str::slug($groupDTO->name);
        $group->save();
    }

    public function destroy(GroupData $groupDTO): void
    {
        $group = Group::find($groupDTO->id);
        $group->delete();
    }

    public function addUser(UserData $userDTO, GroupData $groupDTO): void
    {
        if (GroupUsers::where('user_id', $userDTO->userId)->where('group_id', $groupDTO->id)->exists()) {
            return;
        }

        $groupUser = new GroupUsers();
        $groupUser->user_id = $userDTO->userId;
        $groupUser->group_id = $groupDTO->id;
        $groupUser->save();
    }

    public function destroyUser(UserData $userDTO, GroupData $groupDTO): void
    {
        GroupUsers::where('group_id', $groupDTO->id)->where('user_id', $userDTO->userId)->delete();
    }

    public function addExpense(ExpenseData $expenseDTO, GroupData $groupDTO): void
    {
        $groupExpense = new Expense();
        $groupExpense->amount = $expenseDTO->amount;
        $groupExpense->group_id = $groupDTO->id;
        $groupExpense->user_id = Auth::id();
        $groupExpense->save();
    }

    public function destroyExpense(ExpenseData $expenseDTO, GroupData $groupDTO): void
    {
        Expense::where('group_id', $groupDTO->id)->where('id', $expenseDTO->id)->delete();
    }
}
