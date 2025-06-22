@extends('admin.layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold">Kelola Exercises untuk:</h1>
            <h2 class="text-xl text-blue-600">{{ $workoutPlan->name }}</h2>
        </div>
        <a href="{{ route('admin.workout-plans.index') }}" class="text-blue-500 hover:text-blue-800">
            &larr; Kembali ke Daftar Jadwal
        </a>
    </div>

    {{-- Form untuk Tambah Exercise Baru --}}
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
        <h3 class="text-lg font-bold mb-4">Tambah Exercise Baru</h3>
        <form action="{{ route('admin.workout-plans.exercises.store', $workoutPlan->id) }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" name="name" placeholder="Nama Exercise (cth: Bench Press)" class="shadow border rounded w-full py-2 px-3" required>
                <input type="number" name="sets" placeholder="Jumlah Set" class="shadow border rounded w-full py-2 px-3" required>
                <input type="text" name="reps" placeholder="Jumlah Reps (cth: 10-12)" class="shadow border rounded w-full py-2 px-3" required>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah</button>
            </div>
        </form>
    </div>

    {{-- Tabel untuk Daftar Exercise yang Sudah Ada --}}
    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left">Nama Latihan</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left">Sets</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left">Reps</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($exercises as $exercise)
                    <tr>
                        <td class="px-5 py-5 border-b">{{ $exercise->name }}</td>
                        <td class="px-5 py-5 border-b">{{ $exercise->sets }}</td>
                        <td class="px-5 py-5 border-b">{{ $exercise->reps }}</td>
                        <td class="px-5 py-5 border-b">
                             {{-- Tombol Edit & Hapus untuk exercise --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">Belum ada detail latihan untuk jadwal ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
