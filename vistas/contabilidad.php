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
if ($_SESSION['contabilidad']==1)
{
?>
  <!--INICIO  CONTENIDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registro de la contabilidad
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
                            <th>Concepto</th>
                            <th>Ingresos</th>
                            <th>Gastos</th>
                            <th>Observación</th>
                            <th>Agencia</th>
                            <th>Creado por</th>
                            <th>Fecha creacion</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Concepto</th>
                            <th>Ingresos</th>
                            <th>Gastos</th>
                            <th>Observación</th>
                            <th>Agencia</th>
                            <th>Creado por</th>
                            <th>Fecha creacion</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Concepto u observacion:</label>
                            <input type="hidden" name="iding_gas" id="iding_gas">
                            <input type="text" class="form-control" name="concepto" id="concepto" maxlength="45" placeholder="Concepto contable" required>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12" > 
                            <label>Monto:</label>
                            <input type="number" class="form-control" name="monto" id="monto" maxlength="10" required>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Movimiento:</label>
                            <select class="form-control selectpicker" name="sentido" id="sentido" required>
                              <option value="C">Ingreso</option>
                              <option value="D">Gasto</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha:</label>
                            <input type="date" class="form-control" name="fecrea" id="fecrea" required>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" > 
                            <label>Observación:</label>
                            <input type="text" class="form-control" name="observacion" id="observacion" maxlength="45" placeholder="Observación contable" required>
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
<script type="text/javascript" src="scripts/contabilidad.js"></script>
<?php 
}
ob_end_flush();
?>

