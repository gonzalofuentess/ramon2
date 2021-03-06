<?php
require_once '../static/modelo.php';
$raw = new Consulta();
$uptime = $raw->consultaUptime();
$datos = $raw->consultaSemana();
$resumen = $raw->resumen();
#print_r($resumen);
echo $uptime[0]["resultado"];

function conversorSegundosHoras($tiempo_en_segundos) {
    $horas = floor($tiempo_en_segundos / 3600);
    $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
    $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);

    $hora_texto = "";
    if ($horas > 0) {
        $hora_texto .= $horas . "h ";
    }

    if ($minutos > 0) {
        $hora_texto .= $minutos . "m ";
    }

    if ($segundos > 0) {
        $hora_texto .= $segundos . "s";
    }

    return $hora_texto;
}

#print_r($datos);

$var1 = conversorSegundosHoras($uptime[0]["resultado"]);
if (isset($resumen["silencio"])) {
    $silencio = conversorSegundosHoras($resumen["silencio"]);
    $silencio1 = $resumen["silencio"];
} else {
    $silencio = 0;
    $silencio1 = 0;
}
if (isset($resumen["baja"])) {
    $baja = conversorSegundosHoras($resumen["baja"]);
    $baja1 = $resumen["baja"];
} else {
    $baja = 0;
    $baja1 = 0;
}
if (isset($resumen["alta"])) {
    $alta = conversorSegundosHoras($resumen["alta"]);
} else {
    $alta = 0;
}

?>

<section class="page container">              
    <div class="row">    
        <div class="span16">
            <div class="row">
                <div class="span8">
                    <div class="box" style="max-height: 300px;">
                        <div class="box-header">
                            <i class="icon-bar-chart"></i>
                            <h5>Uptime Acumulado</h5>
                        </div>
                        <div class="box-content">
                            <div id="app"></div>
                        </div>
                    </div>
                </div>
                <div class="span8">
                    <div class="span8">
                        <div class="box">
                            <div class="box-header">
                                <i class="icon-bar-chart"></i>
                                <h5>
                                    Resumen Uptime - Downtime
                                </h5>
                            </div>
                            <div class="box-content box-table">
                                <table id="sample-table" class="table table-hover table-bordered tablesorter">
                                    <thead>
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Tiempo</th>                                     
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>                                         
                                            <td>Uptime</td>
                                            <td><?php echo $var1; ?></td>                                     
                                        </tr>
                                        <tr>
                                            <td>Silencio</td>
                                            <td><?php echo $silencio; ?></td>                                            
                                        </tr>
                                        <tr>
                                            <td>Señal Baja</td>
                                            <td><?php echo $baja; ?></td>                                 
                                        </tr> 
                                        <tr>
                                            <td>Señal Alta</td>
                                            <td><?php echo $alta; ?></td>                                 
                                        </tr>                                                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="page container"> 
    <div class="row">
        <div class="span8">
            <div class="box">
                <div class="box-header">
                    <i class="icon-thumbs-down"></i>
                    <h5>
                        Alertas Última Semana
                    </h5>
                </div>
                <div class="box-content">
                    <div id="barras"></div>                           
                </div>
            </div>
        </div>
    </div>
</section>

<script crossorigin src="../assets/charts/react.production.min.js"></script>
<script crossorigin src="../assets/charts/react-dom.production.min.js"></script>
<script src="../assets/charts/prop-types.min.js">
</script>
<script src="../assets/charts/browser.min.js"></script>

<script src="../assets/charts/apexcharts@latest.js"></script>
<script src="../assets/charts/react-apexcharts.iife.min.js"></script>
<script type="text/babel">

    class PieChart extends React.Component {
      
      constructor(props) {
        super(props);

        this.state = {
          options: {
            labels: ['Señal OK', 'Silencio', 'Señal Baja'],
            colors: ['#1ac810', '#2537ed', '#ef3838'],
            responsive: [{
              breakpoint: 480,
              options: {
                chart: {
                  width: 200
                },
                legend: {
                  position: 'bottom'
                }
              }
            }]
          },
          series: [<?php echo $uptime[0]["resultado"];?>, <?php echo $silencio1; ?>, <?php echo $baja1; ?>],
        }
      }
      render() {
        return (
          <div>
            <div id="chart">
              <ReactApexChart options={this.state.options} series={this.state.series} type="pie" width="380" />
            </div>
            <div id="html-dist">
            </div>
          </div>
        );
      }
    }
    const domContainer = document.querySelector('#app');
    ReactDOM.render(React.createElement(PieChart), domContainer);
  </script>
  <script type="text/babel">
 class BarChart extends React.Component {
      
      constructor(props) {
        super(props);

        this.state = {
          options: {
            plotOptions: {
              bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'	
              },
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              show: true,
              width: 2,
              colors: ['transparent']
            },
            xaxis: {
              categories: [<?php
foreach ($datos as $key => $value) {
    echo "'" . $value["dias"] . "'" . ",";
}
?>],
            },
            yaxis: {
              title: {
                text: 'Alertas'
              }
            },
            fill: {
              opacity: 1
            },
            tooltip: {
              y: {
                formatter: function (val) {
                  return  val + " Alerta"
                }
              }
            }
          },
          series: [{
            name: 'Silencio',
            data: [<?php
foreach ($datos as $key => $value) {
    echo $value["silencio"] . ",";
}
?>]
          }, {
            name: 'Señal',
            data: [<?php
foreach ($datos as $key => $value) {
    echo $value["baja"] . ",";
}
?>]
          }],
        }
      }

      render() {
        return (
          <div>
            <div id="chart">
              <ReactApexChart options={this.state.options} series={this.state.series} type="bar" height="350" />
            </div>
            <div id="html-dist">
            </div>
          </div>
        );
      }
    }

    const domContainer = document.querySelector('#barras');
    ReactDOM.render(React.createElement(BarChart), domContainer);
  
  
  </script>
  

