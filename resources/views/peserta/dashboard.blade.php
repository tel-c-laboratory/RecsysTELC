@extends('layouts.template')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ asset('storage/profile') }}/background.jpg"/>
                    </div>
                    <div class="content">
                        <div class="author">
                          <img class="avatar border-white" src="{{ asset('storage/profile') }}/{{ $profile->photo }}" alt="..."/>
                          <h4 class="title">{{ $profile->name }}<br />
                             <a href="#"><small>@ {{ $profile->username }}</small></a>
                          </h4>
                        </div>
                        <p class="description text-center">
                            {{ $profile->nim }} <br>
                            {{ $profile->jurusan }} <br>
                            {{ $profile->fakultas }} <br>
                            {{ $profile->angkatan }} <br>
                        </p>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4">
              <div class="card">
                <div class="header">
                    <h4 class="title">Peminatan</h4>
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
        </div>
    </div>
</div>
@endsection
