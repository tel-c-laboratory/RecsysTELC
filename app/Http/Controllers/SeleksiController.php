<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Seleksi;
use Auth;

class SeleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (Auth::user()->user_level != 'Peserta') {
        $seleksi = User::where('user_level','peserta')->get();
        return view('admin.recruitment', compact('seleksi'));
      } else {
        $profile = User::find(Auth::user()->id);
        return view('peserta.recruitment', compact('profile'));
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (Auth::user()->seleksi->status == 'Verified') {
        $request->session()->flash('alert-class', 'alert-warning');
        $request->session()->flash('message', 'Update Failed! Your attachment has been Verified.');
      } else {
        if(Auth::user()->angkatan == null || Auth::user()->angkatan == '') {
          $request->session()->flash('alert-class', 'alert-warning');
          $request->session()->flash('message', 'Update Failed! Plase Update your Profile!');
        } else {
          if (Auth::user()->angkatan == 2015 && $request->peminatan != 'Research Group') {
            $request->session()->flash('alert-class', 'alert-warning');
            $request->session()->flash('message', 'Update Failed! Angakatan 2015 must be choose Research Group.');
          } else if(Auth::user()->angkatan == 2017 && $request->peminatan != 'Study Group') {
            $request->session()->flash('alert-class', 'alert-warning');
            $request->session()->flash('message', 'Update Failed! Angakatan 2017 must be choose Study Group.');
          } else {
            $seleksi = Seleksi::updateOrCreate(
              [
                'id' => Auth::user()->id,
              ],
              [
                'peminatan' => $request->peminatan,
              ]
            );
            $request->session()->flash('alert-class', 'alert-success');
            $request->session()->flash('message', 'Peminatan '. $request->peminatan .' berhasil disimpan!');
          }
        }
      }
      return redirect()->route('seleksi.index');
    }

    public function cekPeminatan(){
      $cek = Auth::user()->seleksi->peminatan;
      if ($cek == 'Study Group') {
        return 'SG';
      } else if ($cek == 'Research Group') {
        return 'RG';
      }
      return null;
    }

    public function upload(Request $request)
    {
      // dd($request->berkas);
      if ($this->getUploadBerkas() != 'Aktif') {
        $request->session()->flash('alert-class', 'alert-danger');
        $request->session()->flash('message', 'Upload Failed! Upload Berkas belum diperbolehkan. Silakan hubungi Admin.');
      } elseif ($this->cekPeminatan() == null) {
        $request->session()->flash('alert-class', 'alert-danger');
        $request->session()->flash('message', 'Upload Failed! Silakan pilih peminatan / group terlebih dahulu.');
      } elseif (Auth::user()->seleksi->status == 'Verified') {
        $request->session()->flash('alert-class', 'alert-warning');
        $request->session()->flash('message', 'Upload Failed! Your previuos attachment has been Verified.');
      } else {
        if ($request->hasFile('berkas')) {
          $this->validate($request, [
              'berkas' => 'required|mimes:rar|max:5120',
          ]);
          $filename = "[RECSYS]_TELC17_". $this->cekPeminatan() . "_" . Auth::user()->nim . ".rar";
          $status = $request->berkas->storeAs('public/upload', $filename);

          $seleksi = Seleksi::updateOrCreate(
            [
              'id' => Auth::user()->id,
            ],
            [
              'berkas' => $filename,
            ]
          );
          $request->session()->flash('alert-class', 'alert-success');
          $request->session()->flash('message', 'Attachment has been uploaded!');
        }
      }
      return redirect()->route('seleksi.index');
    }

    public function verifikasi(Request $request){
      $seleksi = Seleksi::find($request->id);
      $seleksi->update([
          'status' => 'Verified',
      ]);
      $request->session()->flash('alert-class', 'alert-success');
      $request->session()->flash('message', 'Attachment has been Verified!');
      return redirect()->route('admin.seleksi.index');
    }

    public function pengumuman(){
      $gub = $this->getUploadBerkas();
      $gtb = $this->getTahapBerkas();
      $gtw = $this->getTahapWawancara();
      $profile = User::find(Auth::user()->id);
      return view('peserta.result', compact('gub', 'gtb', 'gtw', 'profile'));
    }

    public function setLolos(Request $request) {
      if ($request->id != null) {
          foreach ($request->id as $id) {
            $seleksi = Seleksi::find($id);
            if ($request->status == 'Lolos Seleksi Berkas') {
              $seleksi->lolos_berkas = 'Ya';
            } else {
              $seleksi->lolos_wawancara = 'Ya';
            }
            $seleksi->save();
          }
      }
      $request->session()->flash('alert-class', 'alert-success');
      $request->session()->flash('message', 'Status Lolos has been Updated!');
      return redirect()->route('admin.seleksi.index');
    }

    public function setting(){
      if (Auth::user()->user_level == 'Super Admin') {
        $stp = $this->getStatusPendaftaran();
        $gub = $this->getUploadBerkas();
        $gtb = $this->getTahapBerkas();
        $gtw = $this->getTahapWawancara();
        return view('admin.setting', compact('stp', 'gub', 'gtb', 'gtw'));
      }
      return redirect()->route('admin.setting');
    }

    public function getStatusPendaftaran(){
      $config = DB::table('settings')->where('config', 'status_pendaftaran')->first();
      return $config->value;
    }

    public function getUploadBerkas(){
      $config = DB::table('settings')->where('config', 'upload_berkas')->first();
      return $config->value;
    }

    public function getTahapBerkas(){
      $config = DB::table('settings')->where('config', 'seleksi_berkas')->first();
      return $config->value;
    }

    public function getTahapWawancara(){
      $config = DB::table('settings')->where('config', 'seleksi_wawancara')->first();
      return $config->value;
    }    

    public function updateSettings(Request $request){
      $request->validate([
        'status_pendaftaran' => 'required',
        'upload_berkas' => 'required',
        'seleksi_berkas' => 'required',
        'seleksi_wawancara' => 'required',
      ]);

      DB::table('settings')->where('config', 'status_pendaftaran')
            ->update(['value' => $request->status_pendaftaran]);
      DB::table('settings')->where('config', 'upload_berkas')
            ->update(['value' => $request->upload_berkas]);      
      DB::table('settings')->where('config', 'seleksi_berkas')
            ->update(['value' => $request->seleksi_berkas]);
      DB::table('settings')->where('config', 'seleksi_wawancara')
            ->update(['value' => $request->seleksi_wawancara]);

      $request->session()->flash('alert-class', 'alert-success');
      $request->session()->flash('message', 'Settings has been updated!');

      return redirect()->route('admin.setting');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
