<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan form halaman login
     */
    public function showLoginForm(Request $request)
    {
        // Jika guest datang dari klik tombol pesan, pasang banner konteks & set url.intended (Section 7.2)
        if ($request->has('pesan') || $request->has('order')) {
            session()->flash('guest_order_info', 'Masuk terlebih dahulu untuk melanjutkan pemesanan Anda.');
            session()->put('url.intended', route('keranjang'));
        }

        return view('pages.auth.login');
    }

    /**
     * Menampilkan form pendaftaran akun
     */
    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    /**
     * Memproses pendaftaran akun pelanggan baru
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users,email',
            'password'              => 'required|string|min:8|confirmed',
        ], [
            'name.required'         => 'Nama lengkap wajib diisi.',
            'email.required'        => 'Alamat email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.unique'          => 'Email sudah terdaftar. Silakan gunakan email lain atau masuk.',
            'password.required'     => 'Kata sandi wajib diisi.',
            'password.min'          => 'Kata sandi minimal 8 karakter.',
            'password.confirmed'    => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = User::create([
            'name'     => trim($request->name),
            'email'    => trim(strtolower($request->email)),
            'password' => Hash::make($request->password),
            'role'     => 'pelanggan',
        ]);

        // Langsung autentikasi pengguna baru
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('katalog'))
            ->with('success', 'Akun berhasil dibuat. Selamat datang di Tuan Parfum!');
    }

    /**
     * Memproses autentikasi login pengguna (Admin, Kurir, Pelanggan)
     * Ditulis terstruktur dan mudah dipahami selayaknya standar proyek mahasiswa.
     */
    public function login(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required'    => 'Username atau email wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $loginInput = trim($request->input('email'));
        $password   = $request->input('password');

        // 2. Cek fleksibilitas input:
        // Jika admin mengetik 'admin', kita arahkan ke email akun seeder admin@tuanparfum.com
        if ($loginInput === 'admin') {
            $email = 'admin@tuanparfum.com';
        } else {
            $email = $loginInput;
        }

        // 3. Eksekusi pengecekan kredensial dengan Auth::attempt
        $credentials = [
            'email'    => $email,
            'password' => $password,
        ];

        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk mencegah session fixation
            $request->session()->regenerate();

            // Cek role user yang berhasil login dan arahkan ke dashboard masing-masing
            $userRole = Auth::user()->role;

            if ($userRole === 'admin') {
                // Simpan session khusus admin agar tombol ke dashboard dapat tampil saat melihat website
                $request->session()->put('is_admin', true);
                $request->session()->put('admin_logged_in', true);

                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Selamat datang kembali di Panel Admin, ' . Auth::user()->name);
            }

            if ($userRole === 'kurir') {
                return redirect()->intended(route('kurir.pengiriman'))
                    ->with('success', 'Selamat bertugas, ' . Auth::user()->name);
            }

            // Default untuk pelanggan biasa
            return redirect()->intended(route('katalog'))
                ->with('success', 'Selamat datang di Tuan Parfum.');
        }

        // 4. Jika kredensial salah, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Username/email atau kata sandi tidak cocok.',
        ])->onlyInput('email');
    }

    /**
     * Menangani proses logout dan pembersihan session
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beranda')->with('info', 'Anda telah berhasil keluar.');
    }
}
