<?php
  require_once '../../assets/db/config.php';

  if(!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1){
      header('Location: /vista/pages-login.php');
      exit;
  }

  // Usar la conexión PDO global de config.php
  $mysqli = new mysqli(dbhost, dbuser, dbpass, dbname, dbport);
  if ($mysqli->connect_error) {
      die("Error de conexión: " . $mysqli->connect_error);
  }

  /* Getting demo_viewer table data */
  $sql = "SELECT SUM(total) as count FROM venta GROUP BY YEAR(id_venta) ORDER BY id_venta";
  $viewer = mysqli_query($mysqli,$sql);
  $viewer = $viewer ? mysqli_fetch_all($viewer,MYSQLI_ASSOC) : [];
  $viewer = json_encode(array_column($viewer, 'count'),JSON_NUMERIC_CHECK);

  /* Getting demo_click table data */
  $sql = "SELECT SUM(total) as count FROM compra GROUP BY YEAR(id_compra) ORDER BY id_compra";
  $click = mysqli_query($mysqli,$sql);
  $click = $click ? mysqli_fetch_all($click,MYSQLI_ASSOC) : [];
  $click = json_encode(array_column($click, 'count'),JSON_NUMERIC_CHECK);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Vetdog V.1 | Vetdog - Vetdog Admin Template</title>
    <!-- Google Font - Iconos -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../assets/plugins/node-waves/waves.css" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="../../assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="../../css/style.css" rel="stylesheet">
    <link href="../../assets/css/themes/all-themes.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/lll.png" />
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
                <a class="navbar-brand" href="administrador"> VETDOG - DASHBOARD </a>
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
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo isset($_SESSION['nombre']) ? ucfirst($_SESSION['nombre']) : 'Admin'; ?></div>
                    <div class="email"><?php echo isset($_SESSION['correo']) ? ucfirst($_SESSION['correo']) : ''; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="../config/configuracion"><i class="material-icons">brightness_low</i>Mi Cuenta</a></li>
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
                    <li class="active">
                        <a href="administrador">
                            <i class="material-icons">home</i>
                            <span>INICIO</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">inbox</i>
                            <span>PRODUCTOS</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../productos/nuevo">Registrar</a></li>
                            <li><a href="../../folder/productos">Listar / Modificar</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">low_priority</i>
                            <span>CATEGORÍAS</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../categorias/nuevo">Registrar</a></li>
                            <li><a href="../../folder/categorias">Listar / Modificar</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">supervisor_account</i>
                            <span>CLIENTES</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../clientes/nuevo">Registrar</a></li>
                            <li><a href="../../folder/clientes">Listar / Modificar</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">business</i>
                            <span>PROVEEDORES</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../proveedores/nuevo">Registrar</a></li>
                            <li><a href="../../folder/proveedores">Listar / Modificar</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person_pin</i>
                            <span>VETERINARIOS</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../veterinarios/nuevo">Registrar</a></li>
                            <li><a href="../../folder/veterinarios">Listar / Modificar</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">flutter_dash</i>
                            <span>MASCOTAS</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../mascotas/nuevo">Registrar</a></li>
                            <li><a href="../../folder/mascotas">Listar / Modificar</a></li>
                            <li><a href="../../folder/tipo">Tipos</a></li>
                            <li><a href="../../folder/raza">Razas</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">calendar_today</i>
                            <span>CITAS</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../citas/nuevo">Registrar</a></li>
                            <li><a href="../../folder/citas">Listar / Modificar</a></li>
                            <li><a href="../../folder/servicio">Servicio</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">shopping_basket</i>
                            <span>COMPRA</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../compra/nuevo">Registrar</a></li>
                            <li><a href="../../folder/compra">Listar / Modificar</a></li>
                            <li><a href="../compra/compras_fecha">Consultar por fecha</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">monetization_on</i>
                            <span>VENTA</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../venta/nuevo">Registrar</a></li>
                            <li><a href="../../folder/venta">Listar / Modificar</a></li>
                            <li><a href="../venta/venta_fecha">Consultar por fecha</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>

        <aside id="rightsidebar" class="right-sidebar"></aside>
    </section>

    <!-- CONTENIDO DE LA PÁGINA -->
    <section class="content">
        <div class="container-fluid">
            <div class="block-header"></div>

            <!-- SubMenu1 -->
            <div class="row clearfix">
                <!-- PRODUCTOS -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <a href="../../folder/productos">
                            <div class="icon"><i class="material-icons">inbox</i></div>
                        </a>
                        <?php
                          try {
                              $sql = "SELECT COUNT(*) total FROM products";
                              $result = $connect->query($sql);
                              $total = $result->fetchColumn();
                          } catch(Exception $e) { $total = 0; }
                        ?>
                        <div class="content">
                            <div class="text">PRODUCTOS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <!-- CATEGORÍAS -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <a href="../../folder/categorias">
                            <div class="icon"><i class="material-icons">low_priority</i></div>
                        </a>
                        <?php
                          try {
                              $sql = "SELECT COUNT(*) total FROM category";
                              $result = $connect->query($sql);
                              $total = $result->fetchColumn();
                          } catch(Exception $e) { $total = 0; }
                        ?>
                        <div class="content">
                            <div class="text">CATEGORÍAS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <!-- CLIENTES -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <a href="../../folder/clientes">
                            <div class="icon"><i class="material-icons">supervisor_account</i></div>
                        </a>
                        <?php
                          try {
                              $sql = "SELECT COUNT(*) total FROM owner";
                              $result = $connect->query($sql);
                              $total = $result->fetchColumn();
                          } catch(Exception $e) { $total = 0; }
                        ?>
                        <div class="content">
                            <div class="text">CLIENTES</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <!-- COMPRAS -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <a href="../../folder/compra">
                            <div class="icon"><i class="material-icons">monetization_on</i></div>
                        </a>
                        <?php
                          try {
                              $sql = "SELECT SUM(total) FROM compra";
                              $result = $connect->query($sql);
                              $total = $result->fetchColumn();
                              $total = $total ? $total : 0;
                          } catch(Exception $e) { $total = 0; }
                        ?>
                        <div class="content">
                            <div class="text">COMPRAS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SubMenu2 -->
            <div class="row clearfix">
                <!-- PROVEEDORES -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <a href="../../folder/proveedores">
                            <div class="icon"><i class="material-icons">business</i></div>
                        </a>
                        <?php
                          try {
                              $sql = "SELECT COUNT(*) total FROM supplier";
                              $result = $connect->query($sql);
                              $total = $result->fetchColumn();
                          } catch(Exception $e) { $total = 0; }
                        ?>
                        <div class="content">
                            <div class="text">PROVEEDORES</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <!-- VETERINARIOS -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <a href="../../folder/veterinarios">
                            <div class="icon"><i class="material-icons">person_pin</i></div>
                        </a>
                        <?php
                          try {
                              $sql = "SELECT COUNT(*) total FROM veterinarian";
                              $result = $connect->query($sql);
                              $total = $result->fetchColumn();
                          } catch(Exception $e) { $total = 0; }
                        ?>
                        <div class="content">
                            <div class="text">VETERINARIOS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <!-- VENTAS -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <a href="../../folder/venta">
                            <div class="icon"><i class="material-icons">trending_up</i></div>
                        </a>
                        <?php
                          try {
                              $sql = "SELECT SUM(total) FROM venta";
                              $result = $connect->query($sql);
                              $total = $result->fetchColumn();
                              $total = $total ? $total : 0;
                          } catch(Exception $e) { $total = 0; }
                        ?>
                        <div class="content">
                            <div class="text">VENTAS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COMPARATIVA -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="containers"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PRODUCTOS DEL AÑO -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <?php
                                        date_default_timezone_set('America/Lima');
                                        $year = date('Y');
                                    ?>
                                    <h2>PRODUCTOS DEL AÑO <?php echo $year; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div id="chart-container">
                            <canvas id="mycanvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ÚLTIMOS PRODUCTOS -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-6 col-sm-6">
                                    <h2><strong>ÚLTIMOS PRODUCTOS</strong></h2>
                                </div>
                                <a href="../../folder/productos" class="btn btn-sm btn-danger btn-flat pull-right">Ver todos</a>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>CÓDIGO</th>
                                            <th>PRODUCTO</th>
                                            <th>STOCK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            try { 
                                                $sql = 'SELECT * FROM products ORDER BY id_prod DESC LIMIT 5';
                                                foreach ($connect->query($sql) as $row) {
                                                    ?>
                                                    <tr>
                                                        <td><label class="badge badge-primary"><?php echo $row['codigo']; ?></label></td>
                                                        <td><?php echo $row['nompro']; ?></td>
                                                        <td><?php echo $row['stock']; ?></td>
                                                    </tr>
                                                    <?php 
                                                }
                                            } catch(PDOException $e) {
                                                echo "<tr><td colspan='3'>Hubo un problema: " . $e->getMessage() . "</td></tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
    <script src="../../assets/js/Chart.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script type="text/javascript">
    $(function () { 
        var data_click = <?php echo $click; ?>;
        var data_viewer = <?php echo $viewer; ?>;
        $('#containers').highcharts({
            chart: { type: 'column' },
            title: { text: 'COMPARATIVA DE VENTAS Y COMPRAS' },
            xAxis: { categories: ['2021','2022','2023', '2024','2025','2026','2027'] },
            yAxis: { title: { text: 'MONTO' } },
            series: [
                { name: 'Compras', data: data_click }, 
                { name: 'Ventas', data: data_viewer }
            ]
        });
    });
    </script>

    <!-- Bootstrap Core Js -->
    <script src="../../assets/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="../../assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <script src="../../assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="../../assets/plugins/node-waves/waves.js"></script>
    <script src="../../assets/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Custom Js -->
    <script src="../../assets/js/admin.js"></script>
    <script src="../../assets/js/pages/index.js"></script>
</body>
</html>

