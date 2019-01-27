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
          <div class="col-lg-6 col-md-6">
            <div class="card">
              <div class="header">
                  <h4 class="title"><b>Choose Group</b></h4>
              </div>
              <div class="content">
                <form action="{{ route('seleksi.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                  <select class="form-control" name="peminatan" required>
                    <option value="">Choose...</option>
                      @php ($peminatan = ['Study Group', 'Research Group'])
                      @foreach($peminatan as $value)
                          <option value="{{ $value }}" {{($profile->seleksi->peminatan == $value) ? 'selected':''}} >{{ $value }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-info btn-fill btn-wd">Save</button>
                </div>
                <div class="clearfix"></div>
              </form>
              </div>
          </div>
          </div>
            <div class="col-lg-6 col-md-6">
              <div class="card">
                <div class="header">
                    <h4 class="title"><b>Upload Attachment</b></h4>
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
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title"><b>Attachment Requirements</b></h4>
                </div>
                <div class="content">
                  <h5>Study Group</h5>
                  <ol>
                    <li>Photo 4R</li>
                    <li>Creative CV</li>
                    <li>Motivation Letter</li>
                    <li>Portofolio (Optional)</li>
                    <li>1 Year Personal Plan (<a href="{{ $upp }}" target="_blank">Download Template</a>)</li>
                  </ol>
                  <h5>Research Group</h5>
                  <ol>
                    <li>Photo 4R</li>
                    <li>Creative CV</li>
                    <li>Motivation Letter</li>
                    <li>Portofolio (Optional)</li>
                    <li>1 Year Personal Plan (<a href="{{ $upp }}" target="_blank">Download Template</a>)</li>
                    <li>Paper Review (<a href="{{ $upr }}" target="_blank">Click Here for Details</a>)</li>
                  </ol>
                </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title"><b>Upload Rules</b></h4>
                </div>
                <div class="content text-danger">
                  <ol>
                    <li><h5>File's must be compressed into 1 Archive (.rar)</h5></li>
                    <li><h5>The Archive file size is less than 5120KB</h5></li>
                  </ol>
                </div>
            </div>
          </div>
    </div>
</div>
</div>
@endsection
