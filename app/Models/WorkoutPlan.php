<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutPlan extends Model
{
    use HasFactory;

    // Tentukan kolom mana saja yang boleh diisi secara massal (mass assignable)
    protected $fillable = ['name', 'description', 'day_of_week'];

    /**
     * Sebuah WorkoutPlan memiliki banyak Exercise.
     */
    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }
}
