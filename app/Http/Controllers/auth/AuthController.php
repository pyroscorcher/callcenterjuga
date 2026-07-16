<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman UI Login (Vue/Inertia)
     */
    public function create()
    {
        return Inertia::render('Login'); // Pastikan path ini sesuai dengan file Login.vue Anda
    }

    /**
     * Memproses data form login
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari Vue
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cek apakah user menceklis "Remember Me"
        $remember = $request->boolean('remember');

        // 3. Proses pengecekan ke database
        if (Auth::attempt($credentials, $remember)) {
            // Keamanan: Regenerasi session untuk mencegah Session Fixation attack
            $request->session()->regenerate();

            // Redirect ke halaman dashboard
            return redirect()->intended('dashboard');
        }

        // 4. Jika gagal, kembalikan ke halaman login beserta pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Memproses Logout
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        // Hapus dan reset session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}