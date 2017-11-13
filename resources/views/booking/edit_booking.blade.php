@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-2">
      <div class="panel panel-default">

        <form class="form-horizontal" action='{{route("booking.save")}}' method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name='id' value={{$booking->id}}>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
          <fieldset>
            <div class="form-group">
                <label class="col-lg-2 control-label">
                    Tour Name:
                </label>
                <label class="col-lg-2 control-label">
                    <b>1dayTour_sydney</b>
                </label>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">
                    Tour Date:
                </label>

                <div class="col-lg-6">
                    <select name="tour_date" class="form-control">
                      @foreach($booking->available_dates as $date)    
                      <option value={{date("Y-m-d",strtotime($date->date))}}>{{date("Y-m-d",strtotime($date->date))}}</option>
                      @endforeach
                  </select>
                  <span class="help-block"></span>
              </div>
          </div>
          <div class="form-group ">
            <label class="col-lg-2 control-label">
                Status:
            </label>
            <div class="col-lg-6">
                <select name="status" class="form-control">
                    <option value="0">Cancelled</option>
                    <option value="1">Confirmed</option>
                    <option value="2">Submitted</option>
                </select>
                <span class="help-block"></span>
            </div>
        </div>
        <div class="form-group">
            
            <div class="col-lg-offset-2 col-lg-4">
                <a href="javascript:void(0);" class="btn btn-primary" id="add_passenger_btn">Add
                Passenger</a>
            </div>
        </div>

        <div class="form-group">
         @if($booking->passengers)
         
         <fieldset id="passengers_wrapper">
           @foreach($booking->passengers as $key=>$passenger)
           
           <div class="well well-sm passenger_wrapper">
              
            <input type="hidden" name="passengers[{{$key}}][id]" class="passenger_id_input" value={{$passenger->id}}>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">
                            Given Name:
                        </label>
                        <div class="col-lg-8">
                            <input class="form-control" name="passengers[{{$key}}][given_name]" value={{$passenger->given_name}}>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">
                            Surname:
                        </label>

                        <div class="col-lg-8">
                            <input class="form-control" name="passengers[{{$key}}][surname]" value={{$passenger->surname}}>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">
                            Email:
                        </label>

                        <div class="col-lg-8">
                            <input class="form-control" name="passengers[{{$key}}][email]" value={{$passenger->email}}>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">
                            Mobile:
                        </label>

                        <div class="col-lg-8">
                            <input class="form-control" name="passengers[{{$key}}][mobile]" value={{$passenger->mobile}}>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">
                            Passport:
                        </label>

                        <div class="col-lg-8">
                            <input class="form-control" name="passengers[{{$key}}][passport]" value={{$passenger->passport}}>
                            <span class="help-block"></span>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">
                            Date of Birth:
                        </label>

                        <div class="col-lg-8">
                            <input class="form-control" name="passengers[{{$key}}][birth_date]" value={{date("Y-m-d",strtotime($passenger->birth_date))}} data-provide="datepicker">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">
                            Special Request:
                        </label>

                        <div class="col-lg-9">
                            <input class="form-control" name="passengers[{{$key}}][special_request]" value={{$passenger->pivot['special_request']}}>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <a href="javascript:void(0);" class="btn btn-danger remove_passenger">Remove</a>
                </div>
            </div>
        </div>
        @endforeach
    </fieldset>
    
    @endif
</div>

<div class="form-group">
    <div class="col-lg-5 col-lg-offset-2">
        <a href={{route('booking')}} class="btn btn-default">Cancel</a>
    </div>
    <div class="col-lg-5 text-right">
        <button type="submit" class="btn btn-primary">Submit</button>
        
    </div>
</div>

</fieldset>
</form>
</div>
</div>
</div>
</div>
<script>
   var booking_status= {{$booking->status}}
  //var newIndex
  $(function(){

   


      $("#add_passenger_btn").on('click',function () {
        $("#passengers_wrapper").append(NewPassengerForm());
    });

      $('select[name="status"]').val(booking_status);

      $("body").on("click", ".remove_passenger", function (e) {
        var parentDom=$(this).closest(".passenger_wrapper");
        var id=parentDom.find(".passenger_id_input").val();
        parentDom.remove();
    });



  }); 


</script>
@endsection