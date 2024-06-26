<?php 
include("../../bd.php");


//borrando registros con el ID
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";


    $sentencia=$conexion->prepare("SELECT imagen FROM tbl_entradas WHERE id=:id ");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen['imagen'])){

        if(file_exists("../../../assets/img/about/".$registro_imagen['imagen'])){
            unlink("../../../assets/img/about/".$registro_imagen['imagen']);
    }

}


$sentencia=$conexion->prepare("UPDATE tbl_entradas
SET deleted_at = 1 WHERE id=:id");
$sentencia->bindParam(":id",$txtID);
$sentencia->execute();

// $sentencia=$conexion->prepare("DELETE FROM tbl_entradas WHERE id=:id ");
// $sentencia->bindParam(":id",$txtID);
// $sentencia->execute();

}
//seleccionar registros
$sentencia=$conexion->prepare("SELECT * FROM `tbl_entradas` WHERE deleted_at = 0");
$sentencia->execute();
$lista_entradas=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php"); 
?>

<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a>

    </div>
    <div class="card-body">
   
<div class="table-responsive-sm">
    <table class="table table-light">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Fecha</th>
                <th scope="col">Título</th>
                <th scope="col">Descripción</th>
                <th scope="col">Imagen</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach($lista_entradas as $registros){ ?> 
            <tr class="">
            <td><?php echo $registros['ID'];?></td>
            <td><?php echo $registros['fecha'];?></td>
            <td><?php echo $registros['titulo'];?></td>
            <td><?php echo $registros['descripcion'];?></td>
            <td><img width="60" src="../../../assets/img/about/<?php echo $registros['imagen'];?>" />
            </td>
            <td>
    <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID'];?>" role="button">Editar</a>
    |
    <a name="" id="" class="btn btn-danger" onclick="confirmDelete(event);" href="index.php?txtID=<?php echo $registros['ID'];?>" role="button" onclick="AlertarEliminacion()" >Eliminar</a>

        </td>
        </tr>
        <?php  } ?>
        </tbody>
    </table>
</div>

    </div>
    <div class="card-footer text-muted">
       
    </div>
</div>
<?php include("../../templates/footer.php");?>
