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
if ($_SESSION['envios']==1)
{
?>
  <!--INICIO  CONTENIDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Realizar envio
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
                            <th>Remitente</th>
                            <th>Telefono</th>
                            <th>Monto</th>
                            <th>Comision</th> <!-- <th>Descripcion</th> si es un paquete -->
                            <th>Codigo</th>
                            <th>Agencia Emisora</th>
                            <th>Para</th>
                            <th>Agencia Receptora</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Remitente</th>
                            <th>Telefono</th>
                            <th>Monto</th>
                            <th>Comision</th> <!-- <th>Descripcion</th> si es un paquete -->
                            <th>Codigo</th>
                            <th>Agencia Emisora</th>
                            <th>Para</th>
                            <th>Agencia Receptora</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre Remitente:<span class="label label-success" id="nombreSINO"></span> </label>
                            <input type="hidden" name="idtransaccion" id="idtransaccion">
                            <input type="hidden" name="idreceptor" id="idreceptor">
                            <input type="hidden" name="existeR" id="existeR">
                            <input type="hidden" name="existeC" id="existeC">
                            <input type="hidden" name="codigoAc" id="codigoAc">
                            <input type="text" onkeydown="buscarRemitenteRellenarNuevo(this.value)" class="form-control" name="nombreremitente" id="nombreremitente" maxlength="100" placeholder="Nombre del remitente" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre Receptor:<span class="label label-success" id="nombreRSINO"></span> </label>
                            <input type="text" onkeydown="buscarReceptorRellenarNuevo(this.value)" class="form-control" name="nombrereceptor" id="nombrereceptor" maxlength="100" placeholder="Nombre del receptor" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Telefono:</label>
                            <input type="text" class="form-control" name="telefonorem" id="telefonorem" maxlength="22" placeholder="Telefono del remitente" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Telefono:</label>
                            <input type="text" class="form-control" name="telefonorec" id="telefonorec" maxlength="22" placeholder="Telefono del receptor" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Dirección:</label>
                            <input type="text" class="form-control" name="dirremitente" id="dirremitente" maxlength="45" placeholder="Direccion del remitente" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Dirección:</label>
                            <input type="text" class="form-control" name="dirreceptor" id="dirreceptor" maxlength="45" placeholder="Direccion del receptor" required>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>DNI Remitente:</label>
                            <input type="text" class="form-control" name="DNIremitente" id="DNIremitente" maxlength="10" placeholder="DNI del remitente" required>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Tipo transaccion:</label>
                            <select class="form-control selectpicker" name="tipo" id="tipo" required>
                              <option value="1">Divisas</option>
                              <option value="2">Paquete</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Monto:</label>
                            <input  onmouseout="comisiones(this.value)" type="number" class="form-control" name="monto" id="monto" min="2000" maxlength="9" placeholder="Monto de envio">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Comisión:</label>
                            <input type="text" readonly="" class="form-control" name="comision" id="comision" maxlength="20" placeholder="Comisión de envio">
                          </div>
                           <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" > 
                            <label>DNI Receptor:</label>
                            <input type="text" class="form-control" onkeypress="verificarDNI()" name="DNIreceptor" id="DNIreceptor" maxlength="10" placeholder="DNI del receptor" required>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Agencia Emisora:</label>
                            <select class="form-control selectpicker" data-live-search="true" name="agenciaA" id="agenciaA" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Agencia Receptora:</label>
                            <select class="form-control selectpicker" data-live-search="true" name="agenciaB" id="agenciaB" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Descripción:</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="45" placeholder="Descripción del paquete">
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-envelope"></i> Enviar </button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
</section>
    <!-- /.content -->
  </div>
  <!-- FIN CONTENIDO -->
  <!-- Modal
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Enviar y validar solicitud</h4>
        </div>
        <div class="modal-body">
          <form name="formulariosms" id="formulariosms" method="POST">
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Mensaje :</label>
              <input type="hidden" name="idtransaccionsms" id="idtransaccionsms">
              <input type="hidden" name="monantes" id="monantes">
              <input type="hidden" name="idsolicitud" id="idsolicitud">
              <textarea name="mensaje" id="mensaje" class="form-control" placeholder="Mensaje para el administrador" rows="3" maxlength="60" ></textarea>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>Descripción:</label>
                <textarea class="form-control" name="descripcionsms" id="descripcionsms" maxlength="45" rows="3" placeholder="Descripción del problema"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit" onclick="smsSolicitudValidacion()" id="btnGuardarsms"><i class="fa fa-envelope"></i> Solicitar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
   Fin modal -->

<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="scripts/envios.js"></script>
<?php 
}
ob_end_flush();
?>
