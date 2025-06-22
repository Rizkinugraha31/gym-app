<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkoutPlan;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Menampilkan daftar exercise untuk sebuah workout plan tertentu.
     */
    public function index(WorkoutPlan $workoutPlan)
    {
        // Ambil exercises yang hanya milik workoutPlan ini
        $exercises = $workoutPlan->exercises()->get();

        return view('admin.exercises.index', compact('workoutPlan', 'exercises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, WorkoutPlan $workoutPlan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sets' => 'required|integer|min:1',
            'reps' => 'required|string|max:50',
            'instructions' => 'nullable|string',
        ]);

        // Buat exercise baru yang otomatis terhubung dengan workoutPlan ini
        $workoutPlan->exercises()->create($validated);

        return redirect()->back()->with('success', 'Exercise baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
