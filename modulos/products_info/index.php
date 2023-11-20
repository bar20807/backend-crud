<?php 

include("../../conexion.php");

$stm = $conexion->prepare("SELECT * FROM products_info");
$stm->execute();

//Recuperamos los datos
$productos = $stm -> fetchAll(PDO::FETCH_ASSOC);

//Agregamos la condicional para eliminar
if (isset($_GET['id'])){
    $txtid = (isset($_GET['id'])?$_GET['id']:"");
    //pasamos el id a la consulta sql
    $stm = $conexion->prepare('DELETE FROM products_info WHERE id=:txtid');
    //Asignamos el parametro
    $stm->bindParam(':txtid',$txtid);
    //Ejecutamos
    $stm -> execute();
    //Retornamos al index
    header ("location: index.php");
}


?>

<?php include("../../template/header.php");?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
  Agregar nuevo producto
</button>
<br>
<br>
<div class="table-responsive">
    <table class="table">
        <thead class = "table table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Brand</th>
                <th scope="col">Price</th>
                <th scope="col">Price sale</th>
                <th scope="col">Category</th>
                <th scope="col">Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto) { ?>
            <tr class="">
                <td scope="row"><?php echo $producto["id"];?></td>
                <td><?php echo $producto["name"];?></td>
                <td><?php echo $producto["description"];?></td>
                <td><?php echo $producto["image"];?></td>
                <td><?php echo $producto["brand"];?></td>
                <td><?php echo $producto["price"];?></td>
                <td><?php echo $producto["price_sale"];?></td>
                <td><?php echo $producto["category"];?></td>
                <td><?php echo $producto["stock"];?></td>
                <td>

                    <a href="edit.php?id=<?php echo $producto["id"];?>" class="btn btn-warning">Editar</a>
                    <br>
                    <br>
                    <a href="index.php?id=<?php echo $producto["id"];?>" class="btn btn-danger">Eliminar</a>

                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>
<?php include("create.php")?>


<?php include("../../template/footer.php");?>