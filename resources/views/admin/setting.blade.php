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
          <div class="col-lg-3 col-md-3">
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title"><b>Settings</b></h4>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('admin.setting.update') }}" enctype="multipart/form-data">
                      {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">
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
                        </div>
                        <div class="row">
                            <div class="col-md-12">
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
                        </div>
                        <div class="row">
                          <div class="col-md-12">
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
                        </div>
                        <div class="row">
                          <div class="col-md-12">
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
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info btn-fill btn-wd">Update Settings</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
          </div>
    </div>
</div>
</div>
@endsection
