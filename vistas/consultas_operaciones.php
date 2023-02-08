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
if ($_SESSION['operaciones']==1)
{
?>
  <!--INICIO  CONTENIDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Consultas de operaciones generales
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
           <!--Inicio centro -->
                    <div class="panel-body table-responsive" id="listadoregistros" style="padding:0px ">

                        <div >
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha de inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha de fin</label>
                            <input type="date" class="form-control" name="fecha_final" id="fecha_final" value="<?php echo date("Y-m-d"); ?>">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Tipo de operacion (*):</label>
                            <select class="form-control selectpicker" data-live-search="true" name="codigo_ope" id="codigo_ope" >
                                    <option value="">TODOS</option>        
                                    <option value="002">RECARGA UV AGENCIA</option>
                                    <option value="003">RESTITUIR UV AGENCIA</option>
                                    <option value="007">RETIRO COMISIONES AGENCIA</option>
                                    <option value="006">PAGAR COMISIONES AGENCIA</option>
                                    <option value="004">RECARGA UV CAJA</option>
                                    <option value="005">RESTITUIR UV CAJA</option>                                    
                            </select>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Agencia</label>
                            <select  class="form-control  selectpicker" data-live-search="true" name="agencia" id="agencia" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Empleado</label>
                            <select  class="form-control  selectpicker" data-live-search="true" name="ap" id="ap" required>
                            </select>
                          </div>
                          
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <button onclick="listar()" class="btn btn-success" type="button" ><i class="fa fa-search"></i> Mostrar</button>
                          </div>

                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Remitente</th>
                            <th>Cuenta remite</th>
                            <th>Monto</th>
                            <th>Codigo</th>
                            <th>Codigo OPE</th>
                            <th>Fraseo OPE</th>
                            <th>Sentido</th>
                            <th>Descripcion</th>
                            <th>Agencia Emisora</th>
                            <th>Agencia Receptora</th>
                            <th>Beneficia</th>
                            <th>Cuenta beneficia</th>
                            <th>Agente</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Remitente</th>
                            <th>Cuenta remite</th>
                            <th>Monto</th>
                            <th>Codigo</th>
                            <th>Codigo OPE</th>
                            <th>Fraseo OPE</th>
                            <th>Sentido</th>
                            <th>Descripcion</th>
                            <th>Agencia Emisora</th>
                            <th>Agencia Receptora</th>
                            <th>Beneficia</th>
                            <th>Cuenta beneficia</th>
                            <th>Agente</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
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
<script type="text/javascript" src="scripts/consultas_operaciones.js"></script>
<?php 
}
ob_end_flush();
?>
