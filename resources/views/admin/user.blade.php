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
                        <h4 class="title">Users</h4>
                    </div>
                    <div class="content">
                        <table id="table" class="table table-striped">
                            <thead>
                              <th>NIM</th>
                            	<th>Username</th>
                            	<th>User Level</th>
                            	<th>Action</th>
                            </thead>
                            <tbody>
                              @foreach($user as $view)
                                  <tr>
                                      <td>{{ $view->nim }}</td>
                                      <td>{{ $view->username }}</td>
                                      <td>{{ $view->user_level }}</td>
                                      <td>
                                        @if(Auth::user()->user_level != 'Peserta')
                                          @if((Auth::user()->user_level == 'Super Admin' && $view->user_level == 'Super Admin') || $view->user_level != 'Super Admin')
                                          <button type="button" title="{{ $view->id }}" class="btn btn-warning" data-toggle="modal" onclick="change_pass({{ $view->id }})"><i class="fa fa-key" aria-hidden="true"></i></button>
                                          @endif
                                        @endif
                                        @if(Auth::user()->user_level == 'Super Admin')
                                          @if($view->user_level == 'Admin')
                                          <a class="btn btn-info" title="{{ $view->id }}" href="#"
                                              onclick="event.preventDefault();
                                                       document.getElementById('sa-form-{{ $view->id }}').submit();">
                                              <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                          </a>
                                          <form id="sa-form-{{ $view->id }}" action="{{ route('admin.set.super') }}" method="POST" style="display: none;">
                                            <input type="text" name="id" value="{{ $view->id }}" hidden>
                                            {{ csrf_field() }}
                                          </form>
                                          @endif
                                        @endif
                                        @if($view->user_level == 'Peserta')
                                          <a class="btn btn-info" title="{{ $view->id }}" href="#"
                                              onclick="event.preventDefault();
                                                       document.getElementById('a-form-{{ $view->id }}').submit();">
                                              <i class="fa fa-star" aria-hidden="true"></i>
                                          </a>
                                          <form id="a-form-{{ $view->id }}" action="{{ route('admin.set.admin') }}" method="POST" style="display: none;">
                                            <input type="text" name="id" value="{{ $view->id }}" hidden>
                                            {{ csrf_field() }}
                                          </form>
                                        @endif
                                        @if(Auth::user()->user_level == 'Super Admin' and $view->user_level != 'Super Admin')
                                          <a class="btn btn-danger" title="{{ $view->id }}" href="#"
                                              onclick="event.preventDefault();
                                                       document.getElementById('delete-form-{{ $view->id }}').submit();">
                                              <i class="fa fa-trash" aria-hidden="true"></i>
                                          </a>
                                          <form id="delete-form-{{ $view->id }}" action="{{ route('admin.users.delete') }}" method="POST" style="display: none;">
                                            <input type="text" name="id" value="{{ $view->id }}" hidden>
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                          </form>
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
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" data-backdrop="" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <!-- data-backdrop=""  -->
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- <div class="modal-body"> -->
        <form id="changePassForm">
          {{ csrf_field() }}
          <input id="id" type="number" class="form-cotrol" name="id" hidden required>
          <div class="form-row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control border-input" name="password">
                </div>
            </div>
          </div>
      <!-- </div> -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </div>
    </div>
      </form>
  </div>
</div>
@endsection

@section('content-js')
  <script type="text/javascript">
    $('#changePassModal').on('hide.bs.modal', function (event) {
        $('#changePassForm').removeAttr("action");
        $('#changePassForm').removeAttr("method");
        $("input[name='_method']").remove();
    });

    function change_pass(id) {
        $('#changePassForm')[0].reset(); // reset form on modals
        // $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').hide(); // hide  error string
        $('.modal-title').text('Change Password'); // Set Title to Bootstrap modal title
        $("#changePassForm").attr('action', '{{ url('users/change/password') }}');
        $('#changePassForm').attr('method','post');

        $.get("users/"+id+"/edit", function (response){
            var value = JSON.parse(response);
            $("#id").val(value["id"]);
            $('#changePassModal').modal('show'); // show bootstrap modal
        });
        // $('.modal-backdrop').remove();
    }
  </script>
@endsection
