<?php

namespace App\Http\Controllers;

use App\Mail\AuthMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Dashboard | MyList';
        $activeL = 'home';
        return view('user.index', compact('title', 'activeL'));
    }

    public function account()
    {
        $title = 'Profil akun | MyList';
        $activeL = 'account';
        return view('user.account', compact('title', 'activeL'));
    }

    public function editAccount()
    {
        $title = 'Edit akun | MyList';
        $activeL = 'account';
        return view('user.editAccount', compact('title', 'activeL'));
    }

    public function updateAccount(Request $request)
    {
        $reqValidate = $request->validate([
            'type' => 'integer|required',
        ]);

        $request->username != Auth::user()->username ? $request->validate(['username' => 'min:3|required|unique:users']) : '';

        if ($request->password) {
            $reqValidate['password'] = Hash::make($request->password);
        }

        User::where('id', Auth::user()->id)->update($reqValidate);
        return redirect('/user/account')->with('success', 'Berhasil edit akun');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
