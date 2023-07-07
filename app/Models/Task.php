<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    public function users() : BelongsToMany {
        return $this->belongsToMany(User::class);
    }

    public function creator() {
        return $this->belongsTo(User::class);
    }

    public function status() {
        return $this->belongsTo(Status::class,'status_id','id');
    }
}
