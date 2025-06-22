@extends('admin.layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Jadwal Latihan</h1>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <form action="{{ route('admin.workout-plans.update', $workoutPlan->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Isi form sama persis dengan create.blade.php, namun value-nya diisi data yang ada --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Nama Jadwal
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" id="name" name="name" type="text" value="{{ old('name', $workoutPlan->name) }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Deskripsi
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" id="description" name="description">{{ old('description', $workoutPlan->description) }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="day_of_week">
                    Hari
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" name="day_of_week" id="day_of_week" required>
                    @php $days = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu']; @endphp
                    @foreach ($days as $num => $day)
                        <option value="{{ $num }}" @if(old('day_of_week', $workoutPlan->day_of_week) == $num) selected @endif>{{ $day }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-start">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                    Update Jadwal
                </button>
            </div>
        </form>
    </div>
@endsection
