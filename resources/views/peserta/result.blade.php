@extends('layouts.template')

@section('content')
<div class="content">
    <div class="container-fluid">
      @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class') }}">
            <a href="#" aria-hidden="true" data-dismiss="alert" class="close" aria-label="close">&times;</a>
            <span>{{ Session::get('message') }}</span>
        </div>
      @endif
        <div class="row">
          <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title"><b>Status Seleksi Berkas</b></h4>
                </div>
                <div class="content">
                  <div class="text-center">
                  @if($gub != 'Aktif')
                    <i class="fa fa-clock-o" aria-hidden="true" style="font-size:64px;margin-right:48px;"></i>
                    <p></p>
                    <p>Tahap Seleksi Berkas Belum Dimulai!</p>
                  @else
                    @if ($profile->seleksi->berkas == null)
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:64px;margin-right:48px;"></i>
                      <p></p>
                      <p>Silakan Upload Berkas</p>
                    @elseif ($profile->seleksi->status != 'Verified')
                      <i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size:64px;margin-right:48px;"></i>
                      <p></p>
                      <p>Berkas Belum Divefikasi</p>
                    @else
                      <i class="fa fa-check" aria-hidden="true" style="font-size:64px;margin-right:48px;"></i>
                      <p></p>
                      <p>Attachment has been Verified</p>
                      <a href="{{ asset('storage/upload') }}/{{ $profile->seleksi->berkas }}" class="btn btn-info btn-fill btn-wd">Download</a>
                    @endif
                  @endif
                  </div>
                  <div class="clearfix"></div>
                </form>
                </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title"><b>Hasil Seleksi Berkas</b></h4>
                </div>
                <div class="content text-center {{($profile->seleksi->lolos_berkas != 'Ya' && $gtb == 'Aktif') ? 'text-danger':''}}">
                  @if($gtb != 'Aktif')
                    <i class="fa fa-clock-o" aria-hidden="true" style="font-size:64px;margin-right:48px;"></i>
                    <p></p>
                    <p> Hasil Seleksi Berkas Belum Diumumkan!</p>
                  @else
                    @if ($profile->seleksi->lolos_berkas != 'Ya')
                      <i class="fa fa-times-circle" aria-hidden="true" style="font-size:64px;margin-right:48px;"></i>
                      <p></p>
                      <p>Maaf, Anda tidak lulus dalam Seleksi Berkas. Sampai bertemu di kesempatan lain ya :)</p>
                      <p>Tetap Semangat dan Jangan Lupa berdoa sebelum makan ^^9</p>
                    @else
                      <i class="fa fa-check" aria-hidden="true" style="font-size:64px;margin-right:48px;"></i>
                      <p></p>
                      <p>Selamat, Anda Lolos Tahap Berkas!</p>
                      <p>Tetap Semangat hingga Tahap Akhir ^^</p>
                      <a href="http://bit.ly/TELC-Phase1" class="btn btn-info btn-fill btn-wd" target="_blank">Isi Jadwal Wawancara</a>
                    @endif
                  @endif
                  <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="card">
              <div class="header">
                  <h4 class="title"><b>Hasil Seleksi Wawancara</b></h4>
              </div>
              <div class="content text-center {{($profile->seleksi->lolos_wawancara != 'Ya' && $gtw == 'Aktif') ? 'text-danger':''}}">
                @if($gtw != 'Aktif')
                  <i class="fa fa-clock-o" aria-hidden="true" style="font-size:64px;margin-right:48px;"></i>
                  <p></p>
                  <p> Hasil Seleksi Wawancara Belum Diumumkan!</p>
                @else
                  @if ($profile->seleksi->lolos_wawancara != 'Ya')
                    <i class="fa fa-times-circle" aria-hidden="true" style="font-size:64px;margin-right:48px;"></i>
                    <p></p>
                    <p>Maaf, Anda tidak lulus dalam Seleksi Wawancara. Sampai bertemu di kesempatan lain ya :)</p>
                    <p>Tetap Semangat dan Jangan Lupa berdoa sebelum makan ^^9</p>
                  @else
                    <i class="fa fa-check" aria-hidden="true" style="font-size:64px;margin-right:48px;"></i>
                    <p></p>
                    <p>Selamat, Anda Lolos sebagai anggota TEL-C 4th Generation!</p>
                    <a class="btn btn-info btn-fill btn-wd" href="#info">Informasi First Meet</a>
                  @endif
                @endif
                <div class="clearfix"></div>
              </div>
          </div>
      </div>
    </div>
    @if ($profile->seleksi->lolos_wawancara == 'Ya')
        <div class="row" id="info">
          <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title"><b>Informasi First Meet</b></h4>
                </div>
                <div class="content">
                  <div class="text-center">
                 <i class="fa fa-group" aria-hidden="true" style="font-size:64px;margin-right:48px;"></i>
                 <p></p>
                    <p>Pelaksanaan First Meet 4th Gen TEL-C Research Laboratory akan dilaksanakan pada : </p>
                    <p><i class="fa fa-calendar" aria-hidden="true"></i> : Jumat, 1 Desember 2017 <br></p>
                    <p><i class="fa fa-clock-o" aria-hidden="true"></i> : 08.00 - Selesai <br></p>
                    <p><i class="fa fa-home" aria-hidden="true"></i> : IF3.02.07 / F207 <br></p>
                    <br><br>
                    <p class="text-danger"><b>Note : Diwajibkan hadir untuk seluruh anggota TEL-C Research Laboratory </b></p>
                    <p>Contact Person : fakhrifauzan / alifaazzamii (line)</p>
                  </div>
                  <div class="clearfix"></div>
                </div>
            </div>
          </div>
        </div>
    @endif
</div>
</div>
@endsection
