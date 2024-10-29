<?php
if (!isset($_GET['id'])) {
    echo "ID de producto no proporcionado.";
    exit;
}

$productId = (int)$_GET['id'];
$apiUrl = "http://10.0.0.36/api/products/$productId";
$authHeader = "Authorization: Basic VVdVN1oxUURJNEFGOFlaTEYzQ0c1UjZFQlhSNURCOE06";

// Obtener los detalles del producto
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array($authHeader),
));
$response = curl_exec($curl);
curl_close($curl);

$productXml = simplexml_load_string($response);
if ($productXml === false) {
    echo "Error al cargar los datos del producto.";
    exit;
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

$productName = $productXml->product->name->language;
$productPrice = $productXml->product->price;
$reference = $productXml->product->reference;
$categoryId = (int) $productXml->product->id_category_default;
$imageId = (int) $productXml->product->id_default_image;
$imageSrc = getImageUrl($productId, $imageId);
$description = $productXml->product->description->language;

if ($productXml->product->id_tax_rules_group == 0) {
    $priceWithTax = number_format($productPrice * 1, 2);
} else if ($productXml->product->id_tax_rules_group == 1) {
    $priceWithTax = number_format($productPrice * 1.16, 2);
} else if ($productXml->product->id_tax_rules_group == 2) {
    $priceWithTax = number_format($productPrice * 1.08, 2);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Detalle del Producto</title>
</head>

<body>

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
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo $imageSrc; ?>" class="img-fluid" alt="Imagen del producto">
                </div>
                <div class="col-md-6">
                    <h2><?php echo $productName; ?></h2>
                    <p><?php echo $description; ?></p>
                    <p><?php echo $reference; ?></p>
                    <h4>Precio (con IVA): $<?php echo $priceWithTax; ?></h4>
                    <a href="../index.php" class="btn btn-primary">Volver a la tienda</a>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </body>

</html>