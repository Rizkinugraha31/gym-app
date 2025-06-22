<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkoutPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Ambil semua jadwal, urutkan berdasarkan hari
    $plans = \App\Models\WorkoutPlan::orderBy('day_of_week')->paginate(10);
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
        //
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
