<?php 

include("../../bd.php");

if(isset($_GET['txtID'])){
    //3)BORRAR REGIRSTRO CON EL ID CORRESPONDIENTE EN LA LISTA DE REGISTROS
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    // $sentencia=$conexion->prepare("DELETE FROM tbl_usuarios WHERE id=:id ");
    // $sentencia->bindParam(":id",$txtID);
    // $sentencia->execute();
    

    $sentencia=$conexion->prepare("UPDATE tbl_usuarios
    SET deleted_at = 1 WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    

    }

//recuperar los datos para mostar en la interfaz de la lista de usuarios.
//1) seleccionar registros 2)foreach
$sentencia=$conexion->prepare("SELECT * FROM `tbl_usuarios` WHERE deleted_at = 0");
$sentencia->execute();
$lista_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);


include("../../templates/header.php"); 
?>

<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="">Agregar registros</a>
    </div>
    <div class="card-body">
      
    <div class="table-responsive-sm">
    <table class="table table-light">
        <thead>
            <tr>
                <th scope="col">Usuario</th>
                <th scope="col">Password</th>
                <th scope="col">Correo</th>
                <th scope="col">Acciones</th>

            </tr>
        </thead>
        <tbody>

        <?php foreach($lista_usuarios as $registros){ ?> 
            <tr class="">
                <td scope="row"><?php echo $registros['usuario'];?></td>
                <td><?php echo $registros['password'];?></td>
                <td><?php echo $registros['correo'];?></td>
                <td>
                <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID'];?>" role="button">Editar</a>
                |
                <a name="" id=""  class="btn btn-danger"  href="index.php?txtID=<?php echo $registros['ID'];?>"  onclick="confirmDelete(event);" role="button">Eliminar</a>

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
