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
          <div class="col-lg-2 col-md-2">
          </div>
          <div class="col-lg-8 col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title"><b>Settings</b></h4>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('admin.setting.update') }}" enctype="multipart/form-data">
                      {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Status Pendaftaran Peserta</b></label>
                                    <select class="form-control" name="status_pendaftaran" required>
                                      <option value="">Choose...</option>
                                        @php ($status = ['Aktif', 'Tidak Aktif'])
                                        @foreach($status as $value)
                                            <option value="{{ $value }}" {{($stp == $value) ? 'selected':''}}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>URL Personal Plan</b></label>
                                    <input type="text" class="form-control" name="url_personal_plan" value="{{ $upp }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Upload Berkas</b></label>
                                    <select class="form-control" name="upload_berkas" required>
                                      <option value="">Choose...</option>
                                        @php ($status = ['Aktif', 'Tidak Aktif'])
                                        @foreach($status as $value)
                                            <option value="{{ $value }}" {{($gub == $value) ? 'selected':''}}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                          <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>URL Paper Review</b></label>
                                    <input type="text" class="form-control" name="url_paper_review" value="{{ $upr }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label><b>Seleksi Tahap Berkas</b></label>
                                  <select class="form-control" name="seleksi_berkas" required>
                                    <option value="">Choose...</option>
                                      @php ($status = ['Aktif', 'Tidak Aktif'])
                                      @foreach($status as $value)
                                          <option value="{{ $value }}" {{($gtb == $value) ? 'selected':''}}>{{ $value }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>URL Tes Online</b></label>
                                    <input type="text" class="form-control" name="url_tes_online" value="{{ $uto }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label><b>Seleksi Tahap Wawancara</b></label>
                                  <select class="form-control" name="seleksi_wawancara" required>
                                    <option value="">Choose...</option>
                                      @php ($status = ['Aktif', 'Tidak Aktif'])
                                      @foreach($status as $value)
                                          <option value="{{ $value }}" {{($gtw == $value) ? 'selected':''}}>{{ $value }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>URL Jadwal Wawancara</b></label>
                                    <input type="text" class="form-control" name="url_jadwal_wawancara" value="{{ $ujw }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info btn-fill btn-wd">Update Settings</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-2">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-2 col-md-2">
          </div>
          <div class="col-lg-8 col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title"><b>Recrutiment Timeline</b></h4>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('admin.setting.update.timeline') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Format dalam bentuk script HTML (MANDATORY)</b></label>
                                    <textarea class="form-control" name="recruitment_timeline" rows="6" required>{{ $rtl }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info btn-fill btn-wd">Update Timeline</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-2">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-2 col-md-2">
          </div>
          <div class="col-lg-8 col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title"><b>Informasi First Meet</b></h4>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('admin.setting.update.firstmeet') }}" enctype="multipart/form-data">
                      {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Hari, Tanggal</b></label>
                                    <input type="text" class="form-control" name="fm_tanggal" value="{{ $fmt }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Waktu</b></label>
                                    <input type="text" class="form-control" name="fm_jam" value="{{ $fmj }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Contact Person</b></label>
                                    <input type="text" class="form-control" name="fm_cp" value="{{ $fmc }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info btn-fill btn-wd">Update Informasi First Meet</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-2">
          </div>
        </div>
</div>
</div>
@endsection
