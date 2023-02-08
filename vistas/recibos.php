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
if ($_SESSION['recibos']==1)
{
?>
  <!--INICIO  CONTENIDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Retirar efectivo
        <small><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Buscar codigo</button></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
           <!--Inicio centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Receptor</th>
                            <th>Telefono</th>
                            <th>Monto</th>
                            <th>Cobrar</th>
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
                            <th>Opciones</th>
                            <th>Receptor</th>
                            <th>Telefono</th>
                            <th>Monto</th>
                            <th>Cobrar</th>
                            <th>Codigo</th>
                            <th>Agencia Receptora</th>
                            <th>Remitente</th>
                            <th>Agencia Emisora</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Nombre Receptor:</label>
                            <input type="hidden" name="idtransaccion" id="idtransaccion">
                            <input type="hidden" name="idreceptor" id="idreceptor">
                            <input type="hidden" name="idbkhis" id="idbkhis">
                            <input type="text" readonly="" class="form-control" name="nombrereceptor" id="nombrereceptor" maxlength="100" placeholder="Nombre del receptor" required>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Codigo de envio:</label>
                            <input type="text" class="form-control" name="codigo" id="codigo" maxlength="10" placeholder="Buscar codigo" required>
                          </div>

                          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                          <label>Buscar</label>
                            <button class="btn btn-info" type="button" onclick="buscarEnvioClas()" id="btnBuscar"><i class="fa fa-search"></i> </button>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre Remitente:</label>
                            <input type="text" readonly="" class="form-control" name="nombreremitente" id="nombreremitente" maxlength="100" placeholder="Nombre del remitente" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Telefono receptor:</label>
                            <input type="text" readonly="" class="form-control" name="telefonorec" id="telefonorec" maxlength="22" placeholder="Telefono del receptor" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Telefono remitente:</label>
                            <input type="text" readonly="" class="form-control" name="telefonorem" id="telefonorem" maxlength="22" placeholder="Telefono del remitente" required>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Dirección receptor:</label>
                            <input type="text" readonly="" class="form-control" name="dirreceptor" id="dirreceptor" maxlength="45" placeholder="Direccion del receptor" required>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Agencia Emisora:</label>
                            <select readonly="" class="form-control selectpicker" data-live-search="true" name="agenciaA" id="agenciaA" required>
                            </select>
                          </div>                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Dirección remitente:</label>
                            <input type="text" readonly="" class="form-control" name="dirremitente" id="dirremitente" maxlength="45" placeholder="Direccion del remitente" required>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>DIP Receptor:</label>
                            <input type="text" class="form-control" name="DNIreceptor" id="DNIreceptor" maxlength="10" minlength="6" placeholder="DIP del receptor" required>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12" > 
                            <label>CODIGO SECRETO:</label>
                            <input type="number" onmouseout="verificarCodigoSECRETO()" class="form-control" name="secreto" id="secreto" maxlength="10" placeholder="CODIGO SECRETO" required>
                            <input type="hidden" class="form-control" name="DNIremitente" id="DNIremitente">
                            <input type="hidden" class="form-control" name="secretoOK" id="secretoOK">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Tipo transaccion:</label>
                            <select readonly="" class="form-control selectpicker" name="tipo" id="tipo" required>
                              <option value="1">Divisas</option>
                              <option value="2">Paquete</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Monto:</label>
                            <input type="number" readonly="" class="form-control" name="monto" id="monto" maxlength="20" required>
                            <input type="hidden" class="form-control" name="comision" id="comision">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>COBRAR:</label>
                            <input type="number"  onmouseout="verificarMontoCOBRAR()" class="form-control" name="cobrar" id="cobrar" maxlength="20" required>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Comisión caja:</label>
                            <input type="number" readonly="" class="form-control" name="comi_benef" id="comi_benef" maxlength="20" required>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Descripción:</label>
                            <input type="text" readonly="" class="form-control" name="descripcion" id="descripcion" maxlength="45" placeholder="Descripción del paquete">
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-success" onmouseenter="verificarMontoCOBRAR()" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Retirar ahora</button>

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
<script type="text/javascript" src="scripts/recibos.js"></script>
<?php 
}
ob_end_flush();
?>
