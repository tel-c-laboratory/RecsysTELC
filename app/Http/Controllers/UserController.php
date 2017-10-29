<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('home');
        $profile = User::find(Auth::user()->id);
        return view('peserta.dashboard', compact('profile'));
    }

    public function show()
    {
      $profile = User::find(Auth::user()->id);
      // dd($profile);
      return view('profile', compact('profile'));
    }

    public function update(Request $request)
    {
      $user = User::find(Auth::user()->id);

      if ($request->hasFile('photo')) {
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg|max:1024',
        ]);

        $filename = "PP_" . Auth::user()->nim . ".jpg";
        $status = $request->photo->storeAs('public/profile', $filename);

        $user->update([
          'photo' => $filename,
        ]);
      }

      $user->update([
        'email' => $request->email,
        'name' => $request->name,
        'alamat' => $request->alamat,
        'jurusan' => $request->jurusan,
        'fakultas' => $request->fakultas,
        'angkatan' => $request->angkatan,
      ]);

      return redirect()->route('profile');
    }
}
