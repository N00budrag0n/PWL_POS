<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        // ambil data user dan simpan pada variabel user
        $user = Auth::user();
        // cek apakah user ada atau tidak
        if ($user) {
            // cek level user
            if ($user->level_id == 1) {
                return redirect('/admin');
            } else if ($user->level_id == 2) {
                return redirect()->intended('/manager');
            }
        }
        return view('login');
    }

    public function proses_login(Request $request)
    {
        // buat validasi tombol, memvalidasi username dan password
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);


        // cek apakah username dan password sesuai
        if ( Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // simpan data user
            $user = Auth::user();
            // cek level user
            if ($user->level_id == '1') {
                return redirect('admin');
            } else if ($user->level_id == '2') {
                return redirect()->intended('manager');
            }
            return redirect()->intended('/');
        }

        // jika username dan password tidak sesuai
        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'Pastikan kembali username dan password yang dimasukan sudah benar']);
    }

    public function register()
    {
        // tampilkan view register
        return view('register');
    }

    public function proses_register(Request $request)
    {
        // buat validasi tombol, memvalidasi username dan password
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:m_user',
            'password' => 'required',
        ]);

        // kalau gagal
        if($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        // kalau berhasil isi level dan hash password
        $request['level_id'] = 2;
        $request['password'] = Hash::make($request['password']);
        // simpan data user ke table user
        UserModel::create($request->all());
        // kembalikan ke halaman login
        return redirect()->route('/login');
    }

    public function logout(Request $request)
    {
        // bersihkan session
        $request->session()->flush();
        // logout auth
        Auth::logout();
        // kembalikan ke halaman login
        return redirect('/login');
    }
}
