<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $imagen = isset($_POST['image']) ? $_POST['image'] : '';
    $marca = isset($_POST['marca']) ? $_POST['marca'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : 0;
    $precio_venta = isset($_POST['precio_venta']) ? $_POST['precio_venta'] : 0;
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;

    // Creamos la consulta SQL
    $stm = $conexion->prepare("INSERT INTO products_info(name, description, image, brand, price, price_sale, category, stock)
        VALUES(:nombre, :descripcion, :imagen, :marca, :precio, :precio_venta, :categoria, :cantidad)");

    // Asignamos los valores
    $stm->bindParam(':nombre', $nombre);
    $stm->bindParam(':descripcion', $descripcion);
    $stm->bindParam(':imagen', $imagen);
    $stm->bindParam(':marca', $marca);
    $stm->bindParam(':precio', $precio);
    $stm->bindParam(':precio_venta', $precio_venta);
    $stm->bindParam(':categoria', $categoria);
    $stm->bindParam(':cantidad', $cantidad);

    // Ejecutamos la consulta
    $stm->execute();

    // Redireccionamos a la página principal
    header("location: index.php");
    exit();
}

?>


<!-- Modal create-->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR PRODUCTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <label for="">Name: </label>
        <input type="text" name="nombre" id="name_producto" class="form-control mb-2" placeholder="Ingrese el nombre del producto">
        <label for="">Description: </label>
        <textarea name="descripcion" placeholder="Ingrese una breve descripcion del producto" id="product_description" cols="50" rows="10" class="form-control mb-2"></textarea>
        <label for="">Image: </label>
        <input type="text" name="image" placeholder="Ingrese el url de la imagen" id="image_producto" class="form-control mb-2">
        <label for="">Brand: </label>
        <input name="marca" placeholder="Ingrese la marca del producto" id="brand_producto" class="form-control mb-2" >
        <label for="">Price: </label>
        <input type="number" placeholder="Ingrese el precio del producto" step="50" min="0" name="precio" id="price_producto" class="form-control mb-2">
        <label for="">Price sale: </label>
        <input type="number" step="50" placeholder="Ingrese el precio de venta del producto" min="0" name="precio_venta" id="price_producto" class="form-control mb-2">
        <label for="">Category: </label>
        <input name="categoria" placeholder="Ingrese la categoria del producto" id="category_producto" class="form-control mb-2">
        <label for="">Stock: </label>
        <input type="number" placeholder="Ingrese la cantidad de producto disponible" step="5" min="0" name="cantidad" id="price_producto" class="form-control mb-2">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>