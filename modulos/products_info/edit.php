
<?php

    include("../../conexion.php");

    // Recuperar datos si hay un ID en GET
if (isset($_GET['id'])){
    $txtid = $_GET['id'];

    $stm = $conexion->prepare('SELECT * FROM products_info WHERE id=:txtid');
    $stm->bindParam(':txtid', $txtid);
    $stm->execute();

    // Verificar si se encontró el producto
    if ($registro = $stm->fetch(PDO::FETCH_ASSOC)) {
        $nombre = $registro['name'];
        $descripcion = $registro['description'];
        $imagen = $registro['image'];
        $marca = $registro['brand'];
        $precio = $registro['price'];
        $precio_venta = $registro['price_sale'];
        $categoria = $registro['category'];
        $cantidad = $registro['stock'];
    } else {
        // Manejo del caso en el que no se encuentra el producto con el ID dado
        // Podría redirigir a una página de error o realizar alguna otra acción
        // Por ejemplo:
        header("Location: error.php");
        exit();
    }
}

// Actualización de los datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $txtid = isset($_POST['txtid']) ? $_POST['txtid'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $descripcion = isset($_POST['description']) ? $_POST['description'] : '';
    $imagen = isset($_POST['image']) ? $_POST['image'] : '';
    $marca = isset($_POST['marca']) ? $_POST['marca'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : 0;
    $precio_venta = isset($_POST['precio_venta']) ? $_POST['precio_venta'] : 0;
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;

    $stm = $conexion->prepare("UPDATE products_info SET name=:nombre, description=:descripcion, image=:imagen, brand=:marca, price=:precio, price_sale=:precio_venta, category=:categoria, stock=:cantidad WHERE id=:txtid");
    $stm->bindParam(":txtid", $txtid);
    $stm->bindParam(":nombre", $nombre);
    $stm->bindParam(":descripcion", $descripcion);
    $stm->bindParam(":imagen", $imagen);
    $stm->bindParam(":marca", $marca);
    $stm->bindParam(":precio", $precio);
    $stm->bindParam(":precio_venta", $precio_venta);
    $stm->bindParam(":categoria", $categoria);
    $stm->bindParam(":cantidad", $cantidad);

    $stm->execute();

    header("location: index.php");
    exit();
}


?>

<?php include("../../template/header.php");?>

<form action="" method="post">
<div class="modal-body">
        <input type="hidden" name="txtid" id="id_producto" class="form-control mb-2" value="<?php echo $txtid ?>">
        <label for="">Name: </label>
        <input type="text" name="nombre" id="name_producto" class="form-control mb-2" value="<?php echo $nombre ?>" placeholder="Ingrese el nombre del producto">
        <label for="">Description: </label>
        <textarea name="description" placeholder="Ingrese una breve descripcion del producto" id="product_description" cols="50" rows="10" class="form-control mb-2"><?php echo $descripcion ?></textarea>
        <label for="">Image: </label>
        <input type="text" name="image" value="<?php echo $imagen ?>" placeholder="Ingrese el url de la imagen" id="image_producto" class="form-control mb-2">
        <label for="">Brand: </label>
        <input name="marca" value="<?php echo $marca ?>" placeholder="Ingrese la marca del producto" id="brand_producto" class="form-control mb-2">
        <label for="">Price: </label>
        <input type="number" value="<?php echo $precio ?>" placeholder="Ingrese el precio del producto" step="50" min="0" name="precio" id="price_producto" class="form-control mb-2">
        <label for="">Price sale: </label>
        <input type="number" step="50" value="<?php echo $precio_venta ?>" placeholder="Ingrese el precio de venta del producto" min="0" name="precio_venta" id="price_producto" class="form-control mb-2">
        <label for="">Category: </label>
        <input name="categoria" value="<?php echo $categoria ?>" placeholder="Ingrese la categoria del producto" id="category_producto" class="form-control mb-2">
        <label for="">Stock: </label>
        <input type="number" value="<?php echo $cantidad ?>" placeholder="Ingrese la cantidad de producto disponible" step="5" min="0" name="cantidad" id="price_producto" class="form-control mb-2">
    </div>
      <div class="modal-footer">
        <br>
        <br>
        <a href="index.php" class = "btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
</form>

<?php include("../../template/footer.php");?>