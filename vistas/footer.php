 <!-- Main Footer -->
  <footer class="main-footer">
  <!-- To the right -->
    <div class="pull-right hidden-xs">
      Version 1.0
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023 <a href="#">M_line</a>.</strong> Todos los derechos reservados.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Actividad reciente</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Calendario festivo</h4>

                <p>Próximo puente, 12 de Octubre</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tareas en curso</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Personalizar el diseño
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">Configuración geneneral</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Panel de reportes del uso
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Resumen de la información de reglages
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="../public/dist/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../public/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../public/dist/js/adminlte.min.js"></script>
<script src="../public/dist/js/moment.min.js"></script>
<script src="../public/dist/js/bootstrap-datepicker.min.js"></script>
<script src="../public/dist/js/daterangepicker.js"></script>

    <!-- DATATABLES -->
    <script src="../public/dist/datatables/jquery.dataTables.min.js"></script>    
    <script src="../public/dist/datatables/dataTables.buttons.min.js"></script>
    <script src="../public/dist/datatables/buttons.html5.min.js"></script>
    <script src="../public/dist/datatables/buttons.colVis.min.js"></script>
    <script src="../public/dist/datatables/jszip.min.js"></script>
    <script src="../public/dist/datatables/pdfmake.min.js"></script>
    <script src="../public/dist/datatables/vfs_fonts.js"></script> 
    <script src="../public/dist/js/bootbox.min.js"></script> 
    <script src="../public/dist/js/bootstrap-select.min.js"></script>



    <script>
        $(function () {
            var url = window.location;
            // for single sidebar menu
            $('ul.sidebar-menu a').filter(function () {
              //console.log(this.href);
              //console.log(url);
                return this.href == url;
            }).addClass('active');

            // for sidebar menu and treeview
            $('ul.treeview a').filter(function () {
                return this.href == url;
            }).parentsUntil(".treeview.menu-open > ul.treeview-menu")
        .css({'display': 'block'})
        .addClass('menu-open').prev('a')
        .addClass('active');
        });
    </script>

</body>
</html>