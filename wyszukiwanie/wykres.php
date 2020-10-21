<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    //
    //
    //
    // link do modyfikacji wykresu
    // https://developers.google.com/chart/interactive/docs/gallery/linechart
    //
    //
    //

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'kg');
        data.addRows([
          ['Dzień 1', 80],
          ['Dzień 2', 79],
          ['Dzień 3', 79],
          ['Dzień 4', 78.5],
          ['Dzień 5', 78]
          
        ]);

        // Set chart options
        var options = {'title':'Zmiana wagi:',
                       'width':500,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>