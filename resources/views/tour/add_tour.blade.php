@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-2">
      <div class="panel panel-default">
        <!-- <div class="panel-heading">Dashboard</div> -->
        <div class="panel-body">
         <form class="form-horizontal" action='{{route("tour.add")}}' method="POST">
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
          <div class="form-group ">
            <label class="col-lg-2 control-label">
              Tour Name:
            </label>
            <div class="col-lg-10">
              <input name="name" class="form-control" value="">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-lg-2 control-label">
              Itinerary:
            </label>
            <div class="col-lg-10">
              <textarea name="itinerary" class="form-control"></textarea>
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

   $('#add_date_btn').on('click',function(){              
    $("#dates_wrapper").append(NewDateForm());

  });

   $('#dates_wrapper').on('click','.remove_date',function(){

    $(this).closest(".date_wrapper").remove();
  });

 });
 
</script>

@endsection