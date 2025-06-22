@extends('admin.layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tambah Jadwal Latihan Baru</h1>
    <form action="{{ route('admin.workout-plans.store') }}" method="POST">
        @csrf
        {{-- Sama seperti form edit member, buat input untuk: --}}
        {{-- 1. Nama Jadwal (name) - text --}}
        {{-- 2. Deskripsi (description) - textarea --}}
        {{-- 3. Hari (day_of_week) - select dropdown --}}
        <div class="mb-4">
            <label for="day_of_week">Hari</label>
            <select name="day_of_week" id="day_of_week" class="shadow border rounded w-full py-2 px-3" required>
                <option value="1">Senin</option>
                <option value="2">Selasa</option>
                <option value="3">Rabu</option>
                <option value="4">Kamis</option>
                <option value="5">Jumat</option>
                <option value="6">Sabtu</option>
                <option value="7">Minggu</option>
            </select>
        </div>
        {{-- ...input lainnya dan tombol submit... --}}
    </form>
@endsection
