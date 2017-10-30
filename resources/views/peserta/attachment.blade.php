@extends('layouts.template')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="card">
                <div class="header">
                    <h4 class="title">Upload Attachment</h4>
                </div>
                <div class="content">
                  <form action="{{ route('seleksi.upload')}}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <input type="file" name="berkas" class="form-control border-input" required>
                  </div>
                  @if ($errors->has('berkas'))
                      <span class="help-block">
                          <strong>{{ $errors->first('berkas') }}</strong>
                      </span>
                  @endif
                  <div class="text-center">
                      <button type="submit" class="btn btn-info btn-fill btn-wd">Upload</button>
                  </div>
                  <div class="clearfix"></div>
                </form>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="card">
                <div class="header">
                    <h4 class="title">Attachment Status</h4>
                </div>
                <div class="content">
                  <div class="text-center">
                  @if ($berkas->berkas == null)
                    <i class="ti-alert"></i>
                    <p>Belum Upload</p>
                  @elseif ($berkas->status == 'Belum Diverifikasi')
                    <i class="ti-alert"></i>
                    <p>Belum Divefikasi</p>
                  @else
                    <i class="ti-check"></i>
                    <a href="{{ asset('storage/upload') }}/{{ $berkas->berkas }}" class="btn btn-info btn-fill btn-wd">Download</a>
                  @endif
                  </div>
                  <div class="clearfix"></div>
                </form>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title"><b>Persyaratan Berkas</b></h4>
                </div>
                <div class="content">
                  <h5>Study Group</h5>
                  <ol>
                    <li>CV Kreatif</li>
                    <li>Motivation Letter</li>
                    <li>Personal Plan (Untuk Lab) Selama 1 Tahun</li>
                    <li>Portofolio (Opsional)</li>
                  </ol>
                  <h5>Research Group</h5>
                  <ol>
                    <li>CV Kreatif</li>
                    <li>Motivation Letter</li>
                    <li>Review Paper (Paper akan diberikan dari Lab)</li>
                    <li>Personal Plan (Untuk Lab) Selama 1 Tahun</li>
                    <li>Portofolio (Opsional)</li>
                  </ol>
                </div>
            </div>
          <!-- <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title"><b>Aturan Upload</b></h4>
                </div>
                <div class="content">
                  <h5>Study Group</h5>
                  <ol>
                    <li>CV Kreatif</li>
                    <li>Motivation Letter</li>
                    <li>Personal Plan (Untuk Lab) Selama 1 Tahun</li>
                    <li>Portofolio (Opsional)</li>
                  </ol>
                  <h5>Research Group</h5>
                  <ol>
                    <li>CV Kreatif</li>
                    <li>Motivation Letter</li>
                    <li>Review Paper (Paper akan diberikan dari Lab)</li>
                    <li>Personal Plan (Untuk Lab) Selama 1 Tahun</li>
                    <li>Portofolio (Opsional)</li>
                  </ol>
                </div>
            </div> -->
        </div>
    </div>
  </div>
</div>
@endsection
