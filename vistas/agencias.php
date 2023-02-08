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
if ($_SESSION['agencias']==1)
{
?>
  <!--INICIO  CONTENIDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Agencias
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
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Pais</th>
                            <th>Ciudad</th>
                            <th>Maximas Cajas</th>
                            <th>Cuenta CORRIENTE</th>
                            <th>saldo cuenta CORRIENTE</th>
                            <th>Cuenta COMISIONES</th>
                            <th>Saldo cuenta COMISIONES</th>
                            <th>Responsable</th>
                            <th>ResponsableMline</th>
                            <th>Creado por</th>
                            <th>Fecha creación</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Pais</th>
                            <th>Ciudad</th>
                            <th>Maximas Cajas</th>
                            <th>Cuenta CORRIENTE</th>
                            <th>saldo cuenta CORRIENTE</th>
                            <th>Cuenta COMISIONES</th>
                            <th>Saldo cuenta COMISIONES</th>
                            <th>Responsable</th>
                            <th>ResponsableMline</th>
                            <th>Creado por</th>
                            <th>Fecha creación</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <?php if($_SESSION['rol'] !='Agencia') { // VALIDACION DE ROLES ?>
                                    <button onmouseout="generarCuentaAgencia()" class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                                    <button class="btn bg-navy" type="button" id="btnDebitar" onclick="MODALOperarAgencia()"> <i class="fa fa-minus-square"></i> <i class="fa fa-reply-all"> </i> C-D Comisiones Agencia <i class="fa fa-plus-square"> </i></button>
                       <?php  } ?>
                                    <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                        </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre (*):</label>
                            <input type="hidden" name="idagencia" id="idagencia">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="55" placeholder="Nombre agencia" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Descripción:</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="45" placeholder="Descripción agencia" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Pais (*):</label>
                            <select class="form-control selectpicker" data-live-search="true" name="pais" id="pais" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Ciudad:</label>
                            <input type="text" class="form-control" name="ciudad" id="ciudad" maxlength="45" placeholder="Ciudad de la agencia">
                          </div>
                          <div class="form-group col-lg-6 col-6 md-6 col-sm-6 col-xs-12">
                            <label>Maximo de cajas:</label>
                            <input type="text" class="form-control" name="max_cajas" id="max_cajas" maxlength="45" placeholder="Maximo de cajas" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Gerente de la agencia X (*):</label>
                            <select class="form-control selectpicker" data-live-search="true" name="responsable" id="responsable" onchange="generarCuentaAgencia()" required>
                            </select>
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Responsable Mline:</label>
                            <select class="form-control selectpicker" data-live-search="true" name="responsableMline" id="responsableMline" >
                            </select>
                          </div>
                          
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Numero de cuenta CORRIENTE(*):</label>
                            <input type="text" class="form-control" name="ncp" id="ncp" maxlength="45" placeholder="Numero de cuenta corriente" required readonly>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Numero de cuenta COMISIONES(*):</label>
                            <input type="text" class="form-control" name="ncpComisiones" id="ncpComisiones" maxlength="45" placeholder="Numero de cuenta comisiones" required readonly>
                          </div>

                        </form>
                    </div>
                    <!--Fin centro -->

<!--Modal centro -->
<div class="modal fade" id="MODALOperarAgencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Operacion en la agencia</h4>
        </div>
        <div class="modal-body">
          <form name="formularioOperarAgencia" id="formularioOperarAgencia" method="POST">
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Nombre cliente remitente (*) :</label>
                    <select onchange="ponerNCPclienteRemitente()"  class="form-control selectpicker" data-live-search="true" name="clienteremitente" id="clienteremitente" required>
                    </select>
                    <input type="hidden" name="idAgenciaOP" id="idAgenciaOP">
                    <input type="hidden" name="paisorigen" id="paisorigen">
                    <input type="hidden" name="saldoremitente" id="saldoremitente">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Agencia Master remitente  :</label>
                    <select  class="form-control selectpicker" data-live-search="true" name="agenciaremitente" id="agenciaremitente" >
                    </select>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <label>Cuenta A DEBITAR remitente(*):</label>
                  <select  class="form-control selectpicker" data-live-search="true" name="ncpremitente" id="ncpremitente" required>
                  </select>
                </div>

                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Nombre cliente beneficiario(*):</label>
                    <select onchange="ponerNCPclienteBeneficiario()" class="form-control selectpicker" data-live-search="true" name="clientebeneficiario" id="clientebeneficiario" required>
                    </select>
                    <input type="hidden" name="paisdestino" id="paisdestino">
                </div>

                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Agencia Master beneficiaria  :</label>
                    <select  class="form-control selectpicker" data-live-search="true" name="agenciabeneficiaria" id="agenciabeneficiaria" required>
                    </select>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Cuenta A CREDITAR beneficiaria (*):</label>
                    <select onchange="traerSaldoActual(this.value)" class="form-control selectpicker" data-live-search="true" name="ncpbeneficiaria" id="ncpbeneficiaria" required>
                  </select>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Monto (*):</label>
                    <input type="number" class="form-control" name="monto" id="monto" maxlength="10" placeholder="Monto maximo envio">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Tipo de operacion (*):</label>
                    <select  onchange="" class="form-control selectpicker" data-live-search="true" name="tipo" id="tipo" >
                            <option value="3">Recarga UV o Saldo</option>
                            <option value="4">Restituir UV o Saldo</option>
                            <option value="5">Retiro comisiones</option>
                            <option value="6">Pagar comisiones</option>
                    </select>
                </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Descripción:</label>
                <textarea class="form-control" name="descripcion" id="descripcion" maxlength="45" rows="2" placeholder="Descripción de la operacion"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" type="submit" onmouseover="verificarNCP()" onclick="debitarCreditarAgencia(event)" id="btnGuardarOpeAgencia"><i class="fa fa-save"></i> Validar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
 <!--Modal centro --> 



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
<script type="text/javascript" src="scripts/agencias.js"></script>
<?php 
}
ob_end_flush();
?>

