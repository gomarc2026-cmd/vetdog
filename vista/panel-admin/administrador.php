<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../assets/db/config.php';

// Validar permisos de administrador
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
    header('Location: /vista/pages-login.php');
    exit;
}

/* --- OBTENCIÓN DE DATOS PARA HIGHCHARTS USANDO PDO --- */
try {
    // 1. Obtener Ventas agrupadas por año
    $sqlVentas = "SELECT YEAR(fec_registro) as anio, SUM(total) as count FROM venta GROUP BY YEAR(fec_registro) ORDER BY anio ASC";
    $stmtVentas = $connect->query($sqlVentas);
    $ventasData = $stmtVentas->fetchAll(PDO::FETCH_ASSOC);

    // 2. Obtener Compras agrupadas por año
    $sqlCompras = "SELECT YEAR(fec_registro) as anio, SUM(total) as count FROM compra GROUP BY YEAR(fec_registro) ORDER BY anio ASC";
    $stmtCompras = $connect->query($sqlCompras);
    $comprasData = $stmtCompras->fetchAll(PDO::FETCH_ASSOC);

    // Generar categorías únicas (años)
    $anios = array_unique(array_merge(
        array_column($ventasData, 'anio'),
        array_column($comprasData, 'anio')
    ));
    sort($anios);

    // Mapear totales a cada año para mantener consistencia en los ejes
    $click = [];  // Compras
    $viewer = []; // Ventas

    foreach ($anios as $anio) {
        $c = array_filter($comprasData, fn($item) => $item['anio'] == $anio);
        $v = array_filter($ventasData, fn($item) => $item['anio'] == $anio);

        $click[] = !empty($c) ? floatval(reset($c)['count']) : 0;
        $viewer[] = !empty($v) ? floatval(reset($v)['count']) : 0;
    }

    $jsonAnios = json_encode(array_values($anios));
    $jsonClick = json_encode($click, JSON_NUMERIC_CHECK);
    $jsonViewer = json_encode($viewer, JSON_NUMERIC_CHECK);

} catch (Exception $e) {
    $jsonAnios = json_encode([]);
    $jsonClick = json_encode([]);
    $jsonViewer = json_encode([]);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Vetdog V.1 | Vetdog - Admin Template</title>
    
    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    
    <!-- CSS Plugins -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/plugins/node-waves/waves.css" rel="stylesheet" />
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
                    <div class="circle-clipper left"><div class="circle"></div></div>
                    <div class="circle-clipper right"><div class="circle"></div></div>
                </div>
            </div>
            <p>Cargando...</p>
        </div>
    </div>

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <!-- Buscador Lupa -->
    <div class="search-bar">
        <div class="search-icon"><i class="material-icons">search</i></div>
        <input type="text" placeholder="Buscar...">
        <div class="close-search"><i class="material-icons">close</i></div>
    </div>

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
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../../assets/img/mujerico.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo isset($_SESSION['nombre']) ? ucfirst($_SESSION['nombre']) : 'Admin'; ?>
                    </div>
                    <div class="email">
                        <?php echo isset($_SESSION['correo']) ? $_SESSION['correo'] : ''; ?>
                    </div>
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
    </section>

    <!-- CONTENIDO PRINCIPAL DE LA PÁGINA -->
    <section class="content">
        <div class="container-fluid">
            <div class="block-header"></div>

            <!-- SubMenu 1 (Kpis) -->
            <div class="row clearfix">
                <!-- PRODUCTOS -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <a href="../../folder/productos"><div class="icon"><i class="material-icons">inbox</i></div></a>
                        <?php
                            try {
                                $total = $connect->query("SELECT COUNT(*) FROM products")->fetchColumn();
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
                        <a href="../../folder/categorias"><div class="icon"><i class="material-icons">low_priority</i></div></a>
                        <?php
                            try {
                                $total = $connect->query("SELECT COUNT(*) FROM category")->fetchColumn();
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
                        <a href="../../folder/clientes"><div class="icon"><i class="material-icons">supervisor_account</i></div></a>
                        <?php
                            try {
                                $total = $connect->query("SELECT COUNT(*) FROM owner")->fetchColumn();
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
                        <a href="../../folder/compra"><div class="icon"><i class="material-icons">monetization_on</i></div></a>
                        <?php
                            try {
                                $total = $connect->query("SELECT SUM(total) FROM compra")->fetchColumn();
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

            <!-- SubMenu 2 (Kpis) -->
            <div class="row clearfix">
                <!-- PROVEEDORES -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <a href="../../folder/proveedores"><div class="icon"><i class="material-icons">business</i></div></a>
                        <?php
                            try {
                                $total = $connect->query("SELECT COUNT(*) FROM supplier")->fetchColumn();
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
                        <a href="../../folder/veterinarios"><div class="icon"><i class="material-icons">person_pin</i></div></a>
                        <?php
                            try {
                                $total = $connect->query("SELECT COUNT(*) FROM veterinarian")->fetchColumn();
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
                        <a href="../../folder/venta"><div class="icon"><i class="material-icons">trending_up</i></div></a>
                        <?php
                            try {
                                $total = $connect->query("SELECT SUM(total) FROM venta")->fetchColumn();
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

            <!-- COMPARATIVA HIGHCHARTS -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="containers" style="width: 100%; height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ÚLTIMOS PRODUCTOS -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-6 col-sm-6">
                                    <h2><strong>ÚLTIMOS PRODUCTOS</strong></h2>
                                </div>
                                <div class="col-xs-6 col-sm-6 text-right">
                                    <a href="../../folder/productos" class="btn btn-sm btn-danger btn-flat">Ver todos</a>
                                </div>
                            </div>
                        </div>
                        <div class="body table-responsive">
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
                                            $sql = 'SELECT codigo, nompro, stock FROM products ORDER BY id_prod DESC LIMIT 5';
                                            $stmt = $connect->query($sql);
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                    <td><label class="label label-primary"><?php echo htmlspecialchars($row['codigo']); ?></label></td>
                                                    <td><?php echo htmlspecialchars($row['nompro']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['stock']); ?></td>
                                                </tr>
                                                <?php 
                                            }
                                        } catch(PDOException $e) {
                                            echo "<tr><td colspan='3'>Error al obtener productos: " . $e->getMessage() . "</td></tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JS Core & Plugins -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script type="text/javascript">
    $(function () { 
        var data_click = <?php echo $jsonClick; ?>;
        var data_viewer = <?php echo $jsonViewer; ?>;
        var categories = <?php echo $jsonAnios; ?>;

        $('#containers').highcharts({
            chart: { type: 'column' },
            title: { text: 'COMPARATIVA DE VENTAS Y COMPRAS' },
            xAxis: { categories: categories },
            yAxis: { title: { text: 'MONTO' } },
            series: [
                { name: 'Compras', data: data_click }, 
                { name: 'Ventas', data: data_viewer }
            ]
        });
    });
    </script>

    <!-- Bootstrap & AdminBSB Plugins -->
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
