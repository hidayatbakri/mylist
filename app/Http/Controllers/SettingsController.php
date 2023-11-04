<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'List | MyList';
        $activeL = 'list';
        $lists = Setting::all();
        return view('user.list.index', compact('title', 'activeL', 'lists'));
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
        $reqValidate = $request->validate([
            'title' => 'required'
        ]);

        $reqValidate['user_id'] = Auth::user()->id;
        $reqValidate['slug'] = Str::random(5);

        $cekTotal = Setting::where('user_id', Auth::user()->id)->count();
        if ($cekTotal < 4) {
            Setting::create($reqValidate);
            return redirect()->back()->with('success', 'Berhasil membuat baru');
        }
        return redirect()->back()->with('failed', 'Akun anda telah mencapai limit');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting, $listid)
    {
        $title = 'Detail List | MyList';
        $activeL = 'list';

        return view('user.list.show', compact('title', 'activeL', 'listid'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting, $id)
    {
        $title = 'Detail List | MyList';
        $activeL = 'list';
        $lists = Setting::with('lists')->where('id', $id)->first();
        return view('user.list.edit', compact('title', 'activeL', 'lists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting, $id)
    {

        $setting = Setting::where('id', $id)->first();
        // dd($request->file('bg_list'));

        if ($request->type_bg == 0) {
            $setting->type_bg && $request->bg_list != null ? Storage::disk()->delete($setting->bg_list) : '';
            $reqValidate = $request->validate([
                'title' => 'required',
                'bg_list' => 'required',
                'bg_color' => 'required',
                'title_color' => 'required',
                'type_bg' => 'required|integer',
                'text_color' => 'required',
                'list_color' => 'required',
            ]);
        }
        if ($request->type_bg == 1) {
            $reqValidate = $request->validate([
                'title' => 'required',
                'bg_list' => $request->bg_list != null ? 'mimes:png,jpg,jepg|max:512' : '',
                'bg_color' => 'required',
                'title_color' => 'required',
                'type_bg' => 'required|integer',
                'text_color' => 'required',
                'list_color' => 'required',
            ]);
            $request->bg_list != null ? Storage::disk()->delete($setting->bg_list) : '';
            $request->bg_list != null ? $reqValidate['bg_list'] =  $request->file('bg_list')->store('bg') : '';
        }
        // $request->file('bg_list') != null ?: '';

        Setting::where('id', $id)->update($reqValidate);
        return redirect()->back()->with('successs', 'Berhasil mengubah list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        Setting::find($setting->id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus list');
    }
}
