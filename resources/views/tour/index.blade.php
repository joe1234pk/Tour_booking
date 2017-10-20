@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-2">
      <div class="panel panel-default">
        <!-- <div class="panel-heading">Dashboard</div> -->
        <div class="panel-body">
          <div style="margin-bottom: 10px;">
            <a href={{route("tour.create")}} class="btn btn-primary">Create New Tour</a>

            <a href={{route("booking")}} class="btn btn-info">View Bookings</a>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="col-lg-2">Tour Id</th>
                <th class="col-lg-8">Tour Name</th>
                <th class="col-lg-2">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tours as $tour)
              @if($tour->status != 0)
              <tr>
                <td>
                 {{$tour->id}}
               </td>
               <td>
                {{$tour->name}}
              </td>
              <td>
                <a href={{route("tour.edit",["tour_id"=>$tour->id])}} class="btn btn-primary">Edit</a>
                <a href={{route("booking.create",["tour_id"=>$tour->id])}} class="btn btn-success">Booking</a>
              </td>
            </tr>
            @endif
            @endforeach
          </tbody>

        </div>  
      </div>
    </div>
  </div>
</div>
@endsection