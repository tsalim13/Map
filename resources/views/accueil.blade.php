@extends('layouts.templateMap')

@section('titrePage') Mapper/ Home @endsection

@section('content')
<br>
<div class="panel panel-widget">
  <div class="form-three widget-shadow">
    <div class=" panel-body-inputin">

    	<div class="row">
    		<div class="col-md-6">
    			 <!--Div that will hold the pie chart-->
    			<div id="chart_div"></div>
    		</div>
    		<div class="col-md-6">
    			 <!--Div that will hold the pie chart-->
    			<div id="chart_div_act"></div>
    		</div>
    	</div>

    </div>
  </div>
</div>



<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChartact);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Client');
        data.addColumn('number', 'Nombre');

        var locationByClient = {!! $co !!};
         locationByClient.forEach(function(lc) {
            //console.log("idc "+lc.client_id+" total "+lc.total);
            data.addRow([""+lc.client_id,lc.total]);
          });


        /*data.addRows([
          ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1],
          ['Zucchini', 1],
          ['Pepperoni', 2]
        ]);*/

        // Set chart options
        var options = {'title':'Location/client Total:',
                       'width':500,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div_act'));
        chart.draw(data, options);
      }

      function drawChartact() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Client');
        data.addColumn('number', 'Nombre');

        var locationByClient = {!! $co_act !!};
         locationByClient.forEach(function(lc) {
            data.addRow([""+lc.client_id,lc.total]);
          });

        // Set chart options
        var options = {'title':'Emplacements actif par client:',
                       'width':500,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

@endsection