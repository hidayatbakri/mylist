<?php

namespace App\Http\Controllers;

use App\Mail\AuthMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $requestValidate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $checkActivate = User::where('email', $requestValidate['email'])->first();
        if ($checkActivate) {
            if ($checkActivate['email_verified_at'] != null) {
                if (Auth::attempt($requestValidate)) {
                    $path = Auth::user()->level == 'admin' ? 'admin' : 'user';
                    return redirect('/' . $path);
                }
                return redirect()->back()->with('error', 'Username atau password salah');
            } else {
                return redirect()->back()->with('error', 'Akun belum di verifikasi');
            }
        }
        return redirect()->back()->with('error', 'Username atau password salah');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reqValidate = $request->validate([
            'username' => 'required|min:3|unique:users',
            'type' => 'integer|required',
            'email' => 'required|email:dns   ',
            'password' => 'required|min:8'
        ]);

        $tokenActive = Hash::make($request->email . $request->username);
        $reqValidate['password'] = Hash::make($request->password);
        $reqValidate['level'] = 'user';
        $reqValidate['token_activate'] = $tokenActive;
        $data_email = [
            'subject' => 'no-reply | Activate your account',
            'name' => $request->name,
            'link' => env('APP_URL') . '/activate?token=' . $tokenActive
        ];
        Mail::to($request->email)->send(new AuthMail($data_email));
        User::create($reqValidate);

        return redirect('/login')->with('success', 'Berhasil membuat akun baru, cek email verifikasi');
    }

    public function activate(Request $request)
    {
        $user = User::where('token_activate', $request->get('token'))->first();
        if ($user != null) {
            User::find($user->id)->update(['email_verified_at' => Carbon::now()]);
            return redirect('/login')->with('success', 'Berhasil mengaktifkan akun anda');
        }
        return redirect('/login')->with('error', 'Gagal mengaktifkan akun');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Berhasil keluar');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
