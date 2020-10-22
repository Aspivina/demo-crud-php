<?php
session_start();
include("../database/db.php");
include("header.php");

if (isset($_SESSION['user'])) {
    $alias = $_SESSION['user'];
    // echo "\n".$alias;
    $id = $_SESSION['id'];
    // echo "\n".$id;
}

?>

<div class="div container">
    <div class="row spaced-columns">
        <div class="col-md-4">
            <img src="../assets/abrir-datos.jpg" class="img-fluid" />
        </div>
        <div class="col-md-6">
            <div class="card card-body">

                <!-- MESSAGES -->
                <?php if (isset($_SESSION['user'])) { ?>
                    <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message'] ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <h3><i class="fas fa-edit"></i> Actualiza tus datos</h3>
                    <form action="../controllers/controllerUpdate.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="alias" class="form-control" placeholder="alias" disabled value="<?php echo $alias; ?>" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="current password" autofocus />
                        </div>
                        <div class="form-group">
                            <input type="password" name="new_password" class="form-control" placeholder="new password" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="new_password_check" class="form-control" placeholder="new password" />
                        </div>
                        <input type="submit" class="btn btn-success btn-block" name="update" value="update" />
                    </form>
                    <hr>
                    <a href="../controllers/controllerDelete.php?id=<?php echo $id ?>" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i> Quiero darme de baja y eliminar mis datos 
                    </a>

                <?php
                } ?>

            </div>
        </div>
    </div>
</div>

<?php include("footer.php") ?>