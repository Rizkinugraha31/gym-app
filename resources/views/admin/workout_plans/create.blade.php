@extends('admin.layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tambah Jadwal Latihan Baru</h1>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <form action="{{ route('admin.workout-plans.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Nama Jadwal (Contoh: Latihan Kaki & Perut)
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" id="name" name="name" type="text" value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Deskripsi (Opsional)
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description">{{ old('description') }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="day_of_week">
                    Hari
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('day_of_week') border-red-500 @enderror" name="day_of_week" id="day_of_week" required>
                    <option value="">-- Pilih Hari --</option>
                    <option value="1">Senin</option>
                    <option value="2">Selasa</option>
                    <option value="3">Rabu</option>
                    <option value="4">Kamis</option>
                    <option value="5">Jumat</option>
                    <option value="6">Sabtu</option>
                    <option value="7">Minggu</option>
                </select>
                @error('day_of_week')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-start">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
@endsection
