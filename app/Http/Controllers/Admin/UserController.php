<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Ambil user biasa (bukan admin) dan hitung berapa kali mereka booking
        $users = User::withCount(['bookings' => function($q) {
            $q->whereIn('status', ['Completed', 'active']);
        }])->latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Proteksi agar admin tidak menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Protokol Ditolak: Anda tidak bisa menghapus akun Anda sendiri!');
        }

        $user->delete();
        return back()->with('success', 'Intelijen: Data pelanggan telah dihapus dari ekosistem.');
    }
}
