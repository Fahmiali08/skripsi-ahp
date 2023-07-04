<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Repository\IndexRepository;


class AuthController extends Controller
{
    protected $indexRepo;

    public function __construct()
    {
        $this->indexRepo = new IndexRepository();
    }

    public function showFormLogin()
    {
        if ($user = Auth::user()) { //true sekalian session field di users nanti bisa dipanggil via Auth
            if ($user->role_id == 1) {
                return redirect()->intended('administrator');
            } elseif ($user->role_id == 2) {
                return redirect()->intended('teacher');
            } elseif ($user->role_id == 3) {
                return redirect()->intended('student');
            }
        }
        return view('components.login');
    }

    public function login(Request $request)
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            $user = Auth::user();
            if ($user->role_id == 1) {
                return redirect()->intended('administrator');
            } elseif ($user->role_id == 2) {
                return redirect()->intended('teacher');
            } elseif ($user->role_id == 3) {
                return redirect()->intended('student');
            }
            return redirect('/');
        } else { // false
            //Login Fail
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }
    }

    public function showFormRegister()
    {
        return view('components.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'name'                  => 'required|min:3|max:35',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed'
        ];

        $messages = [
            'name.required'         => 'Nama Lengkap wajib diisi',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            console.log('fahmialiiiiiiiiiiiiii');
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = new User;
        $user->name = ucwords(strtolower($request->name));
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->email_verified_at = \Carbon\Carbon::now();
        $simpan = $user->save();

        if($simpan){
            Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
            return redirect()->route('login');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('register');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('/');
    }
}
