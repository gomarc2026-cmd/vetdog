<?php
// 1. Iniciar búfer de salida para evitar errores de envio de encabezados
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
                <a class="navbar-brand" href="../panel-admin/administrador.php"> VETDOG - DASHBOARD </a>
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
                    <img src="../../assets/img/mujerico.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo ucfirst($_SESSION['nombre'] ?? ''); ?></div>
                    <div class="email"><?php echo ucfirst($_SESSION['correo'] ?? ''); ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="../config/configuracion.php"><i class="material-icons">brightness_low</i>Mi Cuenta</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../pages-logout.php"><i class="material-icons">input</i>Cerrar Sesión</a></li>
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
                <strong>Estimado usuario!</strong> Los campos remarcados con <span class="text-danger">*</span> son necesarios.
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                REGISTRO DE CLIENTES
                                <small>Registra cualquier cliente...</small>
                            </h2>
                        </div>

                        <div class="body">
                            <form method="POST" autocomplete="off" enctype="multipart/form-data">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="control-label">DNI del cliente<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="dni_due" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="8" required class="form-control" placeholder="DNI del cliente..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Nombre del cliente<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nom_due" required class="form-control" placeholder="Nombre del cliente..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Apellido del cliente<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="ape_due" required class="form-control" placeholder="Apellido del cliente..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Telefono movil<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="movil" required onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="9" class="form-control" placeholder="Telefono movil..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Telefono fijo</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="fijo" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="6" class="form-control" placeholder="Telefono fijo..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Correo</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" name="correo" class="form-control" placeholder="Correo..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Direccion</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="direc" class="form-control" placeholder="Direccion..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Usuario<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="usuario" required class="form-control" placeholder="Usuario..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Contraseña<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" name="contra" required class="form-control" placeholder="Contraseña..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Imagen</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" id="imagen" name="foto" onchange="readURL(this);" data-toggle="tooltip">
                                                <img id="blah" src="http://placehold.it/180" alt="your image" style="max-width:90px;" />  
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

                                <div class="container-fluid" align="center">
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3"></div>
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <a type="button" href="../../folder/clientes" class="btn bg-red"><i class="material-icons">cancel</i> LIMPIAR </a>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <button class="btn bg-green" name="agregar">GUARDAR<i class="material-icons">save</i></button>
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
                $sql2 = "INSERT INTO owner(dni_due,nom_due,ape_due,movil,fijo,correo,direc,estado,usuario,contra,cargo,foto) 
                         VALUES ('$dni_due','$nom_due','$ape_due','$movil','$fijo','$correo','$direc','$estado','$usuario','$contra','$cargo','$foto_nombre')";
                
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
                    $insertStmt = $connect->prepare("INSERT INTO owner(dni_due,nom_due,ape_due,movil,fijo,correo,direc,estado,usuario,contra,cargo,foto) 
                                                     VALUES (:dni_due, :nom_due, :ape_due, :movil, :fijo, :correo, :direc, :estado, :usuario, :contra, :cargo, :foto)");
                    
                    $success = $insertStmt->execute([
                        ':dni_due' => $dni_due, ':nom_due' => $nom_due, ':ape_due' => $ape_due,
                        ':movil' => $movil, ':fijo' => $fijo, ':correo' => $correo,
                        ':direc' => $direc, ':estado' => $estado, ':usuario' => $usuario,
                        ':contra' => $contra, ':cargo' => $cargo, ':foto' => $foto_nombre
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