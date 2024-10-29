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
                    <h1 class="my-4">Lista de Productos</h1>
                    <div class="row justify-content-center">

                        <?php
                        // Inicializar cURL para obtener la lista de productos
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://172.20.10.3/api/products?display=full',
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

                        // Ejecutar la solicitud cURL para obtener los productos
                        $response = curl_exec($curl);
                        curl_close($curl);

                        // Convertir la respuesta XML en un objeto SimpleXMLElement
                        $xml = simplexml_load_string($response);

                        // Comprobar si la carga del XML fue exitosa
                        if ($xml === false) {
                            echo "Error al procesar los datos XML.";
                            exit;
                        }

                        // Función para obtener el nombre de la categoría
                        function getCategoryName($categoryId, $languageId = 1)
                        {
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => "http://172.20.10.3/api/categories/$categoryId",
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_HTTPHEADER => array(
                                    'Authorization: Basic VVdVN1oxUURJNEFGOFlaTEYzQ0c1UjZFQlhSNURCOE06',
                                ),
                            ));

                            $categoryResponse = curl_exec($curl);
                            curl_close($curl);

                            if ($categoryResponse) {
                                $categoryXml = simplexml_load_string($categoryResponse);

                                foreach ($categoryXml->category->name->language as $language) {
                                    if ((int) $language['id'] == $languageId) {
                                        return (string) $language;
                                    }
                                }
                            }
                            return 'Categoría no encontrada';
                        }

                        function getImageUrl($productId, $imageId)
                        {
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => "http://172.20.10.3/api/images/products/$productId/$imageId",
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_HTTPHEADER => array(
                                    "Authorization: Basic VVdVN1oxUURJNEFGOFlaTEYzQ0c1UjZFQlhSNURCOE06",
                                ),
                            ));

                            $imageData = curl_exec($curl);
                            curl_close($curl);

                            if ($imageData === false) {
                                return null; // Error al obtener la imagen
                            }

                            return 'data:image/jpeg;base64,' . base64_encode($imageData); // Retornar imagen como base64

                        }

                        echo "<div class='container mt-5'>";
                        echo "<table class='table table-bordered table-hover'>";
                        echo "<thead class='table-primary'>";
                        echo "<tr>
        <th>ID</th>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Referencia</th>
        <th>Categoría</th>
        <th>Precio (imp. excl.)</th>
        <th>Precio (imp. incl.)</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>";
                        echo "</thead><tbody>";

                        // Recorrer cada producto y mostrar en la tabla
                        foreach ($xml->products->product as $product) {
                            $productId = (int) $product->id;
                            $categoryId = (int) $product->id_category_default;
                            $categoryName = getCategoryName($categoryId);
                            $imageId = (int) $product->id_default_image;
                            $imageSrc = getImageUrl($productId, $imageId);

                            echo "<tr>";
                            echo "<td>" . $productId . "</td>";
                            echo "<td><img src='" . $imageSrc . "' alt='Imagen del producto' class='img-thumbnail' width='50'></td>";
                            echo "<td>" . $product->name->language . "</td>";
                            echo "<td>" . $product->reference . "</td>";
                            echo "<td>" . $categoryName . "</td>";
                            echo "<td>" . $product->price . "</td>";

                            if ($product->id_tax_rules_group == 0) {
                                $priceWithTax = number_format($product->price * 1, 2);
                            } else if ($product->id_tax_rules_group == 1) {
                                $priceWithTax = number_format($product->price * 1.16, 2);
                            } else if ($product->id_tax_rules_group == 2) {
                                $priceWithTax = number_format($product->price * 1.08, 2);
                            }

                            echo "<td><p class='card-text'>$" . $priceWithTax . "</p></td>";
                            echo "<td>" . ($product->active == 1 ? 'Activo' : 'Inactivo') . "</td>";
                            echo "<td>


        <div class='card-footer text-center'>
            <a href='updateProduct.php?id={$product->id}' class='btn btn-primary btn-sm'>Modificar</a>
            <a href='deleteProduct.php?id={$product->id}' 
               class='btn btn-danger btn-sm' 
               onclick=\"return confirm('¿Estás seguro de que deseas eliminar este registro?');\">Eliminar</a>
        </div>
          </td>";
                            echo "</tr>";
                        }

                        echo "</tbody></table>";
                        echo "</div>";
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