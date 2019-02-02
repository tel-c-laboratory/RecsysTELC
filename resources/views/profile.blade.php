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
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Profile</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                          {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control border-input" disabled placeholder="Username" name="username" value="{{ $profile->username }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NIM</label>
                                        <input type="text" class="form-control border-input" disabled placeholder="Student's ID" name="nim" value="{{ $profile->nim }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control border-input" placeholder="Email" name="email" value="{{ $profile->email }}" {{($profile->email == null || $profile->email == '') ? 'required':''}}>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control border-input" placeholder="Full Name" name="name" value="{{ $profile->name }}" {{($profile->username == null || $profile->name == '') ? 'required':''}}>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control border-input" placeholder="Home Address" name="alamat" value="{{ $profile->alamat }}" {{($profile->alamat == null || $profile->alamat == '') ? 'required':''}}>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jurusan</label>
                                        <input type="text" class="form-control border-input" placeholder="S1 Teknik Informatika" name="jurusan" value="{{ $profile->jurusan }}" {{($profile->jurusan == null || $profile->jurusan == '') ? 'required':''}}>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fakultas</label>
                                        <input type="text" class="form-control border-input" placeholder="Informatika" name="fakultas" value="{{ $profile->fakultas }}" {{($profile->fakultas == null || $profile->fakultas == '') ? 'required':''}}>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Angakatan</label>
                                        <input type="number" class="form-control border-input" placeholder="2015" name="angkatan" value="{{ $profile->angkatan }}" min="2015" max="2018" {{($profile->angkatan == null || $profile->angkatan == '') ? 'required':''}}>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No Handphone</label>
                                        <input type="number" class="form-control border-input" placeholder="08xxxxxxxxxx" name="phone" value="{{ $profile->phone }}" {{($profile->phone == null || $profile->phone == '') ? 'required':''}}>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ID Line</label>
                                        <input type="text" class="form-control border-input" placeholder="@telclab" name="id_line" value="{{ $profile->id_line }}" {{($profile->id_line == null || $profile->id_line == '') ? 'required':''}}>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Profile Photo</label>
                                        <input type="file" class="form-control border-input" name="photo">
                                        @if ($errors->has('photo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('photo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button>
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
