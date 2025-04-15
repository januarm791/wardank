<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MembershipController extends Controller {
    public function showRegisterForm() {
        return view('membership.register');
    }

    public function register(Request $request) {
        // Pastikan pengguna login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        // Pastikan user belum menjadi member sebelumnya
        if ($user->is_member) {
            return redirect()->route('dashboard')->with('info', 'Anda sudah menjadi member.');
        }

        // Validasi jika ada input tambahan
        $request->validate([
            'additional_info' => 'nullable|string|max:255', // Contoh tambahan
        ]);


    return redirect()->route('register')->with('success', 'Anda sekarang menjadi member!');
    }
}
