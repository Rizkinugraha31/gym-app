<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkoutPlan; // <-- Import model
use Illuminate\Http\Request;

class WorkoutPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua jadwal, urutkan berdasarkan hari
        $plans = WorkoutPlan::orderBy('day_of_week')->paginate(10);
        return view('admin.workout_plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Hanya menampilkan view form tambah
        return view('admin.workout_plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'day_of_week' => 'required|integer|between:1,7|unique:workout_plans,day_of_week',
        ], [
            'day_of_week.unique' => 'Jadwal untuk hari ini sudah ada.'
        ]);

        WorkoutPlan::create($validatedData);

        return redirect()->route('admin.workout-plans.index')->with('success', 'Jadwal latihan baru berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkoutPlan $workoutPlan)
    {
        // Akan kita gunakan di tahap selanjutnya
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkoutPlan $workoutPlan)
    {
        return view('admin.workout_plans.edit', compact('workoutPlan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkoutPlan $workoutPlan)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Pastikan validasi unique mengabaikan data yang sedang diedit
            'day_of_week' => ['required', 'integer', 'between:1,7', Rule::unique('workout_plans')->ignore($workoutPlan->id)],
        ], [
            'day_of_week.unique' => 'Jadwal untuk hari ini sudah ada.'
        ]);

        $workoutPlan->update($validatedData);

        return redirect()->route('admin.workout-plans.index')->with('success', 'Jadwal latihan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkoutPlan $workoutPlan)
    {
        $workoutPlan->delete();
        return redirect()->route('admin.workout-plans.index')->with('success', 'Jadwal latihan berhasil dihapus.');
    }
}
