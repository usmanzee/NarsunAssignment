@extends('app')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Devices</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Devices</li>
        </ol>
        <!-- <button type="button" class="btn btn-primary" id="add_device">Add New Device</button><br><br> -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_device_modal" data-whatever="@mdo">Add New Device</button><br><br>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Devices</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Warranty</th>
                                <th>Expiry</th>
                                <th>Cost</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Warranty</th>
                                <th>Expiry</th>
                                <th>Cost</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($devices as $device)
                            <tr>
                                <td>{{ $device->name }}</td>
                                <td><img src="{{ asset('device_images/'.$device->image) }}" id="image_{{ $device->image }}" style="height: 50px; width: 50px;"></td>
                                <td>{{ $device->warranty }}</td>
                                <td>{{ $device->expiry }}</td>
                                <td>{{ $device->cost }}</td>
                                <td>
                                    <button deviceId = "{{ $device->id }}" deviceName="{{ $device->name }}" deviceImage="{{ $device->image }}" deviceWarranty="{{ $device->warranty }}" deviceExpiry="{{ $device->expiry }}" deviceCost="{{ $device->cost }}" class="btn btn-sm btn-primary edit_device_button" type="button" data-toggle="modal" data-target="#add_device_modal">Edit</button>                    
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

<div class="modal fade" id="add_device_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="device_form_title">Add Device</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="add_device_form" method="POST" action="{{ url('devices/add-device') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="form-group">
            <label for="name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="">
          </div>
          <div class="form-group">
            <label for="image" class="col-form-label">Image:</label>
            <input type="file" class="form-control" id="image" name="image">
          </div>
          <div class="form-group">
            <label for="warranty" class="col-form-label">Warranty:</label>
            <input type="text" class="form-control" id="warranty" name="warranty">
          </div>
          <div class="form-group">
            <label for="expiry" class="col-form-label">Expiry:</label>
            <input type="date" class="form-control" id="expiry" name="expiry">
          </div>
          <div class="form-group">
            <label for="cost" class="col-form-label">Cost:</label>
            <input type="text" class="form-control" id="cost" name="cost">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="add_device_button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
@section('scripts')
<script type="text/javascript">

    $('#add_device_button').on('click', function () {
       $('#add_device_form').submit();
    });
    $(".edit_device_button").click(function() {
        $("#device_form_title").text('Edit Device');
        var editUrl = '{{ url('devices/edit-device') }}/'+$(this).attr('deviceId');
        $("#add_device_form").attr('action', editUrl);

        var deviceName = $(this).attr('deviceName');
        var deviceWarranty = $(this).attr('deviceWarranty');
        var deviceExpiry = $(this).attr('deviceExpiry');
        var deviceCost = $(this).attr('deviceCost');

        $('input#name').val(deviceName);
        //console.log($('input#name').val());
        $('input#warranty').val(deviceWarranty);
        $('input#expiry').val(deviceExpiry);
        $('input#cost').val(deviceCost);
    });
</script>
@endsection
@endsection