@extends('layout.newDefault')
@section('content')
@include('layout.newNav')
@include('layout.menu_admin')]
<section id="search" class="color-dark bg-white">
  <div class="container margintop-50 marginbot-50">
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
        <div class="animatedParent">
          <div class="section-heading text-center animated bounceInDown">
            <h2 class="h-bold">Report</h2>
            <div class="divider-header"></div>
            <br>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-xm-12"id="gender_chart" style="height: 500px;"></div>
      <div class="col-lg-8 col-xm-12"id="category_chart" style="height: 500px;"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xm-12"><center>
          <br><br>
          {{ Form::open(array('url' => '/admin/report/update')) }}
              <span> Date </span>
              {{ Form::selectRange( 'day' , 1 , 31 , $day  , array(
                      'class' => 'btn btn-default dropdown-toggle'
                       )) }}
              {{ Form::selectMonth( 'month' , $month , array(
                      'class' => 'btn btn-default dropdown-toggle'
                       )) }}
              {{ Form::selectRange( 'year' , 2020 , 2012 , $year  , array(
                      'class' => 'btn btn-default dropdown-toggle'
                       )) }}
              {{ Form::submit('Submit',array('class'=>'btn btn-success')) }}
          {{ Form::close() }}
          </center>
        </div>
        <div class="col-lg-12 col-xm-12"id="daily_chart" style="height: 500px;"></div>
        <div class="col-lg-12 col-xm-12"id="month_chart" style="height: 500px;"></div>
        <div class="col-lg-12 col-xm-12"id="year_chart" style="height: 500px;"></div>
    </div>
  </div>
  <br><br>
</section>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var dataSet = [
      ['Gender', 'amount'],
      ['Male',    {{ User::where('sex', '=' ,'M' )->count() }}],
      ['Female',  {{ User::where('sex', '=' ,'F' )->count() }}]];
    var data = google.visualization.arrayToDataTable(dataSet);
    var options = {
      title: 'Number of user by gender',
      vAxis: {title: 'Year',  titleTextStyle: {color: 'red'}}
    };
  
    var chart = new google.visualization.PieChart(document.getElementById('gender_chart'));
  
    chart.draw(data, options);
  }
</script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var jsonData = [["Category", "Income"]];
    @foreach($done as $d)
      jsonData.push(["{{ $d->name }}",{{ $d->total }} ]);
    @endforeach
    var data = google.visualization.arrayToDataTable(jsonData);
  
    var options = {
      title: 'Total income by category',
      vAxis: {title: 'income',  titleTextStyle: {color: 'red'}}
    };
  
    var chart = new google.visualization.ColumnChart(document.getElementById('category_chart'));
  
    chart.draw(data, options);
  }
</script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var jsonData = [["Time", "Income"]];
    @foreach($result as $r)
      jsonData.push(["{{ $r->time }}",{{ $r->total }} ]);
    @endforeach
    var data = google.visualization.arrayToDataTable(jsonData);
  
    var options = {
      title: 'Income by hour in day',
      vAxis: {title: 'Income',  titleTextStyle: {color: 'red'}}
    };
  
    var chart = new google.visualization.ColumnChart(document.getElementById('daily_chart'));
  
    chart.draw(data, options);
  }
</script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var jsonData = [["Time", "Income"]];
    @foreach($result1 as $r)
      jsonData.push(["{{ $r->time }}",{{ $r->total }} ]);
    @endforeach
    var data = google.visualization.arrayToDataTable(jsonData);
  
    var options = {
      title: 'Income by day in month',
      vAxis: {title: 'Income',  titleTextStyle: {color: 'red'}}
    };
  
    var chart = new google.visualization.ColumnChart(document.getElementById('month_chart'));
  
    chart.draw(data, options);
  }
</script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var jsonData = [["Time", "Income"]];
    @foreach($result2 as $r)
      jsonData.push(["{{ $r->time }}",{{ $r->total }} ]);
    @endforeach
    var data = google.visualization.arrayToDataTable(jsonData);
  
    var options = {
      title: 'Income by month in year',
      vAxis: {title: 'Income',  titleTextStyle: {color: 'red'}}
    };
  
    var chart = new google.visualization.ColumnChart(document.getElementById('year_chart'));
  
    chart.draw(data, options);
  }
</script>
@endsection