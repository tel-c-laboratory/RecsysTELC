<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Seleksi;
use Auth;

class SeleksiController extends Controller
{

    public function index()
    {
      if (Auth::user()->user_level != 'Peserta') {
        $seleksi = User::where('user_level','peserta')->get();
        return view('admin.recruitment', compact('seleksi'));
      } else {
        $profile = User::find(Auth::user()->id);
        $upp = $this->getUrlPersonalPlan();
        $upr = $this->getUrlPaperReview();
        return view('peserta.recruitment', compact('profile', 'upp', 'upr'));
      }
    }

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
          if (Auth::user()->angkatan == 2016 && $request->peminatan != 'Research Group') {
            $request->session()->flash('alert-class', 'alert-warning');
            $request->session()->flash('message', 'Update Failed! Angakatan 2016 must be choose Research Group.');
          } else if(Auth::user()->angkatan == 2018 && $request->peminatan != 'Study Group') {
            $request->session()->flash('alert-class', 'alert-warning');
            $request->session()->flash('message', 'Update Failed! Angakatan 2018 must be choose Study Group.');
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
          $filename = "[RECSYS]_TELC19_". $this->cekPeminatan() . "_" . Auth::user()->nim . ".rar";
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
      $ujw = $this->getUrlJadwalWawancara();
      $uto = $this->getUrlTesOnline();
      $fmt = $this->getFirstMeetTanggal();
      $fmj = $this->getFirstMeetJam();
      $fmc = $this->getFirstMeetContactPerson();
      $profile = User::find(Auth::user()->id);
      return view('peserta.result', compact('gub', 'gtb', 'gtw', 'ujw', 'uto', 'profile', 'fmt', 'fmj', 'fmc'));
    }

    public function setLulus(Request $request) {
      if ($request->id != null) {
          foreach ($request->id as $id) {
            $seleksi = Seleksi::find($id);
            if ($request->status == 'Lulus Seleksi Tahap 1') {
              $seleksi->lulus_berkas = 'Ya';
            } else {
              $seleksi->lulus_wawancara = 'Ya';
            }
            $seleksi->save();
          }
      }
      $request->session()->flash('alert-class', 'alert-success');
      $request->session()->flash('message', 'Status Lulus has been Updated!');
      return redirect()->route('admin.seleksi.index');
    }

    public function setting(){
      if (Auth::user()->user_level == 'Super Admin') {
        $stp = $this->getStatusPendaftaran();
        $gub = $this->getUploadBerkas();
        $gtb = $this->getTahapBerkas();
        $gtw = $this->getTahapWawancara();
        $upp = $this->getUrlPersonalPlan();
        $upr = $this->getUrlPaperReview();
        $ujw = $this->getUrlJadwalWawancara();
        $uto = $this->getUrlTesOnline();
        $rtl = $this->getRecruitmentTimeline();
        $fmt = $this->getFirstMeetTanggal();
        $fmj = $this->getFirstMeetJam();
        $fmc = $this->getFirstMeetContactPerson();

        return view('admin.setting', compact('stp', 'gub', 'gtb', 'gtw', 'upp', 'upr', 'ujw', 'uto', 'rtl', 'fmt', 'fmj', 'fmc'));
      }
      return redirect()->route('admin.setting');
    }

    public function getStatusPendaftaran(){
      $config = DB::table('settings')->where('config', 'status_pendaftaran')->first();
      return $config->value;
    }

    public function getRecruitmentTimeline(){
      $config = DB::table('settings')->where('config', 'recruitment_timeline')->first();
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
    
    public function getUrlPersonalPlan(){
      $config = DB::table('settings')->where('config', 'url_personal_plan')->first();
      return $config->value;
    } 

    public function getUrlPaperReview(){
      $config = DB::table('settings')->where('config', 'url_paper_review')->first();
      return $config->value;
    } 

    public function getUrlJadwalWawancara(){
      $config = DB::table('settings')->where('config', 'url_jadwal_wawancara')->first();
      return $config->value;
    }

    public function getUrlTesOnline(){
      $config = DB::table('settings')->where('config', 'url_tes_online')->first();
      return $config->value;
    }

    public function getFirstMeetTanggal(){
      $config = DB::table('settings')->where('config', 'fm_tanggal')->first();
      return $config->value;
    } 

    public function getFirstMeetJam(){
      $config = DB::table('settings')->where('config', 'fm_jam')->first();
      return $config->value;
    } 

    public function getFirstMeetContactPerson(){
      $config = DB::table('settings')->where('config', 'fm_cp')->first();
      return $config->value;
    } 

    public function updateSettings(Request $request){
      $request->validate([
        'status_pendaftaran' => 'required',
        'upload_berkas' => 'required',
        'seleksi_berkas' => 'required',
        'seleksi_wawancara' => 'required',
        'url_personal_plan' => 'required|url',
        'url_paper_review' => 'required|url',
        'url_jadwal_wawancara' => 'required|url',
        'url_tes_online' => 'required|url',
      ]);

      DB::table('settings')->where('config', 'status_pendaftaran')
            ->update(['value' => $request->status_pendaftaran]);
      DB::table('settings')->where('config', 'upload_berkas')
            ->update(['value' => $request->upload_berkas]);      
      DB::table('settings')->where('config', 'seleksi_berkas')
            ->update(['value' => $request->seleksi_berkas]);
      DB::table('settings')->where('config', 'seleksi_wawancara')
            ->update(['value' => $request->seleksi_wawancara]);
      DB::table('settings')->where('config', 'url_personal_plan')
            ->update(['value' => $request->url_personal_plan]);
      DB::table('settings')->where('config', 'url_paper_review')
            ->update(['value' => $request->url_paper_review]);
      DB::table('settings')->where('config', 'url_jadwal_wawancara')
            ->update(['value' => $request->url_jadwal_wawancara]);
      DB::table('settings')->where('config', 'url_tes_online')
            ->update(['value' => $request->url_tes_online]);

      $request->session()->flash('alert-class', 'alert-success');
      $request->session()->flash('message', 'Settings has been updated!');

      return redirect()->route('admin.setting');
    }

    public function updateSettingsFirstMeet(Request $request){
      $request->validate([
        'fm_tanggal' => 'required',
        'fm_jam' => 'required',
        'fm_cp' => 'required',
      ]);

      DB::table('settings')->where('config', 'fm_tanggal')
            ->update(['value' => $request->fm_tanggal]);
      DB::table('settings')->where('config', 'fm_jam')
            ->update(['value' => $request->fm_jam]);
      DB::table('settings')->where('config', 'fm_cp')
            ->update(['value' => $request->fm_cp]);

      $request->session()->flash('alert-class', 'alert-success');
      $request->session()->flash('message', 'Informasi First Meet has been updated!');

      return redirect()->route('admin.setting');
    }

    public function updateSettingsTimeline(Request $request){
      $request->validate([
        'recruitment_timeline' => 'required',
      ]);

      DB::table('settings')->where('config', 'recruitment_timeline')
            ->update(['value' => $request->recruitment_timeline]);

      $request->session()->flash('alert-class', 'alert-success');
      $request->session()->flash('message', 'Recruitment Timeline has been updated!');

      return redirect()->route('admin.setting');
    }
}
