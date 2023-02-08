<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
if ($_SESSION['escritorio']==1)
{
?>
  <!--INICIO  CONTENIDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Escritorio
        <small>Estadisticas</small>
      </h1>
    </section>

<?php
    require_once "../modelos/class_Consultas.php";
    $cons = new Consulta();
   
    
  
// TODO PROCEDE DE LAS FUNCIONES CREADAS EN class_Consultas
    $rspta = $cons->totalenvios($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
    $reg = $rspta->fetch_object();
    $tot_envios=$reg->monto;

    $rspta=$cons->totalenviosHOY($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
    $reg = $rspta->fetch_object();
    $tot_enviosHOY=$reg->monto;

    $rspta=$cons->totalrecibos($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
    $reg = $rspta->fetch_object();
    $tot_recibos=$reg->monto;

    $rspta=$cons->totalrecibosHOY($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
    $reg = $rspta->fetch_object();
    $tot_recibosHOY=$reg->monto;

    $rspta=$cons->totalcomisionesMLINE($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
    $reg = $rspta->fetch_object();
    $tot_comisionesMLINE=$reg->monto;

    $rspta=$cons->totalcomisionesEnvio($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
    $reg = $rspta->fetch_object();
    $tot_comisionesEnvio=$reg->monto;

    $rspta=$cons->totalcomisionesRetitos($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
    $reg = $rspta->fetch_object();
    $tot_comisionesRetiros=$reg->monto;

    $rspta=$cons->totalcomisionesHOYEnvios($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
    $reg = $rspta->fetch_object();
    $tot_comisionesHOYEnvios=$reg->monto;

    $rspta=$cons->totalcomisionesHOYRetiros($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
    $reg = $rspta->fetch_object();
    $tot_comisionesHOYRetiros=$reg->monto;


    $rspta=$cons->totalcomisionesGENERALES($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
    $reg = $rspta->fetch_object();
    $tot_comisionesGENERALES=$reg->monto;

    $rspta=$cons->totalIVA();
    $reg = $rspta->fetch_object();
    $tot_IVA=$reg->monto;

// CUENTA DE CAPITAL SALDO
    $rspta=$cons->totalSaldoCAPITAL();
    $reg = $rspta->fetch_object();
    $tot_saldo_CAPITAL=$reg->monto;


    // Datos para mostrar en el grafico de enviosUlt10dias || fecha,total
     $rspta=$cons->totalenviosUltimos_10dias($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
     $fechaE='';
     $totalE='';
       while ($reg = $rspta->fetch_object())
        {
          $fechaE=$fechaE.'"'.$reg->fecha.'",';
          $totalE=$totalE.'"'.$reg->total.'",';
        }
    // Quitamos la ultima oma
        $fechaE=substr($fechaE,0,-1);
        $totalE=substr($totalE,0,-1);


    // Datos para mostrar en el grafico de recibosUlt10dias || fecha,total
     $rspta=$cons->totalrecibosUltimos_10dias($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
     $fechaR='';
     $totalR='';
       while ($reg = $rspta->fetch_object())
        {
          $fechaR=$fechaR.'"'.$reg->fecha.'",';
          $totalR=$totalR.'"'.$reg->total.'",';
        }
    // Quitamos la ultima oma
        $fechaR=substr($fechaR,0,-1);
        $totalR=substr($totalR,0,-1);




    // Datos para mostrar en el grafico de enviosUlt10dias || nomcompleto,total
  /*    $rspta=$cons->ClientesMasEnvios();
     $nomcompleto='';
     $total='';
       while ($reg = $rspta->fetch_object())
        {
          $nomcompleto=$nomcompleto.'"'.$reg->nomcompleto.'",';
          $total=$total.'"'.$reg->total.'",';
        }
    // Quitamos la ultima oma
        $nomcompleto=substr($nomcompleto,0,-1);
        $total=substr($total,0,-1);

   // Datos para mostrar en el grafico de CompaniaMasBilletes || nomcompleto,total
    $rspta=$cons->CompaniaMasBilletes();
     $company='';
     $totalB='';
       while ($reg = $rspta->fetch_object())
        {
          $company=$company.'"'.$reg->company.'",';
          $totalB=$totalB.'"'.$reg->totalB.'",';
        }
    // Quitamos la ultima oma
        $company=substr($company,0,-1);
        $totalB=substr($totalB,0,-1);
*/


 ?>
    <!-- Main content -->
    <section class="content container-fluid">
           <!--Inicio centro -->
                    <div class="panel-body table-responsive">
                      <div class="col-lg-2 col-xs-6">
                          <div class="small-box bg-aqua">
                            <div class="inner">
                              <h4 style="font-size:17px;"><strong><?php echo number_format($tot_envios, 0, '', '.'); ?> FCFA</strong></h4>
                              <p>Total envios</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-bag"></i>
                            </div>
                            <a href="consultas_envios.php" class="small-box-footer">Envios <i class="fa fa-arrow-circle-right"></i></a>
                          </div>
                      </div>

                      <div class="col-lg-2 col-xs-6">
                          <!-- small box -->
                          <div class="small-box bg-green">
                            <div class="inner">
                              <h4 style="font-size:17px;"><strong><?php echo number_format($tot_enviosHOY, 0, '', '.'); ?> FCFA</strong></h4>
                              <p>Total envios HOY</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="consultas_envios.php" class="small-box-footer">Envios <i class="fa fa-arrow-circle-right"></i></a>
                          </div>
                          
                      </div>

                      <div class="col-lg-2 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                          <div class="inner">
                            <h4 style="font-size:17px;"><strong><?php echo number_format($tot_recibos, 0, '', '.'); ?> FCFA</strong></h4>
                            <p>Total retiros</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                          </div>
                          <a href="consultas_recibos.php" class="small-box-footer">Retiros <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>

                      <div class="col-lg-2 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                          <div class="inner">
                            <h4 style="font-size:17px;"><strong><?php echo number_format($tot_recibosHOY, 0, '', '.'); ?> FCFA</strong></h4>
                            <p>Total retiros HOY</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                          </div>
                          <a href="consultas_recibos.php" class="small-box-footer">Recibos <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>


                      <div class="col-lg-2 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-blue">
                          <div class="inner">
                            <h4 style="font-size:17px;"><strong><?php echo number_format($tot_comisionesMLINE, 0, '', '.'); ?> FCFA</strong></h4>
                            <p>Total comisiones</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                          </div>
                          <a href="consultas_envios.php" class="small-box-footer">Comisiones <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>

                      <div class="col-lg-2 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-blue">
                          <div class="inner">
                            <h4 style="font-size:17px;"><strong><?php echo number_format($tot_comisionesEnvio, 0, '', '.'); ?> FCFA</strong></h4>
                            <p>Total comisiones Envios</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                          </div>
                          <a href="consultas_envios.php" class="small-box-footer">Comisiones <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>

                      
                      <div class="col-lg-2 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-blue">
                          <div class="inner">
                            <h4 style="font-size:17px;"><strong><?php echo number_format($tot_comisionesRetiros, 0, '', '.'); ?> FCFA</strong></h4>
                            <p>Total comisiones Retiros</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                          </div>
                          <a href="consultas_envios.php" class="small-box-footer">Comisiones <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>

                      <div class="col-lg-2 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-purple">
                          <div class="inner">
                            <h4 style="font-size:17px;"><strong><?php echo number_format($tot_comisionesHOYEnvios, 0, '', '.'); ?> FCFA</strong></h4>
                            <p>Comisiones HOY Envios</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                          </div>
                          <a href="consultas_envios.php" class="small-box-footer">Comisiones <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>

                      
                      <div class="col-lg-2 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-purple">
                          <div class="inner">
                            <h4 style="font-size:17px;"><strong><?php echo number_format($tot_comisionesHOYRetiros, 0, '', '.'); ?> FCFA</strong></h4>
                            <p>Comisiones HOY Retiros</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                          </div>
                          <a href="consultas_envios.php" class="small-box-footer">Comisiones <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>


                      <div class="col-lg-2 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-purple">
                          <div class="inner">
                            <h4 style="font-size:17px;"><strong><?php echo number_format($tot_comisionesGENERALES, 0, '', '.'); ?> FCFA</strong></h4>
                            <p>Comisiones GLOB</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                          </div>
                          <a href="consultas_envios.php" class="small-box-footer">Comisiones <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>        

                      <div class="col-lg-2 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-blue">
                          <div class="inner">
                            <h4 style="font-size:17px;"><strong><?php echo number_format($tot_IVA, 0, '', '.'); ?> FCFA</strong></h4>
                            <p>IVA</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                          </div>
                          <a href="consultas_envios.php" class="small-box-footer">Comisiones <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>

                      <div class="col-lg-2 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                          <div class="inner">
                            <h4 style="font-size:17px;"><strong><?php echo number_format($tot_saldo_CAPITAL, 0, '', '.'); ?> FCFA</strong></h4>
                            <p>CAPITAL</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                          </div>
                          <a href="consultas_envios.php" class="small-box-footer">Comisiones <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>


                    </div>

            <div class="panel-body" style="height: 400px;" >  <!-- Graficos -->

          <!--        <div class="col-md-6">

                           BAR CHART 
                      <div class="box box-success">
                        <div class="box-header with-border">
                          <h3 class="box-title" style="font-size:17px;">Clientes con mas envios</h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div>
                        <div class="box-body">
                          <div class="chart">
                            <canvas id="ClientesMasEnvios" style="height: 257px; width: 515px;" width="515" height="257"></canvas>
                          </div>
                        </div> /.box-body 
                      </div> /.box 
              </div> -->
           <!--  <div class="col-md-6">
                       <div class="box box-danger">
                        <div class="box-header with-border">
                          <h3 class="box-title" style="font-size:17px;">Compañia de billetes mas vendidos</h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div>
                        <div class="box-body">
                            <canvas id="CompaniaMasBilletes" style="height: 257px; width: 515px;" width="515" height="257"></canvas>
                        </div> /.box-body 
                      </div>

                    </div>  -->
              
            <div class="col-md-6">
              <!-- BAR CHART -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-size:17px;">Recibos ultimos 10 días</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="recibosUlt10dias" style="height: 230px; width: 495px;" width="495" height="230"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>

            <div class="col-md-6">
              <!-- BAR CHART -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-size:17px;">Envios ultimos 10 días</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="enviosUlt10dias" style="height: 230px; width: 495px;" width="495" height="230"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>

            </div>
                    <!--Fin centro -->
</section>
    <!-- /.content -->
  </div>
  <!-- FIN CONTENIDO -->

<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="scripts/escritorio.js"></script>
<script src="../public/dist/js/Chart.min.js"></script>
<script src="../public/dist/js/Chart.bundle.min.js"></script>
<script type="text/javascript">
  
// Clientes con mas envios
// For a pie chart
/* var ctx = document.getElementById('ClientesMasEnvios').getContext('2d');
var ClientesMasEnvios = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [<?php echo $nomcompleto; ?>],
        datasets: [{
            label: '# "20 Clientes con mas envios"',
            data: [<?php echo $total; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 55, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 22, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 55, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 22, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 12, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 80, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 12, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 80, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    
});

// Cmpañias con mas billetes
// For a pie chart
var ctx = document.getElementById('CompaniaMasBilletes').getContext('2d');
var CompaniaMasBilletes = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [<?php echo $company; ?>],
        datasets: [{
            label: '# "20 Clientes con mas envios"',
            data: [<?php echo $totalB; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 55, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 22, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 55, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 22, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 12, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 80, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 12, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 80, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    
});
 */

// Envios ultimos 10 dias
var ctx = document.getElementById('enviosUlt10dias').getContext('2d');
var enviosUlt10dias = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechaE; ?>],
        datasets: [{
            label: '# Envios en FCFA de los ultimos 10 dias',
            data: [<?php echo $totalE; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

// Recibos ultimos 10 dias
var ctx = document.getElementById('recibosUlt10dias').getContext('2d');
var recibosUlt10dias = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechaR; ?>],
        datasets: [{
            label: '# Recibos en FCFA de los ultimos 10 dias',
            data: [<?php echo $totalR; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
<?php 
}
ob_end_flush();
?>
