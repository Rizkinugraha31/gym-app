<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class MemberController extends Controller
{
    /**
     * Menampilkan daftar semua member.
     */
    public function index()
    {
        // Ambil semua user, sertakan relasi memberships-nya, urutkan dari yang terbaru,
        // dan tampilkan 10 per halaman (paginasi).
        $members = User::with('memberships')->latest()->paginate(10);

        return view('admin.members.index', compact('members'));
    }

    /**
     * Menampilkan formulir untuk membuat member baru.
     * (Untuk saat ini kita biarkan kosong karena member mendaftar sendiri)
     */
    public function create()
    {
        //
    }

    /**
     * Menyimpan member baru yang dibuat oleh admin.
     * (Untuk saat ini kita biarkan kosong)
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Menampilkan detail satu member.
     * (Untuk saat ini kita biarkan kosong)
     */
    public function show(User $member)
    {
        //
    }

    /**
     * Menampilkan formulir untuk mengedit data member.
     */
    public function edit(User $member)
    {
        // Method ini hanya mengirimkan data member ke view 'edit'
        return view('admin.members.edit', compact('member'));
    }

    /**
     * Mengupdate data member di dalam database.
     */
    public function update(Request $request, User $member)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // Aturan 'unique' harus mengabaikan data user saat ini
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($member->id)],
            'no_hp' => ['required', 'string', 'max:15', Rule::unique('users')->ignore($member->id)],
        ]);

        // 2. Update data di database
        $member->update($validated);

        // 3. Redirect kembali ke halaman daftar member dengan pesan sukses
        return redirect()->route('admin.members.index')->with('success', 'Data member berhasil diperbarui!');
    }

    /**
     * Menghapus member dari database.
     */
    public function destroy(User $member)
    {
        // Hapus user, data membership yang berelasi akan ikut terhapus
        // karena kita sudah mendefinisikan onDelete('cascade') di migrasi.
        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil dihapus.');
    }

    /**
     * Method custom untuk mengonfirmasi pembayaran membership.
     */
    public function confirmPayment(Membership $membership)
    {
        // Hitung tanggal mulai dan selesai berdasarkan durasi
        $startDate = Carbon::now();
        $endDate = $membership->duration_type == 'daily'
            ? $startDate->copy()->addDay()
            : $startDate->copy()->addMonth();

        // Update status di database
        $membership->update([
            'payment_status' => 'paid',
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        return redirect()->back()->with('success', 'Pembayaran member berhasil dikonfirmasi!');
    }
}
