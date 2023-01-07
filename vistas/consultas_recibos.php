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
if ($_SESSION['consultas']==1)
{
?>
  <!--INICIO  CONTENIDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Consultas recibos por fechas y cliente
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
           <!--Inicio centro -->
                    <div class="panel-body table-responsive" id="listadoregistros" style="padding:0px ">

                        <div >
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Fecha de inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Fecha de fin</label>
                            <input type="date" class="form-control" name="fecha_final" id="fecha_final" value="<?php echo date("Y-m-d"); ?>">
                          </div>
                           <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Receptor</label>
                            <select  class="form-control  selectpicker" data-live-search="true" name="DNIremitente" id="DNIremitente" required>
                            </select>
                          </div>
                          
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <button class="btn btn-success" onclick="listar()" >Mostrar</button>
                        </div>

                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Receptor</th>
                            <th>Telefono</th>
                            <th>Monto</th>
                            <th>Codigo</th>
                            <th>Agencia Receptora</th>
                            <th>Remitente</th>
                            <th>Agencia Emisora</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Receptor</th>
                            <th>Telefono</th>
                            <th>Monto</th>
                            <th>Codigo</th>
                            <th>Agencia Receptora</th>
                            <th>Remitente</th>
                            <th>Agencia Emisora</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
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
<script type="text/javascript" src="scripts/consultas_recibos.js"></script>
<?php 
}
ob_end_flush();
?>
