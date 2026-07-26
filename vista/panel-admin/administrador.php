<?php
ob_start();
session_start();

if (!isset($_SESSION['cargo'])) {
    header('Location: ../pages-login.php');
    exit();
}

// 1. Cargar la configuración general y conexión (PDO y MySQLi ya están listos aquí)
require_once '../../assets/db/config.php';

// Si $db no está configurado en config.php, usamos la conexión $connect de PDO
if (!isset($db) && isset($connect)) {
    $db = $connect;
}

try {
    /* Obteniendo datos para la comparativa de Ventas y Compras */
    $sql_ventas = "SELECT SUM(total) as count FROM venta GROUP BY YEAR(fecha) ORDER BY YEAR(fecha)";
    $stmt_v = $db->query($sql_ventas);
    $viewer = json_encode(array_column($stmt_v->fetchAll(), 'count'), JSON_NUMERIC_CHECK) ?: '[]';

    $sql_compras = "SELECT SUM(total) as count FROM compra GROUP BY YEAR(fecha) ORDER BY YEAR(fecha)";
    $stmt_c = $db->query($sql_compras);
    $click = json_encode(array_column($stmt_c->fetchAll(), 'count'), JSON_NUMERIC_CHECK) ?: '[]';

    /* Obtener Totales para los Info-Boxes */
    $total_products    = $db->query("SELECT COUNT(*) FROM products")->fetchColumn() ?: 0;
    $total_categories  = $db->query("SELECT COUNT(*) FROM category")->fetchColumn() ?: 0;
    $total_owners      = $db->query("SELECT COUNT(*) FROM owner")->fetchColumn() ?: 0;
    $total_compras     = $db->query("SELECT SUM(total) FROM compra")->fetchColumn() ?: 0;
    $total_suppliers   = $db->query("SELECT COUNT(*) FROM supplier")->fetchColumn() ?: 0;
    $total_vets        = $db->query("SELECT COUNT(*) FROM veterinarian")->fetchColumn() ?: 0;
    $total_ventas      = $db->query("SELECT SUM(total) FROM venta")->fetchColumn() ?: 0;

} catch (PDOException $e) {
    die("Error al consultar la base de datos: " . $e->getMessage());
}

// Configurar zona horaria
date_default_timezone_set('America/El_Salvador');
$year = date('Y');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Vetdog V.1 | Vetdog - Vetdog Admin Template</title>

    <!-- Google Font & Icons -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
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

    <div class="overlay"></div>

    <!-- Buscador -->
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
            <div class="user-info">
                <div class="image">
                    <img src="../../assets/img/mujerico.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo htmlspecialchars(ucfirst($_SESSION['nombre'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                    <div class="email">
                        <?php echo htmlspecialchars(ucfirst($_SESSION['correo'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
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

            <!-- Menu Navigation -->
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
                            <li><a href="../clientes/nuevo.php">Registrar</a></li>
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

    <!-- CONTENIDO PRINCIPAL -->
    <section class="content">
        <div class="container-fluid">
            <!-- Bloque 1 de Indicadores -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <a href="../../folder/productos">
                            <div class="icon"><i class="material-icons">inbox</i></div>
                        </a>
                        <div class="content">
                            <div class="text">PRODUCTOS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total_products; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <a href="../../folder/categorias">
                            <div class="icon"><i class="material-icons">low_priority</i></div>
                        </a>
                        <div class="content">
                            <div class="text">CATEGORÍAS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total_categories; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <a href="../../folder/clientes">
                            <div class="icon"><i class="material-icons">supervisor_account</i></div>
                        </a>
                        <div class="content">
                            <div class="text">CLIENTES</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total_owners; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <a href="../../folder/compra">
                            <div class="icon"><i class="material-icons">monetization_on</i></div>
                        </a>
                        <div class="content">
                            <div class="text">COMPRAS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total_compras; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bloque 2 de Indicadores -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <a href="../../folder/proveedores">
                            <div class="icon"><i class="material-icons">business</i></div>
                        </a>
                        <div class="content">
                            <div class="text">PROVEEDORES</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total_suppliers; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <a href="../../folder/veterinarios">
                            <div class="icon"><i class="material-icons">person_pin</i></div>
                        </a>
                        <div class="content">
                            <div class="text">VETERINARIOS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total_vets; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <a href="../../folder/venta">
                            <div class="icon"><i class="material-icons">trending_up</i></div>
                        </a>
                        <div class="content">
                            <div class="text">VENTAS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total_ventas; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráfico Highcharts -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="containers"></div>
                        </div>
                    </div>           
                </div>
            </div>

            <!-- Gráfico Stock Canvas -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>PRODUCTOS DEL AÑO <?php echo $year; ?></h2>
                        </div>
                        <div id="chart-container">
                            <canvas id="mycanvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla Últimos Productos -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header clearfix">
                            <h2 class="pull-left"><strong>ÚLTIMOS PRODUCTOS</strong></h2>
                            <a href="../../folder/productos" class="btn btn-sm btn-danger btn-flat pull-right">Ver todos</a>
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
                                        $sql_latest = 'SELECT codigo, nompro, stock FROM products ORDER BY id_prod DESC LIMIT 5';
                                        foreach ($db->query($sql_latest) as $row) {
                                            ?>
                                            <tr>
                                                <td><label class="badge badge-primary"><?php echo htmlspecialchars($row['codigo'], ENT_QUOTES, 'UTF-8'); ?></label></td>
                                                <td><?php echo htmlspecialchars($row['nompro'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            </tr>
                                            <?php 
                                        }
                                    } catch(PDOException $e) {
                                        echo "<tr><td colspan='3'>Error al cargar datos</td></tr>";
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

    <!-- Scripts JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="../../assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <script src="../../assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="../../assets/plugins/node-waves/waves.js"></script>
    <script src="../../assets/plugins/jquery-countto/jquery.countTo.js"></script>
    
    <!-- JS Librerías Gráficas -->
    <script src="../../assets/js/Chart.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <!-- Custom JavaScript Config -->
    <script type="text/javascript">
        // Ocultar la pantalla de carga automáticamente por seguridad
        $(document).ready(function() {
            setTimeout(function () {
                $('.page-loader-wrapper').fadeOut();
            }, 500);
        });

        $(function () { 
            var data_click = <?php echo $click; ?>;
            var data_viewer = <?php echo $viewer; ?>;
            if ($('#containers').length) {
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
            }
        });

        $(document).ready(function(){
            $.ajax({
                url: "drap.php",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    var player = [];
                    var stock = [];
                    for(var i in data) {
                        player.push("Código " + data[i].codigo);
                        stock.push(data[i].stock);
                    }
                    var chartdata = {
                        labels: player,
                        datasets : [{
                            label: 'Productos stock',
                            backgroundColor: 'rgba(200, 200, 200, 0.75)',
                            borderColor: 'rgba(200, 200, 200, 0.75)',
                            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                            hoverBorderColor: 'rgba(200, 200, 200, 1)',
                            data: stock
                        }]
                    };
                    var ctx = $("#mycanvas");
                    if (ctx.length) {
                        new Chart(ctx, { type: 'bar', data: chartdata });
                    }
                },
                error: function(err) {
                    console.error("Error al cargar datos de drap.php:", err);
                }
            });
        });
    </script>
    
    <script src="../../assets/js/admin.js"></script>
    <script src="../../assets/js/pages/index.js"></script>
</body>
</html>