@extends('app')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Settings</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Settings</li>
        </ol>
        <!-- <button type="button" class="btn btn-primary" id="add_device">Add New Device</button><br><br> -->
        @if(!$settings->count())
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_setting_modal" data-whatever="@mdo">Add New Setting</button><br><br>
        @endif
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Settings</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Setting1</th>
                                <th>Setting2</th>
                                <th>Setting3</th>
                                <th>Setting4</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Setting1</th>
                                <th>Setting2</th>
                                <th>Setting3</th>
                                <th>Setting4</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($settings as $setting)
                            <tr>
                                <td>{{ $setting->setting1 }}</td>
                                <td>{{ $setting->setting2 }}</td>
                                <td>{{ $setting->setting3 }}</td>
                                <td>{{ $setting->setting4 }}</td>
                                <td>
                                    <button settingId = "{{ $setting->id }}" setting1="{{ $setting->setting1 }}" setting2="{{ $setting->setting2 }}" setting3="{{ $setting->setting3 }}" setting4="{{ $setting->setting4 }}" class="btn btn-sm btn-primary edit_setting_button" type="button" data-toggle="modal" data-target="#add_setting_modal">Edit</button>
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

<div class="modal fade" id="add_setting_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="setting_form_title">Add Setting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="add_setting_form" method="POST" action="{{ url('settings/add-setting') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="form-group">
            <label for="setting1" class="col-form-label">Setting1:</label>
            <input type="text" class="form-control" id="setting1" name="setting1" value="">
          </div>
          <div class="form-group">
            <label for="setting2" class="col-form-label">Setting2:</label>
            <input type="text" class="form-control" id="setting2" name="setting2">
          </div>
          <div class="form-group">
            <label for="setting3" class="col-form-label">Setting3:</label>
            <input type="text" class="form-control" id="setting3" name="setting3">
          </div>
          <div class="form-group">
            <label for="setting4" class="col-form-label">Setting4:</label>
            <input type="text" class="form-control" id="setting4" name="setting4">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="add_setting_button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
@section('scripts')
<script type="text/javascript">

    $('#add_setting_button').on('click', function () {
       $('#add_setting_form').submit();
    });
    $(".edit_setting_button").click(function() {
        $("#setting_form_title").text('Edit Setting');
        var editUrl = '{{ url('settings/edit-setting') }}/'+$(this).attr('settingId');
        $("#add_setting_form").attr('action', editUrl);

        var setting1 = $(this).attr('setting1');
        var setting2 = $(this).attr('setting2');
        var setting3 = $(this).attr('setting3');
        var setting4 = $(this).attr('setting4');

        $('input#setting1').val(setting1);
        $('input#setting2').val(setting2);
        $('input#setting3').val(setting3);
        $('input#setting4').val(setting4);
    });
</script>
@endsection
@endsection