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
                            <a class="sidebar-link" href="showProducts.php" aria-expanded="false">
                                <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
                                <span class="hide-menu">Listar productos</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="form.html" aria-expanded="false">
                                <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
                                <span class="hide-menu">Registrar Producto</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../customerviews/form.html" aria-expanded="false">
                                <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
                                <span class="hide-menu">Registrar Cliente</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../customerviews/showCustomer.php" aria-expanded="false">
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
                    <h2 class="mb-4">Registrar un Nuevo Producto</h2>
                    <div class="row justify-content-center">

                        <?php
                        $name = $_POST['name'];
                        $reference = $_POST['reference'];
                        $descripcion = $_POST['descripcion'];
                        $category_id = $_POST['category'];
                        $price = $_POST['price'];
                        $active = $_POST['active'];

                        // Creamos el XML para la solicitud
                        // Creamos el XML para la solicitud
                        $xml = new SimpleXMLElement('<prestashop/>');
                        $xml->addAttribute('xmlns:xlink', 'http://www.w3.org/1999/xlink');

                        $product = $xml->addChild('product');

                        // ID de la categoría por defecto
                        $product->addChild('id_category_default', $category_id);

                        // Precio
                        $product->addChild('price', $price);

                        // Nombre con lenguaje específico
                        $nameElement = $product->addChild('name');
                        $nameLang = $nameElement->addChild('language', $name);
                        $nameLang->addAttribute('id', '1'); // ID de idioma

                        // Descripción del producto con lenguaje específico
                        $descElement = $product->addChild('description');
                        $descLang = $descElement->addChild('language', $descripcion);
                        $descLang->addAttribute('id', '1'); // ID de idioma

                        // Mostrar precio
                        $product->addChild('show_price', '1');

                        // Estado activo
                        $product->addChild('active', $active);

                        // Referencia del producto
                        $product->addChild('reference', $reference);

                        // Asociación de categorías
                        $associations = $product->addChild('associations');
                        $categories = $associations->addChild('categories');
                        $category = $categories->addChild('category');
                        $category->addChild('id', $category_id);

                        // Convertimos el objeto SimpleXMLElement a string XML
                        $xml_string = $xml->asXML();


                        // URL de la API de PrestaShop (actualiza con tu URL)
                        $url = 'http://10.0.0.36/api/products';

                        // API Key para autenticar la solicitud (debe estar habilitada en PrestaShop)
                        $api_key = 'UWU7Z1QDI4AF8YZLF3CG5R6EBXR5DB8M';

                        // Inicializamos cURL
                        $ch = curl_init();

                        // Configuramos cURL para realizar la solicitud POST
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', 'Authorization: Basic ' . base64_encode($api_key . ':')));
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_string);

                        // Ejecutamos la solicitud
                        $response = curl_exec($ch);

                        // Verificamos si hubo errores
                        if (curl_errno($ch)) {
                            echo 'Error:' . curl_error($ch);
                        } else {
                            echo "<div class='container mt-5'>";
                            echo "<div class='alert alert-success' role='alert'>";
                            echo "El Producto se ha registrado correctamente.";
                            echo "</div>";
                            echo "<a href='showProducts.php' class='btn btn-primary'>Volver al listado de Productos</a>";
                            echo "</div>";
                        }

                        // Cerramos cURL
                        curl_close($ch);
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