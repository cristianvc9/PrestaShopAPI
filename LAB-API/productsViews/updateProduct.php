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
                    <h2 class="mb-4">Editar Producto</h2>
                    <div class="row justify-content-center">
                        <?php
                        ini_set('display_errors', 1);
                        ini_set('display_startup_errors', 1);
                        error_reporting(E_ALL);

                        $productId = isset($_GET['id']) ? $_GET['id'] : 43; 
                        $apiUrl = "http://172.20.10.3/api/products/$productId"; 
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

                        curl_close($ch);

                        // Procesa la respuesta XML para obtener los datos del producto
                        try {
                            $productDetails = new SimpleXMLElement($response);
                            $name = htmlspecialchars($productDetails->product->name->language[0]);
                            $reference = htmlspecialchars($productDetails->product->reference);
                            $description = htmlspecialchars($productDetails->product->description->language[0]);
                            $category_id = htmlspecialchars($productDetails->product->id_category_default);
                            $price = htmlspecialchars($productDetails->product->price);
                            $active = htmlspecialchars($productDetails->product->active);
                        } catch (Exception $e) {
                            echo 'Error al procesar el XML: ' . $e->getMessage();
                            exit;
                        }

                        // Verifica si se envió el formulario
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $name = $_POST['name'];
                            $reference = $_POST['reference'];
                            $description = $_POST['description'];
                            $category_id = $_POST['category'];
                            $price = $_POST['price'];
                            $active = $_POST['active'];

                            // Construye el XML
                            $xmlData = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
    <product>
        <id><![CDATA[$productId]]></id>
        <id_category_default><![CDATA[$category_id]]></id_category_default>
        <price><![CDATA[$price]]></price>
        <name>
            <language id="1"><![CDATA[$name]]></language>
        </name>
        <description>
            <language id="1"><![CDATA[$description]]></language>
        </description>
        <show_price><![CDATA[1]]></show_price>
        <active><![CDATA[$active]]></active>
        <reference><![CDATA[$reference]]></reference>
        <associations>
            <categories>
                <category>
                    <id><![CDATA[$category_id]]></id>
                </category>
            </categories>
        </associations>
    </product>
</prestashop>
XML;

                            // Inicializa cURL para enviar la solicitud PUT
                            $curl = curl_init();

                            // Configura cURL para enviar la solicitud PUT
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => $apiUrl,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_CUSTOMREQUEST => 'PUT',
                                CURLOPT_POSTFIELDS => $xmlData,
                                CURLOPT_HTTPHEADER => array(
                                    'Content-Type: application/xml',
                                    'Authorization: Basic ' . base64_encode($apiKey . ':')
                                ),
                            ));

                            // Ejecuta la solicitud y obtiene la respuesta
                            $response = curl_exec($curl);

                            // Maneja errores
                            if (curl_errno($curl)) {
                                echo 'Error en cURL: ' . curl_error($curl);
                            } else {
                                echo "<div class='container mt-5'>";
                                echo "<div class='alert alert-success' role='alert'>";
                                echo "El Producto se ha actualizado correctamente.";
                                echo "</div>";
                                echo "<a href='showProducts.php' class='btn btn-primary'>Volver al listado de Productos</a>";
                                echo "</div>";
                            }

                            // Cierra cURL
                            curl_close($curl);
                        }
                        ?>
                        <div class="container my-5">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre del Producto:</label>
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $name; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="reference" class="form-label">Referencia:</label>
                                    <input type="text" id="reference" name="reference" class="form-control" value="<?php echo $reference; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Descripción:</label>
                                    <textarea id="description" name="description" class="form-control" rows="4" required><?php echo $description; ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Categoría:</label>
                                    <input type="number" id="category" name="category" class="form-control" value="<?php echo $category_id; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Precio sin impuestos:</label>
                                    <input type="number" id="price" name="price" class="form-control" step="0.01" value="<?php echo $price; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="active" class="form-label">Activado:</label>
                                    <select id="active" name="active" class="form-select" required>
                                        <option value="1" <?php echo ($active == 1) ? 'selected' : ''; ?>>Sí</option>
                                        <option value="0" <?php echo ($active == 0) ? 'selected' : ''; ?>>No</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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