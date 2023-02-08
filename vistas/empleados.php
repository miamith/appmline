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
if ($_SESSION['empleados']==1)
{
?>
  <!--INICIO  CONTENIDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registro empleados
        <small><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
           <!--Inicio centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Ops</th>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Tel</th>
                            <th>Cargo</th>
                            <th>Rol acceso</th>
                            <th>Salario</th>
                            <th>Login</th>
                            <th>Pais de trabajo</th>
                            <th>Ciudad</th>
                            <th>Dirección</th>
                            <th>Interno?</th>
                            <th>Agencia</th>
                            <th>Creado</th>
                            <th>Fecha</th>
                            <th>Fecha reclutado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Ops</th>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Tel</th>
                            <th>Cargo</th>
                            <th>Rol acceso</th>
                            <th>Salario</th>
                            <th>Login</th>
                            <th>Pais de trabajo</th>
                            <th>Ciudad</th>
                            <th>Dirección</th>
                            <th>Interno?</th>
                            <th>Agencia</th>
                            <th>Creado</th>
                            <th>Fecha</th>
                            <th>Fecha reclutado</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Nombre completo (*)</label>
                            <input type="hidden" name="idempleado" id="idempleado">
                            <input type="text" class="form-control" name="nomcompleto" id="nomcompleto" maxlength="55" placeholder="Nombre del empleado" required>
                          </div>
                           <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>DNI (*):</label>
                            <input onmouseout="validarDIP()" type="number" class="form-control" name="DNIremitente" id="DNIremitente" maxlength="10" placeholder="DNI del empleado" required>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Telefono:</label>
                            <input type="text" class="form-control" name="tel" id="tel" maxlength="22" placeholder="Telefono del empleado">
                          </div>
                           <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Funciones:</label>
                            <input type="text" class="form-control" name="cargo" id="cargo" maxlength="22" placeholder="Cargo del empleado">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12" > 
                            <label>Salario:</label>
                            <input type="text" class="form-control" name="salario" id="salario" maxlength="12" placeholder="Salario" required>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Rol (Tipo usuario):</label>
                            <select  class="form-control selectpicker" data-live-search="true" name="rol" id="rol" >
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="CajeroUV">Cajero UV</option>
                                    <option value="Agencia">Agencia M</option>
                                    <option value="AgenciaS">Agencia S</option>
                                    <option value="Cajero">Cajero</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Login acceso:</label>
                            <input onmouseout="validarAP()" type="text" class="form-control" name="ap" id="ap" maxlength="8" placeholder="Login usuario, Ej. ap001531" required>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Pais de trabajo:</label>
                            <select  class="form-control selectpicker" data-live-search="true" name="pais" id="pais" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Ciudad:</label>
                            <input type="text" class="form-control" name="ciudad" id="ciudad" maxlength="45" placeholder="Ciudad que vive" >
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Dirección:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" maxlength="45" placeholder="Descripción" required>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Trabaja Interno?:</label>
                            <select  class="form-control selectpicker" data-live-search="true" name="interno" id="interno" >
                                    <option value="SI">Interno</option>
                                    <option value="NO">Externo</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Fecha reclutado:</label>
                            <input type="date" class="form-control" name="feinicioempleo" id="feinicioempleo">
                          </div>
                           <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Agencia de trabajo:</label>
                            <select  class="form-control selectpicker" data-live-search="true" name="agenciaA" id="agenciaA" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button onmouseout="validarAP()" class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
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
<script type="text/javascript" src="scripts/empleados.js"></script>
<?php 
}
ob_end_flush();
?>
