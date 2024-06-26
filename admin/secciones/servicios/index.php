<!-- inclusion de la BD -->
<?php 

include("../../bd.php");

if(isset($_GET['txtID'])){
//BORRAR REGIRSTRO CON EL ID CORRESPONDIENTE
$txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
// $sentencia=$conexion->prepare("DELETE FROM tbl_servicios WHERE id=:id ");
// $sentencia->bindParam(":id",$txtID);

// $sentencia->execute();

$sentencia=$conexion->prepare("UPDATE tbl_servicios
SET deleted_at = 1 WHERE id=:id");
$sentencia->bindParam(":id",$txtID);
$sentencia->execute();


}


$sentencia=$conexion->prepare("SELECT * FROM `tbl_servicios` WHERE deleted_at = 0");
$sentencia->execute();
$lista_servicios=$sentencia->fetchAll(PDO::FETCH_ASSOC); //Obtener todos los registros de la tabla servicios







include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
<a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registros</a>

      
    </div>
    <div class="card-body">
       
        <div class="table-responsive-sm">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Icono</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                
                
                <?php foreach($lista_servicios as $registros){ ?> 

                    <tr class="">
                        <td><?php echo $registros['ID'];?></td>
                        <td><?php echo $registros['icono'];?></td>
                        <td><?php echo $registros['titulo'];?></td>
                        <td><?php echo $registros['descripcion'];?></td>
                        <td>

                        <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID'];?>" role="button">Editar</a>
                        |
                        <a name="" id="" class="btn btn-danger" onclick="confirmDelete(event);" href="index.php?txtID=<?php echo $registros['ID'];?>"  role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("../../templates/footer.php");?>
