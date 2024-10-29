<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index</title>
    <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="../index.php" class="text-nowrap logo-img">
                        <img src="../assets/images/logos/logo.svg" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                            <span class="hide-menu">Inicio</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../admin.php" aria-expanded="false">
                                <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                                <span class="hide-menu">Administrador</span>
                            </a>
                        </li>
                        <li>
                            <span class="sidebar-divider lg"></span>
                        </li>
                        <li class="nav-small-cap">
                            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                            <span class="hide-menu">Opciones</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../productsViews/showProducts.php" aria-expanded="false">
                                <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
                                <span class="hide-menu">Listar productos</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../productsViews/form.html" aria-expanded="false">
                                <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
                                <span class="hide-menu">Registrar Producto</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="form.html" aria-expanded="false">
                                <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
                                <span class="hide-menu">Registrar Cliente</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="showCustomer.php" aria-expanded="false">
                                <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
                                <span class="hide-menu">Listar Clientes</span>
                            </a>
                        </li>
                        <li>
                            <span class="sidebar-divider lg"></span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../index.php" aria-expanded="false">
                                <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
                                <span class="hide-menu">Ver mi Tienda</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="body-wrapper">
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="javascript:void(0)">
                                <iconify-icon icon="solar:bell-linear" class="fs-6"></iconify-icon>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35"
                                        class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->

            <div class="body-wrapper-inner">
                <div class="container-fluid text-center">
                    <h1 class="my-4">Lista de Clientes</h1>
                    <div class="row justify-content-center">


                        <?php
                        // Inicializar cURL para obtener la lista de clientes
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://10.0.0.36/api/customers?display=full',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'GET',
                            CURLOPT_HTTPHEADER => array(
                                'Authorization: Basic VVdVN1oxUURJNEFGOFlaTEYzQ0c1UjZFQlhSNURCOE06',
                            ),
                        ));

                        // Ejecutar la solicitud cURL para obtener los clientes
                        $response = curl_exec($curl);
                        curl_close($curl);

                        // Convertir la respuesta XML en un objeto SimpleXMLElement
                        $xml = simplexml_load_string($response);

                        // Comprobar si la carga del XML fue exitosa
                        if ($xml === false) {
                            echo "<div class='alert alert-danger'>Error al procesar los datos XML.</div>";
                            exit;
                        }

                        // Recorrer cada cliente y mostrar en tarjetas (cards)
                        foreach ($xml->customers->customer as $customer) {
                            $gender = ($customer->id_gender == 1) ? 'Sr.' : (($customer->id_gender == 2) ? 'Sra.' : 'No especificado');
                            $activeStatus = ($customer->active == '1') ? 'Sí' : 'No';
                            echo "
            <div class='col'>
                <div class='card h-100 shadow-sm'>
                    <div class='card-body'>
                        <h5 class='card-title'>Cliente ID: {$customer->id}</h5>
                        <p class='card-text'><strong>Tratamiento:</strong> {$gender}</p>
                        <p class='card-text'><strong>Nombre:</strong> {$customer->firstname} {$customer->lastname}</p>
                        <p class='card-text'><strong>Correo Electrónico:</strong> {$customer->email}</p>
                        <p class='card-text'><strong>Fecha de Nacimiento:</strong> {$customer->birthday}</p>
                        <p class='card-text'><strong>Activo:</strong> {$activeStatus}</p>
                    </div>
        <div class='card-footer text-center'>
            <a href='editarCliente.php?id={$customer->id}' class='btn btn-primary btn-sm'>Modificar</a>
            <a href='deleteCustomer.php?id={$customer->id}' 
               class='btn btn-danger btn-sm' 
               onclick=\"return confirm('¿Estás seguro de que deseas eliminar este registro?');\">Eliminar</a>
        </div>

                </div>
            </div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>