<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\User;
use App\Seleksi;
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
        $profile = User::find(Auth::user()->id);
        if (Auth::user()->user_level != 'Peserta') {
          $count = User::where('user_level', 'Peserta')->count();
          $csg = Seleksi::where('peminatan', 'Study Group')->count();
          $crg = Seleksi::where('peminatan', 'Reserach Group')->count();
          // dd($crg);
          return view('admin.dashboard', compact('profile', 'count', 'csg', 'crg'));
        } else {
          return view('peserta.dashboard', compact('profile'));
        }
    }

    public function list()
    {
      $user = User::all();
      // dd($user);
      return view('admin.user', compact('user'));
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

      $user->update([
        'email' => $request->email,
        'name' => $request->name,
        'alamat' => $request->alamat,
        'jurusan' => $request->jurusan,
        'fakultas' => $request->fakultas,
        'angkatan' => $request->angkatan,
      ]);

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

      $request->session()->flash('alert-class', 'alert-success');
      $request->session()->flash('message', 'Your profile has been updated!');

      return redirect()->route('profile');
    }

    public function edit($id){
      $user = User::find($id);
      return $user->toJson();
    }

    public function changePassword(Request $request){
      $this->validate($request, [
          'password' => 'required|string|min:6',
      ]);
      $user = User::find($request->id);
      $user->update([
          'password' => bcrypt($request->password),
      ]);
      $request->session()->flash('alert-class', 'alert-success');
      $request->session()->flash('message', 'Password has been updated!');
      return redirect()->route('admin.users');
    }

    public function cek_verifikasi(Request $request){
      $seleksi = Seleksi::find($request->id);
      // dd($seleksi);
      if ($seleksi != null) {
        if ($seleksi->status == 'Verified') {
          return false;
        }
        return true;
      }
      return true;
    }

    public function setAdmin(Request $request){
      $user = User::find($request->id);
      // dd($request);
      if ($this->cek_verifikasi($request)) {
        $level = 'Admin';
        $user->user_level = $level;
        $user->save();

        if($this->cekSeleksi($request->id)){
          $this->delSeleksi($request->id);
        }

        $request->session()->flash('alert-class', 'alert-success');
        $request->session()->flash('message', 'Username : ' .$user->username. ' (' .$user->nim. ') has been changed to Admin!');
      } else {
        $request->session()->flash('alert-class', 'alert-warning');
        $request->session()->flash('message', 'Username : ' .$user->username. ' (' .$user->nim. ') Atatchment has been verified!');
      }
      return redirect()->route('admin.users');
    }

    public function setSuperAdmin(Request $request){
      if (Auth::user()->user_level == 'Super Admin') {
        $user = User::find($request->id);
        if ($this->cek_verifikasi($request)) {
          $level = 'Super Admin';
          $user->user_level = $level;
          $user->save();

          if($this->cekSeleksi($request->id)){
            $this->delSeleksi($request->id);
          }

          $request->session()->flash('alert-class', 'alert-success');
          $request->session()->flash('message', 'Username : ' .$user->username. ' (' .$user->nim. ') has been changed to Super Admin!');
        } else {
          $request->session()->flash('alert-class', 'alert-warning');
          $request->session()->flash('message', 'Username : ' .$user->username. ' (' .$user->nim. ') Atatchment has been verified!');
        }
      } else {
        $request->session()->flash('alert-class', 'alert-danger');
        $request->session()->flash('message', 'Please become to Super Admin!');
      }
      return redirect()->route('admin.users');
    }

    public function cekSeleksi($id) {
      $seleksi = Seleksi::find($id);
      if($seleksi == null){
        return false;
      }
      return true;
    }

    public function delSeleksi($id) {
      $seleksi = Seleksi::find($id);
      $seleksi->delete();
    }

    public function delete(Request $request) {
      if (Auth::user()->user_level == 'Super Admin') {
        $user = User::find($request->id);

        $request->session()->flash('alert-class', 'alert-success');
        $request->session()->flash('message', 'Username : ' .$user->username. ' (' .$user->nim. ') has been Deleted!');

        $user->delete();
      } else {
        $request->session()->flash('alert-class', 'alert-danger');
        $request->session()->flash('message', 'Please become to Super Admin!');
      }
      return redirect()->route('admin.users');
    }
}
