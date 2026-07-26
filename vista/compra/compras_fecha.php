<?php
     session_start();
    
    if(!isset($_SESSION['cargo']) == 1){
    header('location: ../pages-login');
  }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Vetdog V.1 | Vetdog - Vetdog Admin Template</title>
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../../assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <!-- Bootstrap DatePicker Css -->
    <link href="../../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    <!-- Google Font - Iconos -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="../../assets/plugins/node-waves/waves.css" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="../../assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- JQuery DataTable Css -->
    <link href="../assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">
    <link href="../../assets/css/themes/all-themes.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/lll.png" />
   <script src="../../assets/css/jquery/dist/jquery.min.js"></script>
<script src="../../assets/css/pdf_object/pdfobject.js"></script>    
<style>
.pdfobject-container { height: 60rem; border: 1rem solid rgba(0,0,0,.1); }
.modal-dialog{background-color: #fff; padding: 20px 15px;}
#cancel{margin: 5px; display: block;}
.cargando{position: absolute;width: 30px;right: -40px;top: -2px;}
.hide{display: none;}
</style>

</head>

<body class="theme-red">
     <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Cargando...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- LUPA -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons"></i>
        </div>
        <input type="text" placeholder="Buscar...">
        <div class="close-search">
            <i class="material-icons">X</i>
        </div>
    </div>
    <!-- //LUPA -->

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="../panel-admin/administrador"> VETDOG - DASHBOARD </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                  
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->

    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../../assets/img/mujerico.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo ucfirst($_SESSION['nombre']); ?></div>
                    <div class="email"><?php echo ucfirst($_SESSION['correo']); ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="../config/configuracion"><i class="material-icons">brightness_low</i>Mi Cuenta</a></li>
                            <li role="separator" class="divider"></li>
                            <li role="separator" class="divider"></li>

                            <li><a href="../pages-logout"><i class="material-icons">input</i>Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->


            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENÚ DE NAVEGACIÓN</li>
                    <li>
                        <a href="../panel-admin/administrador">
                            <i class="material-icons">home</i>
                            <span>INICIO</span>
                        </a>
                    </li>
<!--======================================================================================================-->
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">inbox</i>
                            <span>PRODUCTOS</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../productos/nuevo">Registrar</a>
                            </li>
                            <li>
                                <a href="../../folder/productos">Listar / Modificar</a>
                            </li>
                        </ul>
                    </li>
<!--======================================================================================================-->
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">low_priority</i>
                            <span>CATEGORÍAS</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../categorias/nuevo">Registrar</a>
                            </li>
                            <li>
                                <a href="../../folder/categorias">Listar / Modificar</a>
                            </li>
                        </ul>
                    </li>
<!--======================================================================================================-->
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">supervisor_account</i>
                            <span>CLIENTES</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../clientes/nuevo">Registrar</a>
                            </li>
                            <li>
                                <a href="../../folder/clientes">Listar / Modificar</a>
                            </li>
                        </ul>
                    </li>
<!--======================================================================================================-->
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">business</i>
                            <span>PROVEEDORES</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../proveedores/nuevo">Registrar</a>
                            </li>
                            <li>
                                <a href="../../folder/proveedores">Listar / Modificar</a>
                            </li>
                        </ul>
                    </li>
<!--======================================================================================================-->
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person_pin</i>
                            <span>VETERINARIOS</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../veterinarios/nuevo">Registrar</a>
                            </li>
                            <li>
                                <a href="../../folder/veterinarios">Listar / Modificar</a>
                            </li>
                        </ul>
                    </li>
<!--======================================================================================================-->
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">flutter_dash</i>
                            <span>MASCOTAS</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../mascotas/nuevo">Registrar</a>
                            </li>
                            <li>
                                <a href="../../folder/mascotas">Listar / Modificar</a>
                            </li>
                            <li>
                                <a href="../../folder/tipo">Tipos</a>
                            </li>
                            <li>
                                <a href="../../folder/raza">Razas</a>
                            </li>
                        </ul>
</li>
<!--======================================================================================================-->
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">calendar_today</i>
                            <span>CITAS</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../citas/nuevo">Registrar</a>
                            </li>
                            <li>
                                <a href="../../folder/citas">Listar / Modificar</a>
                            </li>
                            <li>
                                <a href="../../folder/servicio">Servicio</a>
                            </li>
                        </ul>
    </li>
    <!--======================================================================================================-->
    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">shopping_basket</i>
                            <span>COMPRA</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../compra/nuevo">Registrar</a>
                            </li>
                            <li>
                                <a href="../../folder/compra">Listar / Modificar</a>
                            </li>

                            <li class="active">
                                <a href="../compra/compras_fecha">Consultar por fecha</a>
                            </li>
                        </ul>
    </li>
<!--======================================================================================================-->
<li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">monetization_on</i>
                            <span>VENTA</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../venta/nuevo">Registrar</a>
                            </li>
                            <li>
                                <a href="../../folder/venta">Listar / Modificar</a>
                            </li>
                        </ul>
    </li>
    <!--======================================================================================================-->
        <aside id="rightsidebar" class="right-sidebar">
        </aside>
    </section>

<!--============================CONTENIDO DE LA PÁGINA ==========================================================-->

   
   <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div>

                                <ul class="nav nav-tabs" role="tablist">
                                    <?php
$db_host="localhost"; 
$db_user="root";    
$db_password="";    
$db_name="vetdog";    
try
{
    $db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e)
{
    $e->getMessage();
}
$sql = "SELECT COUNT(*) total FROM compra WHERE estado = '1'";
$result = $db->query($sql); //$pdo sería el objeto conexión
$total = $result->fetchColumn();
?>

                                    <li role="presentation" class="active"><span class="badge badge-purple"><?php echo  $total; ?></span><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Aceptadas</a></li>

                      <?php
$db_host="localhost"; 
$db_user="root";    
$db_password="";    
$db_name="vetdog";    
try
{
    $db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e)
{
    $e->getMessage();
}
$sql = "SELECT COUNT(*) total FROM compra WHERE estado = '0'";
$result = $db->query($sql); //$pdo sería el objeto conexión
$total = $result->fetchColumn();
?>              
                                    <li role="presentation"><span class="badge badge-danger"><?php echo  $total; ?></span><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Anuladas</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="profile_settings">
                                        <h5 class="panel-title">Compras Aceptadas<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>

                <a style="margin-top:20px;" onClick="javascript:reportePDF();" title="Reporte" class="btn btn-danger"><i class="material-icons">print</i> Imprimir Reporte<span><img src="../../assets/img/cargando.gif" class="cargando hide"></span></a>

  
        <form class="form-inline" method="POST" action="" style="margin-top:30px;">
            <label>Fecha desde:</label>
            <input type="date" class="form-control" placeholder="Start" id="date1"  />
            <label>Hasta</label>
            <input type="date" class="form-control" placeholder="End" id="date2"  />
            <button id="rango_fecha" class="btn btn-primary" ><i class="material-icons">search</i>Consultar</button> 
            
        </form>


        <div class="table-responsive" style="margin-top:30px;">
                                            
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                <thead>
                                                    <tr>
                                                        <th>Comprobante</th>
                                                       
                                                        <th>Fecha</th>
                                                        <th>Proveedor</th>
                                                        <th>Tipo pago</th>
                                                        <th>Total</th>
                                                        <th>Estado</th>
                                                        <th>Opciones</th>
                                                        
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody id="actualizar">
                           

                            <?php include('../compra/imprimir_fe.php'); ?>

                                                </tbody>
                                               

                                            </table>
                                        </div>
                                    </div>

                                    <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
                                      <h5 class="panel-title">Compras Anuladas<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>  
                    <a style="margin-top:20px;" onClick="javascript:reporteAPDF();" title="Reporte" class="btn btn-danger"><i class="material-icons">print</i> Imprimir Reporte<span><img src="../../assets/img/cargando.gif" class="cargando hide"></span></a>

        <form class="form-inline" method="POST" action="" style="margin-top:30px;">
            <label>Fecha desde:</label>
            <input type="date" class="form-control" placeholder="Start" id="date3"  name="date3"/>
            <label>Hasta</label>
            <input type="date" class="form-control" placeholder="End" id="date4"  name="date4"/>
            <button class="btn btn-primary" name="search"><i class="material-icons">search</i>Consultar</button> 
            
        </form>


        <div class="table-responsive" style="margin-top:30px;">
                                            
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                <thead>
                                                    <tr>
                                                        <th>Comprobante</th>
                                                       
                                                        <th>Fecha</th>
                                                        <th>Proveedor</th>
                                                        <th>Tipo pago</th>
                                                        <th>Total</th>
                                                        <th>Estado</th>
                                                        <th>Opciones</th>
                                                        
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                            <?php include'range_anulada.php'?> 

                                                </tbody>
                                               

                                            </table>
        </div>                              
                                       

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

<div class="modal fade" id="ver-pdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="x_panel">
        <div class="x_title">
            <h2 class="text-center">Reporte Generado</h2>
            <div class="clearfix"></div>
        </div>

         <div id="view_pdf"></div>
            <a id="cancel" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cancelar</a>
        </div>
    </div>
</div>
    <!-- Jquery Core Js -->
    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="../../assets/plugins/bootstrap/js/bootstrap.js"></script>
    <!-- Select Plugin Js -->
    <script src="../../assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="../../assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="../../assets/plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../../assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../../assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../../assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../../assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../../assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../../assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../../assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../../assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="../../assets/plugins/autosize/autosize.js"></script>
    <!-- Moment Plugin Js -->
    <script src="../../assets/plugins/momentjs/moment.js"></script>
    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../../assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="../../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   
    <!-- Custom Js -->
    <script src="../../assets/js/admin.js"></script>
   
    <script src="../../assets/js/pages/tables/jquery-datatable.js"></script>
    <!-- Demo Js -->

    <script src="../../assets/js/demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    

    <!--------------------------------script nuevo----------------------------->
    <script type="text/javascript">

(function(){    
    $('#rango_fecha').on('click',function(){
        var desde = $('#date1').val();
        var hasta = $('#date2').val();
        var url = '../compra/busca_por_fecha';
        $.ajax({
        type:'POST',
        url:url,
        data:'desde='+desde+'&hasta='+hasta,
        success: function(datos){
            $('#actualizar').html(datos);
        }
    });
    return false;
    });
})();
        
        function reportePDF(){
    var desde = $('#date1').val();
    var hasta = $('#date2').val();
    var url = '../compra/exportar_pdf.php';
    $('.cargando').removeClass('hide');
    $.ajax({
        type:'POST',
        url:url,
        data:'desde='+desde+'&hasta='+hasta,
        success: function(datos){
            $('.cargando').addClass('hide');
            $('#ver-pdf').modal({
                show:true,
                backdrop:'static'
            }); 
            PDFObject.embed("../compra/reporte.pdf", "#view_pdf");
        }
    });
    return false;
}
    </script>


    <script type="text/javascript">
        
        function reporteAPDF(){
    var desde = $('#date3').val();
    var hasta = $('#date4').val();
    var url = '../compra/exportarA_pdf.php';
    $('.cargando').removeClass('hide');
    $.ajax({
        type:'POST',
        url:url,
        data:'desde='+desde+'&hasta='+hasta,
        success: function(datos){
            $('.cargando').addClass('hide');
            $('#ver-pdf').modal({
                show:true,
                backdrop:'static'
            }); 
            PDFObject.embed("../compra/reporte.pdf", "#view_pdf");
        }
    });
    return false;
}
    </script>

  
</body>
</html>
