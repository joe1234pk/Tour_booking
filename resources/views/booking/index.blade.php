@extends('layouts.app')

@section('content')
 <div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-2">
      <div class="panel panel-default">
        <div style="margin-bottom: 10px;">
        <a href={{route("tour")}} class="btn btn-success pull-right">Tours</a>
    </div>

    <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="col-lg-1">Booking Id</th>
                <th class="col-lg-4">Tour Name</th>
                <th class="col-lg-3">Tour Date</th>
                <th class="col-lg-3">Number of Passengers</th>
                <th class="col-lg-1">Actions</th>
            </tr>
            </thead> 
                    @if($bookings) 
            <tbody>

                   
                     @foreach($bookings as $booking)  
                     <tr>
                    <td>
                        {{$booking->id}} 
                    </td>
                    <td>
                        {{$booking->tour->name}} 
                    </td>
                    <td>
                       {{$booking->tour_date}}
                    </td>
                    <td>
                        {{$booking->passengers_count}}
                    </td>
                    <td>
                        <a href={{route("booking.edit",["tour_id"=>$booking->id])}} class="btn btn-primary">Edit</a>
                    </td>
                    </tr>
                     @endforeach
                
            </tbody>
                           
               @endif           
                    </table>

</div>
</div>
</div>
</div>

@endsection
