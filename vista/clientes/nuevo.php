<?php
// 1. Iniciar búfer de salida para evitar errores de envío de encabezados
ob_start();

// 2. Iniciar sesión
session_start();

// 3. Validar si el usuario está autenticado
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
    header('Location: ../pages-login.php');
    exit();
}

// 4. Incluir la configuración global de conexión (Aiven MySQL SSL / PDO)
require_once '../../assets/db/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Vetdog V.1 | Registrar Cliente</title>
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../../assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <!-- Bootstrap DatePicker Css -->
    <link href="../../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    <!-- Google Font - Iconos -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

    <!-- ESTILOS MODO OSCURO PERSONALIZADOS -->
    <style>
        body {
            background-color: #0f172a !important;
            font-family: 'Poppins', sans-serif !important;
            color: #e2e8f0 !important;
        }
        /* Topbar / Navbar */
        .navbar {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
            border-bottom: 1px solid #334155;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }
        .navbar-brand {
            color: #38bdf8 !important;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        /* Sidebar */
        .sidebar {
            background-color: #1e293b !important;
            border-right: 1px solid #334155;
            box-shadow: 2px 0 10px rgba(0,0,0,0.2);
        }
        .sidebar .user-info {
            background: linear-gradient(to right, #1e293b, #0f172a) !important;
            border-bottom: 1px solid #334155;
        }
        .sidebar .user-info .info-container .name, 
        .sidebar .user-info .info-container .email {
            color: #f1f5f9 !important;
        }
        .sidebar .menu .list a {
            color: #94a3b8 !important;
        }
        .sidebar .menu .list a:hover {
            background-color: #334155 !important;
            color: #38bdf8 !important;
        }
        .sidebar .menu .list li.active > a {
            background-color: #0284c7 !important;
            color: #ffffff !important;
            border-radius: 8px;
            margin: 0 10px;
            width: auto;
        }
        .sidebar .menu .list .header {
            background-color: transparent !important;
            color: #64748b !important;
            font-weight: 600;
        }
        .sidebar .menu .list .ml-menu {
            background-color: #0f172a !important;
        }
        /* Tarjetas / Formulario */
        .card {
            background: #1e293b !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3) !important;
            border: 1px solid #334155 !important;
        }
        .card .header {
            border-bottom: 1px solid #334155 !important;
            padding: 20px 25px !important;
        }
        .card .header h2 {
            color: #f8fafc !important;
            font-weight: 600;
        }
        .card .header h2 small {
            color: #94a3b8 !important;
        }
        /* Controles de Formulario */
        label.control-label {
            color: #cbd5e1 !important;
            font-weight: 500;
            margin-bottom: 8px;
        }
        .form-control {
            background-color: #0f172a !important;
            border: 1px solid #334155 !important;
            border-radius: 8px !important;
            color: #f8fafc !important;
            padding: 10px 15px !important;
            height: auto !important;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #38bdf8 !important;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15) !important;
        }
        .form-group .form-line:after {
            border-bottom: 2px solid #38bdf8 !important;
        }
        /* Alertas */
        .alert-info {
            background-color: #0369a1 !important;
            border: 1px solid #0284c7 !important;
            color: #e0f2fe !important;
            border-radius: 8px !important;
        }
        /* Subida de Imagen */
        .preview-img-container {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 10px;
        }
        #blah {
            border-radius: 8px;
            border: 2px solid #334155;
            object-fit: cover;
        }
        /* Botones */
        .btn-custom-cancel {
            background-color: #ef4444 !important;
            color: white !important;
            border-radius: 8px !important;
            padding: 10px 24px !important;
            font-weight: 600;
            transition: 0.3s;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }
        .btn-custom-cancel:hover {
            background-color: #dc2626 !important;
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.4);
        }
        .btn-custom-save {
            background-color: #10b981 !important;
            color: white !important;
            border-radius: 8px !important;
            padding: 10px 24px !important;
            font-weight: 600;
            border: none;
            transition: 0.3s;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }
        .btn-custom-save:hover {
            background-color: #059669 !important;
            box-shadow: 0 6px 15px rgba(16, 185, 129, 0.4);
        }
        /* Search bar */
        .search-bar {
            background-color: #1e293b !important;
        }
        .search-bar input[type="text"] {
            color: #ffffff !important;
        }
    </style>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper" style="background: #0f172a;">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-cyan">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p style="color: #94a3b8;">Cargando interfaz...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- LUPA -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="Buscar...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- //LUPA -->

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="../panel-admin/administrador.php"> ⚡ VETDOG - DASHBOARD </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
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
                    <img src="../../assets/img/mujerico.png" width="48" height="48" alt="User" style="border-radius:50%; border:2px solid #38bdf8;" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo ucfirst($_SESSION['nombre'] ?? ''); ?></div>
                    <div class="email"><?php echo ucfirst($_SESSION['correo'] ?? ''); ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="color:#94a3b8;">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right" style="background-color: #1e293b; border: 1px solid #334155;">
                            <li><a href="../config/configuracion.php" style="color:#e2e8f0;"><i class="material-icons" style="color:#38bdf8;">brightness_low</i>Mi Cuenta</a></li>
                            <li role="separator" class="divider" style="background-color:#334155;"></li>
                            <li><a href="../pages-logout.php" style="color:#ef4444;"><i class="material-icons" style="color:#ef4444;">input</i>Cerrar Sesión</a></li>
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
                        <a href="../panel-admin/administrador.php">
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
                            <li><a href="../productos/nuevo.php">Registrar</a></li>
                            <li><a href="../../folder/productos/index.php">Listar / Modificar</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">low_priority</i>
                            <span>CATEGORÍAS</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../categorias/nuevo.php">Registrar</a></li>
                            <li><a href="../../folder/categorias/index.php">Listar / Modificar</a></li>
                        </ul>
                    </li>

                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">supervisor_account</i>
                            <span>CLIENTES</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="active"><a href="../clientes/nuevo.php">Registrar</a></li>
                            <li><a href="../../folder/clientes/index.php">Listar / Modificar</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">business</i>
                            <span>PROVEEDORES</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../proveedores/nuevo.php">Registrar</a></li>
                            <li><a href="../../folder/proveedores/index.php">Listar / Modificar</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person_pin</i>
                            <span>VETERINARIOS</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../veterinarios/nuevo.php">Registrar</a></li>
                            <li><a href="../../folder/veterinarios/index.php">Listar / Modificar</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">flutter_dash</i>
                            <span>MASCOTAS</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../mascotas/nuevo.php">Registrar</a></li>
                            <li><a href="../../folder/mascotas/index.php">Listar / Modificar</a></li>
                            <li><a href="../../folder/tipo/index.php">Tipos</a></li>
                            <li><a href="../../folder/raza/index.php">Razas</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">calendar_today</i>
                            <span>CITAS</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../citas/nuevo.php">Registrar</a></li>
                            <li><a href="../../folder/citas/index.php">Listar / Modificar</a></li>
                            <li><a href="../../folder/servicio/index.php">Servicio</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">shopping_basket</i>
                            <span>COMPRA</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../compra/nuevo.php">Registrar</a></li>
                            <li><a href="../../folder/compra/index.php">Listar / Modificar</a></li>
                            <li><a href="../compra/compras_fecha.php">Consultar por fecha</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">monetization_on</i>
                            <span>VENTA</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../venta/nuevo.php">Registrar</a></li>
                            <li><a href="../../folder/venta/index.php">Listar / Modificar</a></li>
                            <li><a href="../venta/venta_fecha.php">Consultar por fecha</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <aside id="rightsidebar" class="right-sidebar"></aside>
    </section>

    <!--============================CONTENIDO DE LA PÁGINA ==========================================================-->
    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-info">
                <strong>Estimado usuario!</strong> Los campos remarcados con <span style="color:#f87171;">*</span> son necesarios para completar el registro.
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                REGISTRO DE CLIENTES
                                <small>Ingresa la información requerida del nuevo cliente...</small>
                            </h2>
                        </div>

                        <div class="body" style="padding: 30px;">
                            <form method="POST" autocomplete="off" enctype="multipart/form-data">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="control-label">DNI del cliente <span style="color:#f87171;">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="dni_due" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="8" required class="form-control" placeholder="DNI del cliente..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Nombre del cliente <span style="color:#f87171;">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nom_due" required class="form-control" placeholder="Nombre del cliente..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Apellido del cliente <span style="color:#f87171;">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="ape_due" required class="form-control" placeholder="Apellido del cliente..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Fecha de Nacimiento</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="date" name="fecnaci" class="form-control" style="color-scheme: dark;" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Teléfono móvil <span style="color:#f87171;">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="movil" required onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="9" class="form-control" placeholder="Teléfono móvil..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Teléfono fijo</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="fijo" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="6" class="form-control" placeholder="Teléfono fijo..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Correo Electrónico</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" name="correo" class="form-control" placeholder="Correo electrónico..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Dirección</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="direc" class="form-control" placeholder="Dirección..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Usuario <span style="color:#f87171;">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="usuario" required class="form-control" placeholder="Usuario de acceso..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Contraseña <span style="color:#f87171;">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" name="contra" required class="form-control" placeholder="Contraseña..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Fotografía</label>
                                        <div class="form-group">
                                            <div class="form-line preview-img-container">
                                                <input type="file" id="imagen" name="foto" onchange="readURL(this);" class="form-control" style="border:none !important; background:transparent !important;">
                                                <img id="blah" src="http://placehold.it/180" alt="Vista previa" style="max-width:80px; max-height:80px;" />  
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-5" style="display:none;">
                                        <select name="estado" class="form-control show-tick">
                                            <option value="1">1</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-5" style="display:none;">
                                        <select name="cargo" class="form-control show-tick">
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                </div>

                                <hr style="border-top: 1px solid #334155; margin: 25px 0;">

                                <div class="row clearfix" style="text-align: center;">
                                    <div class="col-xs-12">
                                        <a href="../../folder/clientes" class="btn btn-custom-cancel" style="margin-right: 15px;">
                                            <i class="material-icons" style="vertical-align: middle; font-size:18px;">cancel</i> CANCELAR
                                        </a>
                                        <button class="btn btn-custom-save" name="agregar">
                                            <i class="material-icons" style="vertical-align: middle; font-size:18px;">save</i> GUARDAR
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
    <script src="../../assets/js/pages/forms/basic-form-elements.js"></script>
    <script src="../../assets/js/demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!--------------------------------SCRIPT GUARDADO AIVEN----------------------------->
    <?php
    if (isset($_POST["agregar"])) {
        // Asignamos la conexión según la variante configurada en config.php (MySQLi SSL o PDO)
        $conn = $conn_mysqli ?? $db ?? null;

        $dni_due = $_POST['dni_due'];
        $nom_due = $_POST['nom_due'];
        $ape_due = $_POST['ape_due'];
        $fecnaci = !empty($_POST['fecnaci']) ? $_POST['fecnaci'] : date('Y-m-d');
        $movil   = $_POST['movil'];
        $fijo    = $_POST['fijo'];
        $correo  = $_POST['correo'];
        $direc   = $_POST['direc'];
        $estado  = $_POST['estado'];
        $usuario = $_POST['usuario'];
        $contra  = MD5($_POST['contra']);
        $cargo   = $_POST['cargo'];
        $foto_nombre = $_FILES['foto']['name'] ?? '';

        // Si tenemos conexión MySQLi
        if ($conn instanceof mysqli) {
            $sql = "SELECT * FROM owner WHERE dni_due='$dni_due' OR movil='$movil' OR (fijo='$fijo' AND fijo != '')";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                echo '<script type="text/javascript">swal("Oops...!", "Ya existe el registro a agregar!", "error");</script>';
            } else {
                $sql2 = "INSERT INTO owner(dni_due,nom_due,ape_due,fecnaci,movil,fijo,correo,direc,estado,usuario,contra,cargo,foto) 
                         VALUES ('$dni_due','$nom_due','$ape_due','$fecnaci','$movil','$fijo','$correo','$direc','$estado','$usuario','$contra','$cargo','$foto_nombre')";
                
                if (isset($_FILES['foto']['tmp_name']) && $_FILES['foto']['tmp_name'] != '') {
                    move_uploaded_file($_FILES['foto']['tmp_name'], "../../assets/img/subidas/".$foto_nombre);
                }

                if (mysqli_query($conn, $sql2)) {
                    echo '<script type="text/javascript">
                        swal("¡Registrado!", "Agregado correctamente", "success").then(function() {
                            window.location = "../../folder/clientes";
                        });
                    </script>';
                } else {
                    echo '<script type="text/javascript">swal("Oops...!", "No se pudo guardar!", "error");</script>';
                }
            }
        } 
        // Si la conexión es PDO ($connect)
        elseif (isset($connect)) {
            try {
                $stmt = $connect->prepare("SELECT * FROM owner WHERE dni_due = :dni_due OR movil = :movil");
                $stmt->execute([':dni_due' => $dni_due, ':movil' => $movil]);

                if ($stmt->rowCount() > 0) {
                    echo '<script type="text/javascript">swal("Oops...!", "Ya existe el registro a agregar!", "error");</script>';
                } else {
                    $insertStmt = $connect->prepare("INSERT INTO owner(dni_due,nom_due,ape_due,fecnaci,movil,fijo,correo,direc,estado,usuario,contra,cargo,foto) 
                                                     VALUES (:dni_due, :nom_due, :ape_due, :fecnaci, :movil, :fijo, :correo, :direc, :estado, :usuario, :contra, :cargo, :foto)");
                    
                    $success = $insertStmt->execute([
                        ':dni_due' => $dni_due, ':nom_due' => $nom_due, ':ape_due' => $ape_due,
                        ':fecnaci' => $fecnaci, ':movil' => $movil, ':fijo' => $fijo,
                        ':correo' => $correo, ':direc' => $direc, ':estado' => $estado,
                        ':usuario' => $usuario, ':contra' => $contra, ':cargo' => $cargo,
                        ':foto' => $foto_nombre
                    ]);

                    if (isset($_FILES['foto']['tmp_name']) && $_FILES['foto']['tmp_name'] != '') {
                        move_uploaded_file($_FILES['foto']['tmp_name'], "../../assets/img/subidas/".$foto_nombre);
                    }

                    if ($success) {
                        echo '<script type="text/javascript">
                            swal("¡Registrado!", "Agregado correctamente", "success").then(function() {
                                window.location = "../../folder/clientes";
                            });
                        </script>';
                    } else {
                        echo '<script type="text/javascript">swal("Oops...!", "No se pudo guardar!", "error");</script>';
                    }
                }
            } catch (PDOException $e) {
                echo '<script type="text/javascript">swal("Error", "' . addslashes($e->getMessage()) . '", "error");</script>';
            }
        }
    }
    ?>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>