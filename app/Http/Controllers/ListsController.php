<?php

namespace App\Http\Controllers;

use App\Models\Lists;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ListsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $lists = Setting::with('lists')->where('slug', $id)->first();
        return view('list', compact('lists'));
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

        if ($request->wa_check) {
            $reqValidate = $request->validate([
                'title' => 'required|max:30',
                'subtitle' => 'max:25',
                'setting_id' => 'integer|required',
                'wa' => 'required',
                'message' => 'required',
            ]);
        } else {
            $reqValidate = $request->validate([
                'title' => 'required|max:30',
                'subtitle' => 'max:25',
                'setting_id' => 'integer|required',
                'url' => 'required',
            ]);
        }

        if (Auth::user()->subscription == 2) {
        }

        $lastPosition = Lists::where('setting_id', $request->setting_id)->max('position');
        $reqValidate['position'] = $lastPosition + 1;
        // $reqValidate['slug'] = Str::slug(Auth::user()->username, '-');
        Lists::create($reqValidate);
        return redirect()->back()->with('success', 'Berhasil membuat baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lists $lists)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lists $lists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lists $lists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lists $lists, $id)
    {
        Lists::find($id)->delete();
        return redirect()->back();
    }
}
