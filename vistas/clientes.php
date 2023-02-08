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
if ($_SESSION['clientes']==1)
{
?>
  <!--INICIO  CONTENIDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Clientes
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
                             <th>#</th>
                            <th>Nombre completo</th>
                            <th>DNI</th>
                            <th>CUENTA CORRIENTE</th>
                            <th>SALDO</th>                            
                            <th>Telefono</th>
                            <th>Pais</th>
                            <th>Agencia</th>
                            <th>Direccion</th>
                            <th>Estado</th>
                            <th>Creado por</th>
                            <th>Fecha creación</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>#</th>
                            <th>Nombre completo</th>
                            <th>DNI</th>
                            <th>CUENTA CORRIENTE</th>
                            <th>SALDO</th>
                            <th>Telefono</th>
                            <th>Pais</th>
                            <th>Agencia</th>
                            <th>Direccion</th>
                            <th>Estado</th>
                            <th>Creado por</th>
                            <th>Fecha creación</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Nombre completo(*):</label>
                            <input type="hidden" name="modif" id="modif">
                            <input type="text" class="form-control" name="nomcompleto" id="nomcompleto" maxlength="50" placeholder="Nombre completpo" required>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>DNI (*):</label>
                            <input type="text" class="form-control" onmousemove="generarCuentaCliente(value)" onkeypress="generarCuentaCliente(value)" onmouseleave="generarCuentaCliente(value)" name="DNIremitente" id="DNIremitente" maxlength="10" placeholder="DNI del cliente" required>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Telefono (*):</label>
                            <input type="text" class="form-control" name="tel" id="tel" maxlength="22" placeholder="Telefono del cliente">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Pais (*):</label>
                            <select class="form-control selectpicker" data-live-search="true" name="pais" id="pais" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Direccion:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" maxlength="80" placeholder="Direccion del cliente">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Agencia :</label>
                            <select  class="form-control selectpicker" data-live-search="true" name="agencia_cli" id="agencia_cli" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Numero cuenta CORRIENTE:</label>
                            <input type="text" class="form-control" name="ncp" id="ncp" maxlength="40" placeholder="Numero de cuenta" >
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Estado:</label>
                            <select  class="form-control selectpicker" data-live-search="true" name="estado" id="estado" >
                                    <option value="1">Activo</option>
                                    <option value="2">Suspendido</option>
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
<script type="text/javascript" src="scripts/clientes.js"></script>
<?php 
}
ob_end_flush();
?>

