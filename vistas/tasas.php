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
if ($_SESSION['tasas']==1)
{
?>
  <!--INICIO  CONTENIDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear tasas
        <small><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
           <!--Inicio centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Pais origen</th>
                            <th>Pais destino</th>
                            <th>Descripción</th>
                            <th>[Monto inicial</th>
                            <th>Monto tope]</th>
                            <th>Monto KILO</th>
                            <th>Monto SOBRE</th>
                            <th>Comisión</th>
                            <th>Fecha</th>
                            <th>Creado por</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Pais origen</th>
                            <th>Pais destino</th>
                            <th>Descripción</th>
                            <th>[Monto inicial</th>
                            <th>Monto tope]</th>
                            <th>Monto KILO</th>
                            <th>Monto SOBRE</th>
                            <th>Comisión</th>
                            <th>Fecha</th>
                            <th>Creado por</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Descripción:</label>
                            <input type="hidden" name="idTasas" id="idTasas">
                            <input type="text" class="form-control" name="Descripcion" id="Descripcion" maxlength="20" placeholder="Descripción Ej. De 60,001 a 12000" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>[Monto inicial*:</label>
                            <input type="text" class="form-control" name="Monto1" id="Monto1" maxlength="20" placeholder="Monto 1" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Monto tope]*:</label>
                            <input type="text" class="form-control" name="Monto2" id="Monto2" maxlength="20" placeholder="Monto 2" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Comisión *:</label>
                            <input type="text" class="form-control" name="comisiont" id="comisiont" maxlength="20" placeholder="Comisión por envio" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Monto por KILO :</label>
                            <input type="text" class="form-control" name="MontoKILO" id="MontoKILO" maxlength="20" placeholder="Monto fijo por KILO" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Monto por SOBRE :</label>
                            <input type="text" class="form-control" name="MontoSOBRE" id="MontoSOBRE" maxlength="20" placeholder="Monto fijo por SOBRE" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Pais origen(*):</label>
                            <select class="form-control selectpicker" data-live-search="true" name="pais_origen" id="pais_origen" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Pais destino(*):</label>
                            <select class="form-control selectpicker" data-live-search="true" name="pais_destino" id="pais_destino" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
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
<script type="text/javascript" src="scripts/tasas.js"></script>
<?php 
}
ob_end_flush();
?>
