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
if ($_SESSION['usuarios']==1)
{
?>
  <!--INICIO  CONTENIDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear usuarios y dar permisos
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
                            <th>Nombre</th>
                            <th>Login</th>
                            <th>Rol</th>
                            <th>Permisos</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Creado por</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Login</th>
                            <th>Rol</th>
                            <th>Permisos</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Creado por</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <input type="hidden" name="idempleado" id="idempleado">
                            <label>Empleado:</label>
                              <select class="form-control selectpicker" data-live-search="true" name="ap" id="ap" required>
                              </select>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>AP o Login *:</label>
                            <input type="text" readonly="" class="form-control" name="apU" id="apU" maxlength="20" placeholder="Logion o AP" required>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Clave temporal *:</label>
                            <input type="password" class="form-control" name="password" id="password" maxlength="20" placeholder="Contraseña" required>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Estado:</label>
                            <select class="form-control selectpicker" data-live-search="true" name="condicion" id="condicion" required>
                              <option value="1">Activado</option>
                              <option value="2">Desactivado</option>
                            </select>
                          </div>
						  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Permisos:</label>
                            <ul style="list-style: none;" id="permisos">
                              
                            </ul>
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
<script type="text/javascript" src="scripts/usuarios.js"></script>
<?php 
}
ob_end_flush();
?>