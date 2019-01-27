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
                        <h4 class="title">Recruitments</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="{{ route('admin.seleksi.set') }}">
                        {{ csrf_field() }}
                        <table id="table" class="table table-striped">
                            <thead>
                              <th></th>
                              <th>NIM</th>
                            	<th>Nama</th>
                              <th>Angkatan</th>
                              <th>Peminatan</th>
                            	<th>Berkas</th>
                            	<th>Verifikasi</th>
                              <th>Lolos Berkas</th>
                              <th>Lolos Wawancara</th>
                            </thead>
                            <tbody>
                              @foreach($seleksi as $view)
                                  <tr>
                                      <td><input type="checkbox" name="id[]" value="{{ $view->id }}" class="form-control" style="width:25px; height:25px;"></td>
                                      <td>{{ $view->nim }}</td>
                                      <td>{{ $view->name }}</td>
                                      <td>{{ $view->angkatan }}</td>
                                      <td>{{ $view->seleksi->peminatan }}</td>
                                      @if ($view->seleksi->status == 'Verified')
                                      <td>
                                        <a class="btn btn-info" href="{{ asset('storage/upload') }}/{{ $view->seleksi->berkas }}">
                                          <i class="fa fa-download" aria-hidden="true"></i>
                                        </a>
                                      </td>
                                      <td>
                                        Verified
                                      </td>
                                      @elseif($view->seleksi->berkas != null)
                                        <td>
                                          <a class="btn btn-info" href="{{ asset('storage/upload') }}/{{ $view->seleksi->berkas }}">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                          </a>
                                        </td>
                                        <td>
                                          <a class="btn btn-warning" href="#"
                                              onclick="event.preventDefault();
                                                       document.getElementById('verifikasi-form-{{ $view->id }}').submit();">
                                              <i class="fa fa-check" aria-hidden="true"></i>
                                          </a>
                                        </td>
                                      @else
                                        <td>
                                          <button type="button" class="btn btn-warning" data-toggle="modal" onclick="status_upload()"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </td>
                                        <td>
                                        </td>
                                      @endif
                                      <td>
                                        @if($view->seleksi->lolos_berkas != 'Ya')
                                          <button type="button" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        @else
                                          <button type="button" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></button>
                                        @endif
                                      </td>
                                      <td>
                                        @if($view->seleksi->lolos_wawancara != 'Ya')
                                          <button type="button" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        @else
                                          <button type="button" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></button>
                                        @endif
                                      </td>
                                  </tr>
                              @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
          <div class="row">
            <div class="card">
              <div class="header">
                  <h4 class="title">Ubah Status Seleksi</h4>
              </div>
              <div class="content text-center">
                <div class="form-group">
                  <select class="form-control" name="status" required>
                    <option value="">Choose...</option>
                      @php ($status = ['Lolos Seleksi Berkas', 'Lolos Seleksi Wawancara'])
                      @foreach($status as $value)
                          <option value="{{ $value }}" >{{ $value }}</option>
                      @endforeach
                  </select>
                </div>
                <button type="submit" class="btn btn-info btn-fill btn-wd">Save</button>
                <div class="clearfix"></div>
              </div>
            </div>
            </form>
          </div>
        </div>
    </div>
</div>

@foreach($seleksi as $view)
  @if($view->seleksi->berkas != null && $view->seleksi->status != 'Verified')
    <form id="verifikasi-form-{{ $view->id }}" action="{{ route('admin.seleksi.verifikasi') }}" method="POST" style="display: none;">
      <input type="number" name="id" value="{{ $view->id }}" hidden>
      {{ csrf_field() }}
    </form>
  @endif
@endforeach

@endsection

<script>
  function status_upload() {
    alert('Berkas belum di upload!');
  }
</script>
