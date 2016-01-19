@extends('admin.layout')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Moves</h3>
          </div>
          <div class="panel-body">
            <table id="moves-table" class="table table-hover">
              <thead>
                <tr>
                  <th>Truck ID</th>
                  <th>Crew ID</th>
                  <th>Location</th>
                  <th>Date Completed</th>
                </tr>
              </thead>
              <tbody>
                @foreach($moves as $move)
                  <tr>
                    <td>{{ $move->truck_id }}</td>
                    <td>{{ $move->crew_id }}</td>
                    <td>{{ $move->location }}</td>
                    <td>{{ date('F d, Y', strtotime($move->completed_at)) }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            

          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('scripts')
  <script>
  $(function() {
    $('#moves-table').DataTable({
      "order": [[3, 'asc']]
    });
  });
  </script>
@stop
