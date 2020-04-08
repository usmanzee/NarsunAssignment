@extends('app')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
        <!-- <button type="button" class="btn btn-primary" id="add_device">Add New Device</button><br><br> -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user_modal" data-whatever="@mdo">Add New User</button><br><br>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Users</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>@if($user->device) Taken @else Available @endif</td>
                                <td>
                                    @if($user->device)
                                        <button userId = "{{ $user->id }}" class="btn btn-sm btn-info make_user_available_button" data-toggle="modal" data-target="#make_available_user_modal">Make Available</button>
                                    @else
                                        <button userId = "{{ $user->id }}" type="button" class="btn btn-sm btn-success assign_device_button" data-toggle="modal" data-target="#assignDeviceModal">Assign Device</button>
                                    @endif
                                    <button userId = "{{ $user->id }}" userFirstName="{{ $user->first_name }}" userLastName="{{ $user->last_name }}" class="btn btn-sm btn-primary edit_user_button" type="button" data-toggle="modal" data-target="#add_user_modal">Edit</button>
                                </td>
                            </tr>
                            @endforeach()
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="add_user_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="user_form_title">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="add_user_form" method="POST" action="{{ url('users/add-user') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="form-group">
            <label for="first_name" class="col-form-label">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="">
          </div>
          <div class="form-group">
            <label for="last_name" class="col-form-label">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="add_user_button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

<!-- Devices Modal -->
<div class="modal fade" id="assignDeviceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Assign Device</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="add_user_assigned_device" method="POST" action="{{ url('users/assign_device') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" id="user_id" value="">
            <div class="form-group">
                <label for="device">Select Device</label>
                <select id="device" name="device" class="form-control" required>
                    <option selected disabled>Choose...</option>
                    @foreach($devices as $device)
                        <option value="{{ $device->id }}">{{ $device->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="assign_device_button_submit">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="make_available_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Make user available</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">Are you sure of this action? </div>
        <form class="form-horizontal" id="make_user_available_form" method="POST" action="{{ url('users/make_user_available') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="user_id1" id="user_id1" value="">
        </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        <button type="button" class="btn btn-primary" id="make_user_available_button_submit">YES</button>
    </div>
  </div>
</div>
@section('scripts')
<script type="text/javascript">

    $('#add_user_button').on('click', function () {
       $('#add_user_form').submit();
    });

    $('#assign_device_button_submit').on('click', function () {
       $('#add_user_assigned_device').submit();
    });

    $('#make_user_available_button_submit').on('click', function () {
       $('#make_user_available_form').submit();
    });

    $('.assign_device_button').on('click', function () {
       $("#user_id").val($(this).attr('userId'));
    });

    $('.make_user_available_button').on('click', function () {
       $("#user_id1").val($(this).attr('userId'));
    });

    $(".edit_user_button").click(function() {
        $("#user_form_title").text('Edit User');
        var editUrl = '{{ url('users/edit-user') }}/'+$(this).attr('userId');
        $("#add_user_form").attr('action', editUrl);

        var userFirstName = $(this).attr('userFirstName');
        var userLastName = $(this).attr('userLastName');

        $('input#first_name').val(userFirstName);
        $('input#last_name').val(userLastName);
    });
</script>
@endsection
@endsection