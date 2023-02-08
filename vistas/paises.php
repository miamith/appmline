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
if ($_SESSION['paises']==1) 
{
?>
  <!--INICIO  CONTENIDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registro de paises
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
                            <th>Nombre </th>
                            <th>Descripcion</th>
                            <th>Limit envio LOCAL</th>
                            <th>Limit envio INT</th>
                            <th>Moneda</th>
                            <th>IVA</th>
                            <th>% Envio</th>
                            <th>% Recibir</th>
                            <th>% Envio PAQ.</th>
                            <th>% Recibir PAQ.</th>
                            <th>Partner API</th>
                            <th>Creado por</th>
                            <th>Fecha creacion</th>
                            <th>Prefijo tel.</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                             <th>Opciones</th>
                            <th>Nombre </th>
                            <th>Descripcion</th>
                            <th>Limit envio LOCAL</th>
                            <th>Limit envio INT</th>
                            <th>Moneda</th>
                            <th>IVA</th>
                            <th>% Envio</th>
                            <th>% Recibir</th>
                            <th>% Envio PAQ.</th>
                            <th>% Recibir PAQ.</th>
                            <th>Partner API</th>
                            <th>Creado por</th>
                            <th>Fecha creacion</th>
                            <th>Prefijo tel.</th>
                          </tfoot>
                        </table>
                    </div>

                   
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre pais (*):</label>
                            <input type="hidden" name="idpais" id="idpais">
                            <input type="text" class="form-control" name="nompais" id="nompais" maxlength="45" placeholder="Nombre del pais" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" > 
                            <label>Descripcion:</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="50" placeholder="Descripcion del pais" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" > 
                            <label>Limite envio LOCAL:</label>
                            <input type="text" class="form-control" name="limienviolocal" id="limitenviolocal" maxlength="20" placeholder="Limite envio LOCAL" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" > 
                            <label>Limite envio INT.:</label>
                            <input type="text" class="form-control" name="limienvioint" id="limitenvioint" maxlength="20" placeholder="Limite envio INTERNACIONAL" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" > 
                            <label>Moneda (*):</label>
                            <input type="text" class="form-control" name="moneda" id="moneda" maxlength="20" placeholder="Moneda ej: XAF" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" > 
                            <label>IVA (*):</label>
                            <input type="text" class="form-control" name="iva" id="iva" maxlength="20" placeholder="IVA" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" > 
                            <label>% de Envio (*):</label>
                            <input type="text" class="form-control" name="porcenenvio" id="porcenenvio" maxlength="20" placeholder="Porcentaje de envio" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" > 
                            <label>% de recibir (*):</label>
                            <input type="text" class="form-control" name="porcenrecibir" id="porcenrecibir" maxlength="20" placeholder="Porcentqje de recibir" required>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" > 
                            <label>% envio PAQ (*):</label>
                            <input type="text" class="form-control" name="porcenenviopaq" id="porcenenviopaq" maxlength="20" placeholder="Porcentaje de envio de PAQUETE" required>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" > 
                            <label>% recibir PAQ (*):</label>
                            <input type="text" class="form-control" name="porcenrecibirpaq" id="porcenrecibirpaq" maxlength="20" placeholder="Porcentaje de recibir un PAQUETE" required>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" > 
                            <label>Partner API:</label>
                            <input type="text" class="form-control" name="partnerapi" id="partnerapi" maxlength="20" placeholder="Partner API" >
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" > 
                            <label>Prefijo telefonico(*):</label>
                            <input type="text" class="form-control" name="prefijoTel" id="prefijoTel" maxlength="20" placeholder="Prefijo tel +240" required>
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
<script type="text/javascript" src="scripts/paises.js"></script>
<?php 
}
ob_end_flush();
?>

