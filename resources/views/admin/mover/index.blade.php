@extends('admin.layout')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/css/bootstrap-datepicker3.min.css">
@stop
@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <button class="btn btn-success" data-toggle="modal" data-target="#addMover"><em class="fa fa-plus"></em> Add Mover</button>
        <hr>
        <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="panel-title">Movers</h3>
          </div>
          <div class="panel-body">
            <table class="table table-hover" id="movers-table">
              <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Hire Date</th>
              </thead>
              <tbody>
                @foreach($movers as $mover)
                  <tr>
                    <td>{{ $mover->id }}</td>
                    <td>{{ $mover->getFullNameAttribute() }}</td>
                    <td>{{ $mover->email }}</td>
                    <td>{{ date('F d, Y', strtotime($mover->hired_at)) }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="addMover" tabindex="-1" role="dialog" aria-labelledby="addMoverLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4>Add New Mover</h4>
        </div>
        <div class="modal-body">
          @include('admin.mover._addform')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="submitMover" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@stop

@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/js/bootstrap-datepicker.min.js"></script>
  <script>
  function resetForm() {
    $('#first_name, #last_name, #email, #hired_at').val('');
    $('#submitMover').html('Save changes');
  }
  $(function() {
    $('#movers-table').DataTable({
      "order":[[1, 'asc']]
    });
    $('#hired_at').datepicker({
    });
    $('#submitMover').on('click', function(e) {
      e.preventDefault();
      $('#addMoverForm').submit();
    });
    $('#addMoverForm').on('submit', function(e) {
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
      e.preventDefault();
      var first_name = $('#first_name').val();
      var last_name = $('#last_name').val();
      var email = $('#email').val();
      var hired_at = $('#hired_at').val();
      $.ajax({
        type: "POST",
        url: '/admin/addmover',
        data: {
          'first_name': first_name,
          'last_name': last_name,
          'email': email,
          'hired_at': hired_at
        },
        dataType: 'json',
        beforeSend: function(data) {
          // console.log(data);
          $('#submitMover').html('<em class="fa fa-spinner fa-spin"></em> Sending');
        },
        success: function(data) {
          if(data) {
            var table = $('#movers-table').DataTable();
            var d = new Date(data.hired_at);
            var m_names = new Array("January", "February", "March", 
              "April", "May", "June", "July", "August", "September", 
              "October", "November", "December");
            var dateString = m_names[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
            table.row.add([data.id, data.last_name + ", " + data.first_name, data.email, dateString]).draw();
            $('#addMover').modal('hide');
          }
          resetForm();
        },
        error: function(data) {
          var errors = $.parseJSON(data.responseText);
          resetForm();
          $('#first_name').val(first_name);
          $('#last_name').val(last_name);
          $('#email').val(email);
          $('#hired_at').val(hired_at);
          if(errors) {
            var errorHtml = "<ul>";
            $.each(errors, function(key, value) {
              errorHtml += "<li class='text-danger'>" + value[0] + '</li>';
            });
            errorHtml += "</ul>";
            $('#moverErrors').html(errorHtml);
          }
        }
      });
    });
  });
  </script>
@stop