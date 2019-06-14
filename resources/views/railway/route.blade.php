<!DOCTYPE html>
<html>
<head>
	<title>Railway Route</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>

	<div class="container">
	<div class="row">
    @if($errors->has())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
    @endif
    <div class="col-md-12">
      <form action="{{ route('getTrainroutes') }}" method="post">
        @csrf()
        <div class="form-group">
          <label for="train_number">Train Number</label>
          <input type="text" class="form-control" id="train_number" name="train_number" placeholder="Train Number">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    <div class="col-md-12">
      <h1> @if (!empty($response)) {{$response->train->name}} -- {{$response->train->number}} @endif</h1>
    <div class="span5">
          @if (!empty($response))
            <table class="table table-striped table-condensed">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Station name(code)</th>
                    <th>Arrives</th>
                    <th>Departs</th>
                    <th>Distance travelled</th>
                    <th>Stop time</th>
                    <th>Day</th>
                    <th>Route</th>                                         
                  </tr>
              </thead>   
              <tbody>
                @foreach ($response->route as $key => $value)
                @php
                  $Departure_Time=$value->scharr;//Set Departure time
                  $Arrival_Time=$value->schdep;//Set Arrival time
                  $dayDifference=0;//You can modify this 
                  /**/
                  /*$a=strtotime($Departure_Time);
                  $b=strtotime($Arrival_Time.' + '.($dayDifference*24).' Hours');
                  $interval = ($b - $a) / 60;
                  $traveltime=date("i:s",$interval);*/
                  $to_time = strtotime($Arrival_Time);
                  $from_time = strtotime($Departure_Time);
                  $traveltime = round(abs($to_time - $from_time) / 60,2). " minute";
                @endphp
                <tr>
                    <td>{{$value->no}}</td>
                    <td>{{$value->station->name}}({{$value->station->code}})</td>
                    <td>{{$value->scharr}}</td>
                    <td>{{$value->schdep}}</td>
                    <td>{{$value->distance}} km</td>
                    <td>{{$traveltime}}</td>                                                          
                    <td>{{$value->day}}</td>                                                          
                    <td>{{$value->day}}</td>                                                          
                </tr>                                   
                @endforeach
              </tbody>
            </table>
            @endif
            </div>
  
    </div>
    </div>
</div>
</body>
</html>