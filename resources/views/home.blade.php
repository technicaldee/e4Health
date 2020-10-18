@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <h1>Hello,@if(Auth::user()->role == 'Doctor') Dr. @endif {{Auth::user()->name}}</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <form action="{{route('add')}}" method="POST">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tell us why you want to see the Doctor.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        {{@csrf_field()}}
                        <textarea class="form-control" name="description"></textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                </form>
                  </div>
            </div>

            @if(Auth::user()->role == 'Doctor')
                <div class="card">
                    <div class="card-header">{{ __('NOTE!!!') }}</div>

                    <div class="card-body">
                        Hi, you are logged in as a doctor... On normal grounds, you would've waited for an admin to confirm your data and approve it... However, this is a demo.
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <canvas id="myChart" width="400" height="400"></canvas>
                    <hr>
                    Unattended to: {{$u}}
                    <hr>
                    Attended to: {{$a}}
                <script>
                var ctx = document.getElementById('myChart');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Unattended', 'Attended to'],
                        datasets: [{
                            label: 'Complete vs Incomplete',
                            data: [{{$u}}, {{$a}}],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                });
                </script>
                </div>
                <div class="col-md-6">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Description</th>
                          <th scope="col">Status</th>
                          <th scope="col">Time Ago</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($apps as $app)
                        <tr>
                          <th scope="row">{{$app->id}}</th>
                          <td>{{$app->description}}</td>
                          <td>{{$app->status}}</td>
                          <td>{{$app->updated_at}}</td>

                          <td>
                            <center>
                                @if($app->status == 'Complete')
                                    Done
                                @else
                            <form action="{{route('mark')}}" method="POST">{{@csrf_field()}}<button type="submit" name="btn" value="{{$app->id}}" class="btn btn-warning">Mark Complete</button></form>
                        @endif
                    </center></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
                @else

        @if($c != 0)
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Description</th>
                  <th scope="col">Status</th>
                  <th scope="col">Time Ago</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($apps as $app)
                <tr>
                  <th scope="row">{{$app->id}}</th>
                  <td>{{$app->description}}</td>
                  <td>{{$app->status}}</td>
                  <td>{{$app->updated_at}}</td>

                  <td><form action="{{route('del')}}" method="POST">{{@csrf_field()}}<center><button type="submit" name="btn" value="{{$app->id}}" class="btn btn-danger">Cancel</button></center></form></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <hr>
                <center><h4> No Appointments made yet. Use the 'Make Apointment' button </h4>
                <a data-toggle="modal" data-target="#appointmentModal" class="btn btn-success">{{ __('Make Appointment') }}</a>
            </center>
            @endif

            @endif

        </div>
    </div>
</div>
@endsection
