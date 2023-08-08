<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'dob',
        'phone',
        'cnic',
        'email_verified_at',
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
        'password' => 'hashed',
    ];

    public function tasks() : BelongsToMany {
        return $this->belongsToMany(Task::class)->withTimestamps()->withPivot('assigned_day_id');
    }

    public function createdTasks() {
        return $this->hasMany(Task::class);
    }

    public function scopeWeeklyTasksAssigned($query, $user) {
        return $user->tasks()->wherePivotBetween('created_at', [Carbon::now()->startOfDay()->startOfWeek(), Carbon::now()->endOfWeek()]);
    }

    public function scopeWeeklyTasksCompleted($query, $user) {
        return $user->tasks->whereBetween('completed_at', [Carbon::now()->startOfDay()->startOfWeek(), Carbon::now()->endOfWeek()]);
    }

    public function scopeMonthlyTasksAssigned($query,$user, $month) {
        if($month == null)
            return $user->tasks()->wherePivotBetween('created_at', [Carbon::now()->startOfMonth() , Carbon::now()->endOfMonth()]);

        return $user->tasks()->wherePivotBetween('created_at', [Carbon::now()->day(1)->month($month)->startOfMonth(), Carbon::now()->day(1)->month($month)->endOfMonth()]);
    }

    public function scopeMonthlyTasksCompleted($query,$user, $month) {
        if($month == null)
            return $user->tasks->whereBetween('completed_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);

        return $user->tasks->whereBetween('completed_at', [Carbon::now()->day(1)->month($month)->startOfMonth(), Carbon::now()->day(1)->month($month)->endOfMonth()]);
    }

    public function scopeYearlyTasksAssigned($query,$user, $year) {
        if($year == null)
            return $user->tasks()->wherePivotBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()]);

        return $user->tasks()->wherePivotBetween('created_at', [Carbon::now()->day(1)->year($year)->startOfYear(), Carbon::now()->day(1)->year($year)->endOfYear()]);
    }

    public function scopeYearlyTasksCompleted($query,$user, $year) {
        if($year == null)
            return $user->tasks->whereBetween('completed_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()]);

        return $user->tasks->whereBetween('completed_at', [Carbon::now()->day(1)->year($year)->startOfYear(), Carbon::now()->day(1)->year($year)->endOfYear()]);
    }
}
