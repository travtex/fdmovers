@extends('admin.layout')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Trucks</h3>
          </div>
          <div class="panel-body">
            <table class="table table-hover" id="trucks-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Make/Model/Year</th>
                  <th>VIN</th>
                  <th>Last Service</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($trucks as $truck)
                  <tr>
                    <td>{{ $truck->id }}</td>
                    <td>{{ $truck->model_year }} {{ $truck->make_model }}</td>
                    <td>#{{ $truck->vin }}</td>
                    <td>{{ date('F d, Y', strtotime($truck->serviced_at)) }}</td>
                    <td>
                      <button class="btn btn-xs btn-info showMovers" data-truck="{{$truck->id}}"><em class="fa fa-users"></em> Movers</button>
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
  <div class="modal fade" id="showMoverModal" tabindex="-1" role="dialog">
  <meta name="_token" content="{!! csrf_token() !!}"/>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <table class="table table-hover" id="truckMoveTable">
          <thead>
            <th>ID</th>
            <th>Date</th>
            <th>Location</th>
            <th>Movers</th>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop
@section('scripts')
  <script>
  $(function() {
    $('#trucks-table').DataTable({
      "order":[[3, 'asc']]
    });
    $('.showMovers').on('click', function(e) {
      var moverModal = $('#showMoverModal');
      var truckId = $(this).attr('data-truck');
      e.preventDefault();

      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });

      $.get("/admin/truckinfo/" + truckId, function(data) {
        console.log(data);
        var table = $('#truckMoveTable');
        moverModal.find('.modal-title').text('Moves for Truck #' + truckId);
        $.each(data, function(key, value) {
          var d = new Date(value.completed_at);
          var dateString = (d.getMonth() + 1) + '/' + d.getDate() + '/' + d.getFullYear();
          var movers = "<ul>";

          $.each(value.crew.movers, function(key, value) {
            movers += "<li>" + value.first_name + " " + value.last_name + "</li>";
          });
          
          movers += "</ul>";

          table.find('tbody').append(
              "<tr>" +
                "<td>" + value.id + "</td>" +
                "<td>" + dateString + "</td>" +
                "<td>" + value.location + "</td>" +
                "<td>" + movers +"</td>" +
              "</tr>"
            )
        });       
      });

      moverModal.modal('show');
    });
  });
  </script>
@stop