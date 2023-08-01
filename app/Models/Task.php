<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'due_date',
        'creator_id',
    ];

    public function users() : BelongsToMany {
        return $this->belongsToMany(User::class);
    }

    public function creator() {
        return $this->belongsTo(User::class);
    }

    public function status() {
        return $this->belongsTo(Status::class,'status_id','id');
    }

    public function scopeWeeklyTasksCreated($query) {
        return $query->whereBetween('created_at', [Carbon::now()->startOfDay()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
    }

    public function scopeWeeklyTasksCompleted($query) {
        return $query->whereBetween('completed_at', [Carbon::now()->startOfDay()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
    }

    public function scopeMonthlyTasksCreated($query, $month) {
        if($month == null)
            return $query->whereBetween('created_at', [Carbon::now()->startOfMonth() , Carbon::now()->endOfMonth()])->get();

        return $query->whereBetween('created_at', [Carbon::now()->day(1)->month($month)->startOfMonth(), Carbon::now()->day(1)->month($month)->endOfMonth()])->get();
    }

    public function scopeMonthlyTasksCompleted($query, $month) {
        if($month == null)
            return $query->whereBetween('completed_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();

        return $query->whereBetween('completed_at', [Carbon::now()->day(1)->month($month)->startOfMonth(), Carbon::now()->day(1)->month($month)->endOfMonth()])->get();
    }

    public function scopeYearlyTasksCreated($query, $year) {
        if($year == null)
            return $query->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();

        return $query->whereBetween('created_at', [Carbon::now()->day(1)->year($year)->startOfYear(), Carbon::now()->day(1)->year($year)->endOfYear()])->get();
    }

    public function scopeYearlyTasksCompleted($query, $year) {
        if($year == null)
            return $query->whereBetween('completed_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();

        return $query->whereBetween('completed_at', [Carbon::now()->day(1)->year($year)->startOfYear(), Carbon::now()->day(1)->year($year)->endOfYear()])->get();
    }
}
