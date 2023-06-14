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
if ($_SESSION['cajas']==1)
{
?>
  <!--INICIO  CONTENIDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cajas
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
                            <th>Nombre</th>
                            <th>AGENCIA MASTER</th>
                            <th>Cliente</th>
                            <th>Cajero</th>
                            <th>SALDO CORRIENTE</th>   
                            <th>SALDO COMISINES</th>
                            <th>CUENTA CORRIENTE</th>   
                            <th>CUENTA COMISINES</th>                          
                            <th>Monto MAX Envio</th>
                            <th>Cerrada</th>
                            <th>Creado por</th>
                            <th>Fecha creación</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                          <th>#</th>
                            <th>Nombre</th>
                            <th>AGENCIA MASTER</th>
                            <th>Cliente</th>
                            <th>Cajero</th>
                            <th>SALDO CORRIENTE</th>   
                            <th>SALDO COMISINES</th>
                            <th>CUENTA CORRIENTE</th>   
                            <th>CUENTA COMISINES</th>                          
                            <th>Monto MAX Envio</th>
                            <th>Cerrada</th>
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
                                    <button class="btn bg-navy" type="button" id="btnDebitar" onclick="MODALOperarCaja()"> <i class="fa fa-minus-square"></i> <i class="fa fa-reply-all"> </i> C-D Comisiones Caja <i class="fa fa-plus-square"> </i></button>
                        <?php  } ?>          
                                    <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                        </div>
                            
                             <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Nombre del GERENTE (*) :</label>
                                <select onchange="ponerAgenciaCliente()"  class="form-control selectpicker" data-live-search="true" name="cliente" id="cliente" required>
                                </select>
                                <input type="hidden" name="idCaja" id="idCaja">
                             </div>
                             <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Agencia Master Ligada :</label>
                                    <select  class="form-control selectpicker" data-live-search="true" name="agencia" id="agencia" >
                                  </select>
                              </div>
                              <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Nombre caja (*):</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="30" placeholder="Nombre de la caja" required>
                              </div>
                              <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Cajero (*):</label>
                                    <select onchange="ponerNCPCajero()"  class="form-control selectpicker" data-live-search="true" name="cajero" id="cajero" required >
                                    </select>
                              </div>
                              <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Numero cuenta CORRIENTE :</label>
                                <input type="number" class="form-control" name="ncpCorriente" id="ncpCorriente" maxlength="45" placeholder="Numero cuenta corriente">
                              </div>
                              <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Numero cuenta COMISIONES:</label>
                                <input type="number" class="form-control" name="ncpComisiones" id="ncpComisiones" maxlength="45" placeholder="Numero de cuenta de comisiones">
                              </div>
                              <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Monto maximo envio:</label>
                                <input type="text" class="form-control" name="montoMaxEnvio" id="montoMaxEnvio" maxlength="45" placeholder="Monto maximo envio">
                              </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Caja cerrada :</label>
                                <select  class="form-control selectpicker" data-live-search="true" name="cajacerrada" id="cajacerrada" >
                                    <option value="NO">NO</option>
                                    <option value="SI">SI</option>
                                </select>
                            </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
     <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Historial movimientos</h3>
        </div>

         <div class="box-body">
            <!-- <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>OPERACION :</label>
                <select  class="form-control selectpicker" data-live-search="true" name="filtro" id="filtro" >
                    <option value="NO">ENVIOS</option>
                    <option value="SI">RECIBOS</option>
                    <option value="SIS">CREDITAR CAJA</option>
                    <option value="SIW">DEBITAR CAJA</option>
                </select>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Rango fechas:</label>
                <div class="input-group">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" name="rangofechas" id="rangofechas" >
                </div>
            </div> 
            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <label>Accion</label>
            <button class="btn btn-info form-control" type="button" id="btnFiltrar"><i class="fa fa-filter"></i> Buscar</button>
           </div>
            <form role="form">

                 <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                  <thead style="background-color:#A9D0F5">
                        <th>Opciones</th>
                        <th>Artículo</th>
                        <th>Cantidad</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Subtotal</th>
                    </thead>
                    <tfoot>
                        <th>TOTAL</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><h4 id="total"> 0.00 XAF</h4><input type="hidden" name="total_compra" id="total_compra"></th> 
                    </tfoot>
                    <tbody>
                      
                    </tbody>
                </table>  
              
            
            </form> 
        </div>-->

    </div>
    </div>
                                    
                                </form>
                            </div>
                            <!--Fin centro -->
                            

 <!--Modal centro -->
  <div class="modal fade" id="MODALOperarCaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Operacion en la caja</h4>
        </div>
        <div class="modal-body">
          <form name="formularioOperarCaja" id="formularioOperarCaja" method="POST">
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Nombre cliente remitente (*) :</label>
                    <select onchange="ponerNCPclienteRemitente()"  class="form-control selectpicker" data-live-search="true" name="clienteremitente" id="clienteremitente" required>
                    </select>
                    <input type="hidden" name="idCajaOP" id="idCajaOP">
                    <input type="hidden" name="paisorigen" id="paisorigen">
                    <input type="hidden" name="saldoremitente" id="saldoremitente">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Agencia Master remitente  :</label>
                    <select  class="form-control selectpicker" data-live-search="true" name="agenciaremitente" id="agenciaremitente" >
                    </select>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Cuenta CORRIENTE remitente (*):</label>
                <input type="text" class="form-control" name="ncpremitente" id="ncpremitente" maxlength="45" placeholder="Numero de cuenta remitente" required>
                </div>

                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Nombre cliente beneficiario (*) :</label>
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
                    <label>Cuenta CORRIENTE beneficiaria (*):</label>
                    <input type="text" class="form-control" name="ncpbeneficiaria" id="ncpbeneficiaria" maxlength="45" placeholder="Numero de cuenta remitente" required>
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
          <button class="btn btn-success" type="submit" onmouseover="verificarNCP()" onclick="debitarCreditarCaja(event)" id="btnGuardarOpeCaja"><i class="fa fa-save"></i> Validar</button>
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
<script type="text/javascript" src="scripts/cajas.js"></script>
<?php 
}
ob_end_flush();
?>

