@extends('admin.layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Manajemen Jadwal Latihan</h1>
        <a href="{{ route('admin.workout-plans.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Jadwal Baru
        </a>
    </div>

    {{-- Tampilkan pesan sukses --}}
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full leading-normal">
            {{-- (Sama seperti tabel member, buat thead dengan kolom: Nama Jadwal, Hari, Aksi) --}}
            <thead>...</thead>
            <tbody>
                @forelse ($plans as $plan)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $plan->name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{-- Mengubah angka hari menjadi nama hari --}}
                            {{ \Carbon\Carbon::create()->startOfWeek()->addDays($plan->day_of_week - 1)->translatedFormat('l') }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="#" class="text-green-600 hover:text-green-900 mr-3">Kelola Exercises</a>
                            <a href="{{ route('admin.workout-plans.edit', $plan->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <form action="{{ route('admin.workout-plans.destroy', $plan->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center py-5">Belum ada jadwal latihan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
