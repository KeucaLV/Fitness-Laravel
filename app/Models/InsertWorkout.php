<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertWorkout extends Model
{
    use HasFactory;

    protected $fillable = ['workout_name', 'duration_hours', 'description'];
    protected $table = 'insertworkouts';
}
