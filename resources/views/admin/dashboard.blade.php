@extends('layouts.template')

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-sm-4">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-warning text-center">
                                <i class="ti-server"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Total Peserta</p>
                                {{ $count }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-success text-center">
                                <i class="ti-wallet"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Study Group</p>
                                {{ $csg }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-danger text-center">
                                <i class="ti-pulse"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                              <p>Research Group</p>
                              {{ $crg }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ asset('img') }}/honey.jpg"/>
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
            <div class="col-md-8">
              <div class="card">
                  <div class="header">
                      <h2 class="title">Hello, {{ $profile->name }}</h2>
                      <p class="category">User Level : {{ $profile->user_level }}</p>
                  </div>
                  <div class="content">
                    <h4>Recruitment Timeline</h4>
                    <h5><p class="category"><b>3 - 10 November 2017</b></p>Upload Berkas Online</h5>
                    <h5><p class="category"><b>-</b></p>Penguman Seleksi Berkas</h5>
                    <h5><p class="category"><b>13 - 14 November 2017</b></p>Wawancara</h5>
                    <h5><p class="category"><b>27 November 2017</b></p>Penguman Seleksi Akhir</h5>
                  </div>
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
