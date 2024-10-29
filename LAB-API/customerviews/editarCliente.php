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
                    <h2 class="text-center mb-4">Editar Cliente</h2>
                    <div class="row justify-content-center">

                        <?php
                        ini_set('display_errors', 1);
                        ini_set('display_startup_errors', 1);
                        error_reporting(E_ALL);

                        $customerId = isset($_GET['id']) ? $_GET['id'] : 1;
                        $apiUrl = "http://172.20.10.3/api/customers/$customerId";
                        $apiKey = 'UWU7Z1QDI4AF8YZLF3CG5R6EBXR5DB8M';

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $apiUrl);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                        curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ':');
                        $response = curl_exec($ch);

                        if (curl_errno($ch)) {
                            echo 'Error en cURL: ' . curl_error($ch);
                            curl_close($ch);
                            exit;
                        }

                        try {
                            $customerDetails = new SimpleXMLElement($response);

                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                $treatment = $_POST['treatment'];
                                $firstname = $_POST['firstname'];
                                $lastname = $_POST['lastname'];
                                $email = $_POST['email'];
                                $birthday = $_POST['birthday'];
                                $active = isset($_POST['active']) ? 1 : 0;

                                $customerDetails->customer->id_gender = $treatment;
                                $customerDetails->customer->firstname = $firstname;
                                $customerDetails->customer->lastname = $lastname;
                                $customerDetails->customer->email = $email;
                                $customerDetails->customer->birthday = $birthday;
                                $customerDetails->customer->active = $active;

                                $updatedCustomerXml = $customerDetails->asXML();

                                curl_setopt($ch, CURLOPT_URL, $apiUrl);
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $updatedCustomerXml);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                    'Content-Type: application/xml',
                                    'Content-Length: ' . strlen($updatedCustomerXml)
                                ]);

                                $putResponse = curl_exec($ch);

                                if ($putResponse === false) {
                                    echo 'Error al hacer la solicitud PUT: ' . curl_error($ch);
                                } else {
                                    echo "<div class='container mt-5'>";
                                    echo "<div class='alert alert-success' role='alert'>";
                                    echo "El cliente se ha actualizado correctamente.";
                                    echo "</div>";
                                    echo "<a href='showCustomer.php' class='btn btn-primary'>Volver al listado de clientes</a>";
                                    echo "</div>";
                                }
                            }

                            curl_close($ch);
                        } catch (Exception $e) {
                            echo 'Error al procesar el XML: ' . $e->getMessage();
                            exit;
                        }
                        ?>



                        <div class="container mt-5">
                            <form method="POST" class="mx-auto" style="max-width: 600px;">
                                <div class="mb-3">
                                    <label for="treatment" class="form-label">Tratamiento:</label>
                                    <select id="treatment" name="treatment" class="form-select" required>
                                        <option value="1" <?php echo ($customerDetails->customer->id_gender == 1) ? 'selected' : ''; ?>>Sr.</option>
                                        <option value="2" <?php echo ($customerDetails->customer->id_gender == 2) ? 'selected' : ''; ?>>Sra.</option>
                                        <option value="0" <?php echo ($customerDetails->customer->id_gender != 1 && $customerDetails->customer->id_gender != 2) ? 'selected' : ''; ?>>Desconocido</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="firstname" class="form-label">Nombres:</label>
                                    <input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo htmlspecialchars($customerDetails->customer->firstname); ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="lastname" class="form-label">Apellidos:</label>
                                    <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo htmlspecialchars($customerDetails->customer->lastname); ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo Electrónico:</label>
                                    <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($customerDetails->customer->email); ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="birthday" class="form-label">Fecha de Nacimiento:</label>
                                    <input type="date" id="birthday" name="birthday" class="form-control" value="<?php echo htmlspecialchars($customerDetails->customer->birthday); ?>" required>
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" id="active" name="active" class="form-check-input" <?php echo ($customerDetails->customer->active == 1) ? 'checked' : ''; ?>>
                                    <label for="active" class="form-check-label">Activo</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                            </form>
                        </div>
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