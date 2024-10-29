<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Productos</title>
    <style>
        .category-list {
            position: sticky;
            top: 0;
        }

        .row {
            margin-top: 20px;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            /* Ajusta el alto deseado */
            object-fit: cover;
            /* Ajusta la imagen para que cubra todo el contenedor */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Cris Tienda 2</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Vista Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="productsViews/showProducts.php">Administrar Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customerviews/showCustomer.php">Administrar Clientes</a>
                    </li>
                </ul>
                <form class="form-inline ml-auto">
                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Categorías -->
            <div class="col-md-3">
                <h4>Categorías</h4>
                <ul class="list-group category-list">
                    <?php
                    $categoriesCurl = curl_init();
                    curl_setopt_array($categoriesCurl, array(
                        CURLOPT_URL => 'http://10.0.0.36/api/categories?display=full',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HTTPHEADER => array('Authorization: Basic VVdVN1oxUURJNEFGOFlaTEYzQ0c1UjZFQlhSNURCOE06'),
                    ));
                    $categoriesResponse = curl_exec($categoriesCurl);
                    curl_close($categoriesCurl);
                    $categoriesXml = simplexml_load_string($categoriesResponse);

                    foreach ($categoriesXml->categories->category as $category) {
                        $categoryId = $category->id;
                        $categoryName = $category->name->language;

                        echo '<li class="list-group-item"><a href="productsViews/category.php?categoria_id=' . $categoryId . '">' . $categoryName . '</a></li>';
                    }
                    ?>
                </ul>
            </div>

            <!-- Productos -->
            <div class="col-md-9">
                <div class="row">
                    <?php
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://10.0.0.36/api/products?display=full',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HTTPHEADER => array('Authorization: Basic VVdVN1oxUURJNEFGOFlaTEYzQ0c1UjZFQlhSNURCOE06'),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);

                    $xml = simplexml_load_string($response);

                    function getCategoryName($categoryId, $languageId = 1)
                    {
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "http://10.0.0.36/api/categories/$categoryId",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_HTTPHEADER => array('Authorization: Basic VVdVN1oxUURJNEFGOFlaTEYzQ0c1UjZFQlhSNURCOE06'),
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
                            CURLOPT_URL => "http://10.0.0.36/api/images/products/$productId/$imageId",
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

                    foreach ($xml->products->product as $product) {
                        $productId = (int) $product->id;
                        $categoryId = (int) $product->id_category_default;
                        $categoryName = getCategoryName($categoryId);
                        $imageId = (int) $product->id_default_image;
                        $imageSrc = getImageUrl($productId, $imageId);
                        $productName = $product->name->language;
                        $productReference = $product->reference;
                        $productPrice = $product->price;

                        if ($product->id_tax_rules_group == 0) {
                            $priceWithTax = number_format($productPrice * 1, 2);
                            
                        } else if ($product->id_tax_rules_group == 1) {
                            $priceWithTax = number_format($productPrice * 1.16, 2);
                            
                        } else if ($product->id_tax_rules_group == 2) {
                            $priceWithTax = number_format($productPrice * 1.08, 2);
                            
                        }

                    ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img class="card-img-top" src="<?php echo $imageSrc; ?>" alt="Imagen del producto">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $productName; ?></h5>
                                    <p class="card-text">Precio (con IVA): $<?php echo $priceWithTax; ?></p>
                                    <a href="productsviews/productDetail.php?id=<?php echo $productId; ?>" class="btn btn-primary">Ver Producto</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>