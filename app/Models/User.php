<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeAllOtherUsers($query): Builder
    {
        return $query->where('users.id', '!=', Auth::id());
    }

    public function getExpenseDetails(int $groupId)
    {
        $myTotalExpense = Expense::myGroupExpense($groupId, $this->id)->sum('amount');
        $totalGroupExpense = Expense::groupExpense($groupId)->sum('amount');
        $totalGroupMembers = GroupUsers::myGroupMembers($groupId)->count();
        $perHeadExpense = $totalGroupExpense/$totalGroupMembers;

        $theyOweYou = $myTotalExpense - $perHeadExpense;
        $youOweThem = $perHeadExpense - $myTotalExpense;
        return [
            'theyOweYou' => $theyOweYou,
            'youOweThem' => $youOweThem
        ];
    }
}
