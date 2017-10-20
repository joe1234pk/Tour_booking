@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-2">
      <div class="panel panel-default">
        <!-- <div class="panel-heading">Dashboard</div> -->

        <div class="panel-body">
         <form class="form-horizontal" action='{{route("tour.save")}}' method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <div class="form-group">
            <input type="hidden" name="id" value={{$tour->id}}>
          </div> 
          <div class="form-group ">
            <label class="col-lg-2 control-label">
              Tour Name:
            </label>

            <div class="col-lg-10">
              <input name="name" class="form-control" value={{$tour->name}}>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-lg-2 control-label">
              Itinerary:
            </label>
            <div class="col-lg-10">
              <textarea name="itinerary" class="form-control">{{$tour->itinerary}}</textarea>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-6">
              <h4>Tour available Dates</h4>
            </div>
            <div class="col-lg-6 text-right">
              <a href="javascript:void(0);" class="btn btn-primary" id="add_date_btn">Add Date</a>
            </div>
            <table class="table table-striped table-hover">
             <thead class="bg-success">
              <tr>
                <th class="col-lg-8">Date</th>
                <th class="col-lg-4">Action</th>
              </tr>
            </thead>
            <tbody id="dates_wrapper">

              @foreach($tour->tour_dates as $date)

              <tr class="dates_wrapper" name="tour_dates[{{$date->id}}]">

                <td>
                  <input type="hidden" name="tour_dates[{{$date->id}}][ date]" value={{date("Y-m-d",strtotime($date->date))}}>{{ date("Y-m-d",strtotime($date->date))}}
                </td>
                <td>
                  <input type = "hidden"  name="tour_dates[{{$date->id}}][status]" value={{$date->status}}>
                  @if($date->status != 0)
                  <a href="javascript:void(0);" class="btn btn-danger btn-date-status">Disable</a>
                  @else
                  <a href="javascript:void(0);" class="btn btn-success btn-date-status">Enable</a>
                  @endif

                </td>

              </tr>

              @endforeach

            </tbody>

          </table>
        </div>
        <div class="form-group">
          <div class="col-lg-5 col-lg-offset-2">
            <a href={{route("tour")}} class="btn btn-default">Cancel</a>
          </div>
          <div class="col-lg-5 text-right">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>  
  </div>
</div>
</div>
</div>
<script>   
 $(function(){
    //$( ".datepicker" ).datepicker();

    $('#add_date_btn').on('click',function(){              
      $("#dates_wrapper").append(NewDateForm());

    });

    $('#dates_wrapper').on('click','.remove_date',function(){

      $(this).closest(".date_wrapper").remove();
    });

    $('.btn-date-status').on('click',function(){

     // console.log($(this).closest('input[type="hidden"]')[0]);
     var thisDateStatus = $(this).closest('td').find('input[type="hidden"]').val();
     if(thisDateStatus != 0)
     {
      $(this).closest('td').find('input[type="hidden"]').val(0);
      $(this).removeClass("btn-danger");
      $(this).addClass("btn-success");
      $(this).text("Enable");
    }
    else
    {
      $(this).closest('td').find('input[type="hidden"]').val(1);
      $(this).removeClass("btn-success");
      $(this).addClass("btn-danger")
      $(this).text("Disable");
    }


  });


  }); 

  
</script>

@endsection
