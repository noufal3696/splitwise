<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Expense extends Model
{
    use HasFactory;

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function scopeGroupExpense($query, int $groupId): Builder
    {
        return $query->where('group_id', $groupId);
    }

    public function scopeMyGroupExpense($query, int $groupId, int $userId): Builder
    {
        return $query->where('user_id', $userId)->where('group_id', $groupId);
    }
}
