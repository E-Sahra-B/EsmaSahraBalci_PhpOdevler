<?php
require_once 'header.php';
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <?php
                $sehir = "İstanbul";
                $apiKey = "387fdb4c7c24686fc26d09791f00bd89";
                $url = "https://api.openweathermap.org/data/2.5/weather?q=$sehir&lang=tr&units=metric&appid=$apiKey";
                $link = json_decode(file_get_contents($url));
                $derece = round($link->main->temp);
                $havaDurumu = ucwords($link->weather[0]->description);
                ?>
                <div class="tile-stats">
                  <div class="icon"><i style="color:#1abb9c;" class="fa fa-cloud"></i></div>
                  <div style="color:#1abb9c;" class="count"><?= $derece . ' C °'; ?></div>
                  <h3><?= $havaDurumu; ?></h3>
                  <p>İstanbul Hava Durumu</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i style="color:#1abb9c;" class="fa fa-turkish-lira"></i></div>
                  <div style="color:#1abb9c;" class="count">1.234,67</div>
                  <h3>Günlük Satış</h3>
                  <p>Lorem ipsum psdea itgum rixt.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i style="color:#1abb9c;" class="fa fa-check-square-o"></i></div>
                  <div style="color:#1abb9c;" class="count">12.345</div>
                  <h3>Toplam Satış</h3>
                  <p>Lorem ipsum psdea itgum rixt.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i style="color:#1abb9c;" class="fa fa-arrow-circle-up"></i></div>
                  <div style="color:#1abb9c;" class="count">8.615</div>
                  <h3>Toplam Ürün</h3>
                  <p>Lorem ipsum psdea itgum rixt.</p>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-md-12">
                <script type="text/javascript">
                  google.charts.load('current', {
                    'packages': ['geochart'],
                  });
                  google.charts.setOnLoadCallback(drawRegionsMap);

                  function drawRegionsMap() {
                    var data = google.visualization.arrayToDataTable([
                      ['Country', 'Popularity'],
                      ['Germany', 500],
                      ['United States', 300],
                      ['Brazil', 400],
                      ['Canada', 200],
                      ['France', 400],
                      ['Ru', 600],
                      ['Turkey', 1000]
                    ]);
                    var options = {};
                    var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
                    chart.draw(data, options);
                  }
                </script>
                <div id="regions_div" style="width: auto; height: 400px;"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <?php $rakam = 7; ?>
                <script type="text/javascript">
                  google.charts.load("current", {
                    packages: ["corechart"]
                  });
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ['Task', 'Hours per Day'],
                      ['Bilgisayar', <?php echo $rakam; ?>],
                      ['Tablet', <?php echo 4; ?>],
                      ['Cep Telefonu', <?php echo 5; ?>],
                      ['Klavye', <?php echo 3; ?>],
                      ['Mouse', <?php echo 2; ?>]
                    ]);
                    var options = {
                      title: 'Ürünler',
                      pieHole: 0.4,
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                    chart.draw(data, options);
                  }
                </script>
                <div id="donutchart" style="width: auto; height: 400px;"></div>
              </div>
              <div class="col-md-6">
                <script type="text/javascript">
                  google.charts.load("current", {
                    packages: ['corechart']
                  });
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ["Element", "Density", {
                        role: "style"
                      }],
                      ["Eylül", <?php echo 11.614; ?>, "purple"],
                      ["Ekim", <?php echo 9.614; ?>, "silver"],
                      ["Kasım", <?php echo 10.614; ?>, "#1abb9c"],
                      ["Aralık", <?php echo 12.614; ?>, "color: green"]
                    ]);
                    var view = new google.visualization.DataView(data);
                    view.setColumns([0, 1,
                      {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                      },
                      2
                    ]);
                    var options = {
                      title: "Aylık Satışlar",
                      width: 600,
                      height: 400,
                      bar: {
                        groupWidth: "95%"
                      },
                      legend: {
                        position: "none"
                      },
                    };
                    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                    chart.draw(view, options);
                  }
                </script>
                <div id="columnchart_values" style="width: auto; height: 400px;"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <script type="text/javascript">
                  google.charts.load("current", {
                    packages: ["corechart"]
                  });
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ["Element", "Density", {
                        role: "style"
                      }],
                      ["Eylül", <?php echo 997; ?>, "purple"],
                      ["Ekim", <?php echo 897; ?>, "silver"],
                      ["Kasım", <?php echo 1, 297; ?>, "#1abb9c"],
                      ["Aralık", <?php echo 1, 897; ?>, "color: green"]
                    ]);
                    var view = new google.visualization.DataView(data);
                    view.setColumns([0, 1,
                      {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                      },
                      2
                    ]);
                    var options = {
                      title: "Müşteri Sayısı",
                      width: 600,
                      height: 400,
                      bar: {
                        groupWidth: "95%"
                      },
                      legend: {
                        position: "none"
                      },
                    };
                    var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
                    chart.draw(view, options);
                  }
                </script>
                <div id="barchart_values" style="width: auto; height: 300px;"></div>
              </div>
              <div class="col-md-6">
                <script type="text/javascript">
                  google.charts.load('current', {
                    'packages': ['corechart']
                  });
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ['Task', 'Hours per Day'],
                      ['Kod Yazma', <?php echo 8; ?>],
                      ['Araştırma', <?php echo 5; ?>],
                      ['Çalışma', <?php echo 9; ?>],
                      ['Dinlenme', <?php echo 1; ?>],
                      ['Yemek', <?php echo 2; ?>]
                    ]);
                    var options = {
                      title: 'Başlık'
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                  }
                </script>
                <div id="piechart" style="width: auto; height: 400px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Bitiyor -->
    </div>
  </div>
</div>
<!-- /page content -->
<?php require_once 'footer.php'; ?>