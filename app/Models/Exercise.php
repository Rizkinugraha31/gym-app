<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = ['workout_plan_id', 'name', 'sets', 'reps', 'instructions'];

    /**
     * Sebuah Exercise dimiliki oleh satu WorkoutPlan.
     */
    public function workoutPlan()
    {
        return $this->belongsTo(WorkoutPlan::class);
    }
}
