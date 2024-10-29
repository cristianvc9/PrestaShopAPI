<?php
if (!isset($_GET['categoria_id'])) {
    echo "ID de categoría no proporcionado.";
    exit;
}

$categoriaId = (int)$_GET['categoria_id'];
$authHeader = "Authorization: Basic VVdVN1oxUURJNEFGOFlaTEYzQ0c1UjZFQlhSNURCOE06";

// Obtener los productos de la categoría
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://172.20.10.3/api/products?display=full&filter[id_category_default]=$categoriaId",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array($authHeader),
));
$response = curl_exec($curl);
curl_close($curl);

$xml = simplexml_load_string($response);
if ($xml === false) {
    echo "Error al cargar los productos de la categoría.";
    exit;
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Productos por Categoría</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Mi Tienda</a>
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
                        <a class="nav-link" href="#">Administrar Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Administrar Clientes</a>
                    </li>
                </ul>
                <form class="form-inline ml-auto">
                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h2>Productos en la categoría seleccionada</h2>
        <div class="row">
            <?php foreach ($xml->products->product as $product): ?>
                <?php

                $productId = (int)$product->id;
                $productName = $product->name->language;
                $productPrice = $product->price;
                $imageId = (int)$product->id_default_image;
                $imageSrc = getImageUrl($productId, $imageId);
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
                            <a href="productDetail.php?id=<?php echo $productId; ?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="../index.php" class="btn btn-secondary mt-3">Volver a todas las categorías</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>