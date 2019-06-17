<?php
require_once '../static/modelo.php';
$raw = new Consulta();
$uptime = $raw->consultaUptime();
$datos = $raw->consultaSemana();
$resumen = $raw->resumen();
$historial = $raw->buscaSenal();

#print_r($historial);
#imprime valores de la base
#foreach ($historial as $in =>$out){    
#    echo $out['valor'];
#}
#    echo $out['registro'];   
#}





#echo join($historial['valor'], ','); 

#print_r($historial);
#echo join($historial['valor'],',');

#print_r(json_encode($historial));
#print_r($historial);
#echo $uptime[0]["resultado"];
#$json = json_encode($datos);
#print_r($json);


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

$salida1=NULL;
foreach ($datos as $key => $value) {
    $salida1 .= $value["silencio"].",";
}

$salida2=NULL;
foreach ($datos as $key => $value) {
    $salida2 .= $value["baja"].",";
}
$salida3 = NULL;
foreach ($datos as $key => $value) {
    $salida3 .= "'".$value["dias"]."'".",";
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
        <div class="span8">
            <div class="box">
                <div class="box-header">
                    <i class="icon-signal"></i>
                    <h5>
                       Señal
                    </h5>
                </div>
                <div class="box-content">
                    <div id="senal"></div>                           
                </div>
            </div>
        </div>
    
    </div>
</section>

<script crossorigin src="../assets/charts/react.production.min.js"></script>
<script crossorigin src="../assets/charts/react-dom.production.min.js"></script>
<script src="../assets/charts/prop-types.min.js">
</script>
<script src="../assets/charts/irregular-data-series.js"></script>
<script src="../assets/charts/browser.min.js"></script>
<script src="../assets/charts/apexcharts@latest.js"></script>
<script src="../assets/charts/react-apexcharts.iife.min.js"></script>
<script type="text/babel">

    class PieChart extends React.Component {
      
      constructor(props) {
        super(props);

        this.state = {
          options: {
            labels: ['Señal OK', 'Silencio', 'Señal Baja','Señal Alta'],
            colors: ['#1ac810', '#2537ed', '#ef3838','#ff9900'],
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
          series: [<?php echo $uptime[0]["uptimetotal"];?>, <?php echo $uptime[0]["silencio"]; ?>, <?php echo $uptime[0]["senalbaja"]; ?>,<?php echo $uptime[0]["senalalta"]; ?>],
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
              categories: [<?php echo $salida3;?>],
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
            data: [<?php echo $salida1; ?>]
          }, {
            name: 'Señal',
            data: [<?php echo $salida2;?>]
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
  
  <script type="text/babel">

   
    var dates = [];

    <?php 
    
    
    foreach ($historial as $in =>$out){  ?>  
    
    var innerArr =[Date.parse('<?php echo $out['registro']; ?>'), <?php echo $out['valor'];?>];   
     dates.push(innerArr);
     console.log(innerArr);
    
    <?php }    ?>
        
     
     
     
    //var ts2 = 1484418600000;
    //var dates = [Date.parse('<php echo join($historial['registro'],','); ?>')];
    //var valor = [' echo join($historial['valor'],','); ?>'];
    //console.log(dates);
   
    class LineChart extends React.Component {
      
      constructor(props) {
        super(props);

        this.state = {
          options: {
            chart: {
              stacked: false,
              zoom: {
                type: 'x',
                enabled: true
              },
              toolbar: {
                autoSelected: 'zoom'
              }
            },
            plotOptions: {
              line: {
                curve: 'smooth',
              }
            },
            dataLabels: {
              enabled: true
            },

            markers: {
              size: 0,
              style: 'full',
            },
            //colors: ['#0165fc'],
            title: {
              text: 'Historial de la Señal',
              align: 'left'
            },
            fill: {
              type: 'gradient',
              gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.5,
                opacityTo: 0,
                stops: [0, 90, 100]
              },
            },
            yaxis: {
              min: 0,
              max: 70,              
              title: {
                text: 'Nivel'
              },
            },
            xaxis: {             
               type: 'datetime',          
            },

            tooltip: {
              shared: false,            
            }
          },
          series: [{
            name: 'Señal',
            data: dates
          }],
        }
      }

      render() {

        return (
          <div>
            <div id="chart">
              <ReactApexChart options={this.state.options} series={this.state.series} type="area" height="350" />
            </div>
            <div id="html-dist">
            </div>
          </div>
        );
      }
    }

    const domContainer = document.querySelector('#senal');
    ReactDOM.render(React.createElement(LineChart), domContainer);

  </script>
