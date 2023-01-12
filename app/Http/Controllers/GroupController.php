<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\ExpenseData;
use App\DataTransferObjects\GroupData;
use App\DataTransferObjects\UserData;
use App\Http\Requests\GroupAddExpenseRequest;
use App\Http\Requests\GroupAddUserRequest;
use App\Http\Requests\GroupExpenseRequest;
use App\Http\Requests\GroupUserRequest;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupDeleteRequest;
use App\Http\Requests\GroupGetRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Models\Expense;
use App\Models\Expenses;
use App\Models\Group;
use App\Models\GroupUsers;
use App\Models\User;
use App\Services\GroupService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GroupController
{
    public function __construct(
        public readonly GroupService $groupService
    ) {
    }

    public function index(): View
    {
        return view('groups.index', ['groups' => Group::myGroups()->paginate()]);
    }

    public function create(): View
    {
        return view('groups.form');
    }

    public function store(GroupCreateRequest $request): RedirectResponse
    {
        $this->groupService->store(GroupData::fromCreateRequest($request));
        return to_route('group')->with('success');
    }

    public function edit(GroupGetRequest $request): View
    {
        return view('groups.form', ['groupDTO' => GroupData::fromGetRequest($request)]);
    }

    public function show(GroupGetRequest $request): View
    {
        $groupDTO = GroupData::fromGetRequest($request);
        $myExpenditure = User::find(Auth::id())->getExpenseDetails($groupDTO->id);

        return view('groups.show', [
            'groupDTO' => GroupData::fromGetRequest($request),
            'users' => User::allOtherUsers()->get(),
            'groupUsers' => GroupUsers::where('group_id', $groupDTO->id)->get(),
            'groupExpenses' => Expense::myGroupExpense($groupDTO->id, Auth::id())->get(),
            'theyOweYou' => $myExpenditure['theyOweYou'],
            'youOweThem' => $myExpenditure['youOweThem']
        ]);
    }

    public function update(GroupUpdateRequest $request): RedirectResponse
    {
        $this->groupService->update(GroupData::fromUpdateRequest($request));
        return to_route('group')->with('success');
    }

    public function destroy(GroupDeleteRequest $request): RedirectResponse
    {
        $this->groupService->destroy(GroupData::fromDeleteRequest($request));
        return to_route('group')->with('success');
    }

    public function addUser(GroupAddUserRequest $request): RedirectResponse
    {
        $groupDTO = GroupData::fromGroupUserRequest($request);
        $this->groupService->addUser(UserData::fromGroupUserRequest($request), $groupDTO);
        return to_route('group.show', $groupDTO->id)->with('success');
    }

    public function destroyUser(GroupUserRequest $request): RedirectResponse
    {
        $groupDTO = GroupData::fromGroupUserRequest($request);
        $this->groupService->destroyUser(UserData::fromGroupUserRequest($request), $groupDTO);
        return to_route('group.show', $groupDTO->id)->with('success');
    }

    public function addExpense(GroupAddExpenseRequest $request): RedirectResponse
    {
        $groupDTO = GroupData::fromGroupExpenseRequest($request);
        $this->groupService->addExpense(ExpenseData::fromGroupExpenseRequest($request), $groupDTO);
        return to_route('group.show', $groupDTO->id)->with('success');
    }

    public function destroyExpense(GroupExpenseRequest $request): RedirectResponse
    {
        $groupDTO = GroupData::fromGroupExpenseRequest($request);
        $this->groupService->destroyExpense(ExpenseData::fromGroupExpenseRequest($request), $groupDTO);
        return to_route('group.show', $groupDTO->id)->with('success');
    }
}
