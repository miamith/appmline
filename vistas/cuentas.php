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
if ($_SESSION['cuentas']==1)
{
?>
  <!--INICIO  CONTENIDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cuentas
        <?php if($_SESSION['rol'] !='Agencia' || $_SESSION['rol']!='CajeroUV' )  { ?>
            <small><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></small>
        <?php } ?>
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
                            <th>Nombre cliente</th>
                            <th>Nº DE CUENTA</th>
                            <th>Tipo</th>
                            <th>SALDO</th>                            
                            <th>AGENCIA MASTER</th>
                            <th>Gestor</th>
                            <th>Pais</th>
                            <th>Telefono</th>
                            <th>Cuenta cerrada</th>
                            <th>Fecha movi</th>
                            <th>Creado por</th>
                            <th>Fecha creación</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                            <th>#</th>
                            <th>Nombre cliente</th>
                            <th>Nº DE CUENTA</th>
                            <th>Tipo</th>
                            <th>SALDO</th>                            
                            <th>AGENCIA MASTER</th>
                            <th>Gestor</th>
                            <th>Pais</th>
                            <th>Telefono</th>
                            <th>Estado</th>
                            <th>Fecha movi.</th>
                            <th>Creado por</th>
                            <th>Fecha creación</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                            
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <?php if($_SESSION['rol'] !='Agencia') { // VALIDACION DE ROLES ?>
                                <button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                          <?php  } ?>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                          
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Nombre cliente o Gerente (*) :</label>
                            <select  class="form-control selectpicker" data-live-search="true" name="cliente" id="cliente" required>
                            </select>
                            <input type="hidden" name="modif" id="modif">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Tipo de cuenta (*):</label>
                            <select  onchange="generarCuentaClienteNCP(value)" class="form-control selectpicker" data-live-search="true" name="tipo_cuenta" id="tipo_cuenta" >
                                    <option value="CUENTA_CORRIENTE">ELIJE TIPO DE CUENTA</option>  
                                    <option value="CUENTA_CORRIENTE">CUENTA CORRIENTE</option>
                                    <option value="CUENTA_AHORRO">CUENTA DE AHORROS</option>
                                    <option value="CUENTA_AGENCIA">CUENTA DE AGENCIA</option>
                                    <option value="CUENTA_COMISIONES">CUENTA DE COMISIONES</option>
                                    <option value="CUENTA_GASTOS">CUENTA DE GASTOS</option>
                                    <option value="CUENTA_CAPITAL">CUENTA DE CAPITAL</option>
                                    <option value="CUENTA_PERDIDAS">CUENTA DE PERDIDAS</option>
                                    <option value="CUENTA_IVA">CUENTA DE IVA</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Numero de CUENTA :</label>
                            <input type="text" class="form-control" name="numerocuenta" id="numerocuenta" maxlength="40" placeholder="Numero de cuenta" readonly required>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>SALDO:</label>
                            <input type="text" class="form-control" name="saldo" id="saldo" maxlength="40" placeholder="Saldo de la cuenta" readonly>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Agencia Master Ligada :</label>
                            <select  class="form-control selectpicker" data-live-search="true" name="agencialigada" id="agencialigada" >
                            </select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Gestor :</label>
                            <select  class="form-control selectpicker" data-live-search="true" name="gestor" id="gestor" >
                            </select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Cuenta cerrada :</label>
                            <select  class="form-control selectpicker" data-live-search="true" name="cuenta_cerrada" id="cuenta_cerrada" >
                                    <option value="NO">NO</option>
                                    <option value="SI">SI</option>
                            </select>
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
<script type="text/javascript" src="scripts/cuentas.js"></script>
<?php 
}
ob_end_flush();
?>

