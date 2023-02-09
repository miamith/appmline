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
if ($_SESSION['banco_comercial']==1)
{
?>
  <!--INICIO  CONTENIDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Banco comercial
        <?php if($_SESSION['rol'] !='Agencia' || $_SESSION['rol']!='CajeroUV' )  { ?>
        <small><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></small>
        <?php } ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
           <!--Inicio centro -->
                    <div class="panel-body table-responsive display" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Nombre comercial</th>
                            <th>Pais</th>
                            <th>Ciudad</th>
                            <th>Cuenta CORRIENTE</th>
                            <th>saldo cuenta CORRIENTE</th>
                            <th>Responsable</th>
                            <th>Gerente</th>
                            <th>Creado por</th>
                            <th>Fecha creación</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                            <th>Nombre comercial</th>
                            <th>Pais</th>
                            <th>Ciudad</th>
                            <th>Cuenta CORRIENTE</th>
                            <th>saldo cuenta CORRIENTE</th>
                            <th>Responsable</th>
                            <th>Gerente</th>
                            <th>Creado por</th>
                            <th>Fecha creación</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <?php if($_SESSION['rol'] !='Administrador') { // VALIDACION DE ROLES ?>
                                    <button onmouseout="generarCuentaBancoComercial()" class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                                    <button class="btn bg-navy" type="button" id="btnDebitar" onclick="MODALOperarBancoComercial()"> <i class="fa fa-minus-square"></i> <i class="fa fa-reply-all"> </i> C-D UV Comercial <i class="fa fa-plus-square"> </i></button>
                       <?php  } ?>
                                    <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                        </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre (*):</label>
                            <input type="hidden" name="idbancoc" id="idbancoc">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="55" placeholder="Nombre banco comercial" required>
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
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Responsable comercial (*):</label>
                            <select class="form-control selectpicker" data-live-search="true" name="responsable" id="responsable" onchange="generarCuentaBancoComercial()" required>
                            </select>
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Gerente supervisor:</label>
                            <select class="form-control selectpicker" data-live-search="true" name="supervisor" id="supervisor" >
                            </select>
                          </div>
                          
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Numero de cuenta CORRIENTE(*):</label>
                            <input type="text" class="form-control" name="ncp" id="ncp" maxlength="45" placeholder="Numero de cuenta corriente" required readonly>
                          </div>

                        </form>
                    </div>
                    <!--Fin centro -->

<!--Modal centro -->
<div class="modal fade" id="MODALOperarBancoComercial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Operacion en el Banco Comercial</h4>
        </div>
        <div class="modal-body">
          <form name="formularioOperarBancoComercial" id="formularioOperarBancoComercial" method="POST">
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Nombre SUPERVISOR remitente (*) :</label>
                    <select onchange="ponerNCPclienteRemitente()"  class="form-control selectpicker" data-live-search="true" name="clienteremitente" id="clienteremitente" required>
                    </select>
                    <input type="hidden" name="idBancoComercialOP" id="idBancoComercialOP">
                    <input type="hidden" name="paisorigen" id="paisorigen">
                    <input type="hidden" name="saldoremitente" id="saldoremitente">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Agencia remitente  :</label>
                    <select  class="form-control selectpicker" data-live-search="true" name="agenciaremitente" id="agenciaremitente" >
                    </select>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <label>Cuenta A DEBITAR remitente(*):</label>
                  <select  class="form-control selectpicker" data-live-search="true" name="ncpremitente" id="ncpremitente" required>
                  </select>
                </div>

                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Nombre Comercial beneficiario(*):</label>
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
                            <option value="008">Aprovisionar UV Comercial</option>
                            <option value="009">Restituir UV Comercial</option>
                    </select>
                </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Descripción:</label>
                <textarea class="form-control" name="descripcion" id="descripcion" maxlength="45" rows="2" placeholder="Descripción de la operacion"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" type="submit" onmouseover="verificarNCP()" onclick="debitarCreditarBancoComercial(event)" id="btnGuardarOpeBancoComercial"><i class="fa fa-save"></i> Validar</button>
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
<script type="text/javascript" src="scripts/banco_comercial.js"></script>
<?php 
}
ob_end_flush();
?>

