<?php include("database/db.php") ?>
<?php include("includes/header.php") ?>
<!-- <?php include("controllers/controllerLogin.php") ?> -->

<div class="div container">
   <div class="row spaced-columns">
      <div class="col-md-6">
         <img src="assets/welcome.png" class="img-fluid" />
      </div>
      <div class="col-md-4">
         <div class="card card-body">

            <!-- MESSAGES -->
            <?php if (isset($_SESSION['message'])) { ?>
               <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                  <?= $_SESSION['message'] ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
            <?php session_unset();
            } ?>
            <?php if (isset($_GET['login'])) { ?>
               <h3><i class="fas fa-user-lock"></i> Login</h3>
               <form action="controllers/controllerLogin.php" method="POST">
                  <div class="form-group">
                     <input type="text" name="alias" class="form-control" placeholder="alias" autofocus />
                  </div>
                  <div class="form-group">
                     <input type="password" name="password" class="form-control" placeholder="password" autofocus />
                  </div>
                  <input type="submit" class="btn btn-success btn-block" name="login" value="login" />
               </form>
               <hr>
               <p>No tienes una cuenta aun? <a href="?signin=true" class="text-orange-50" text-center>Registrate</a></p>
            <?php } elseif (isset($_GET['signin'])) { ?>
               <h3><i class="fas fa-sign-in-alt"></i> Registrate</h3>
               <form action="controllers/controllerSignin.php" method="POST">
                  <div class="form-group">
                     <input type="text" name="alias" class="form-control" placeholder="alias" autofocus />
                  </div>
                  <div class="form-group">
                     <input type="test" name="password" class="form-control" placeholder="password" autofocus />
                  </div>
                  <input type="submit" class="btn btn-success btn-block" name="signin" value="signin" />
               </form>
               <hr>
               <p>Ya tienes una cuenta? <a class="text-orange-50" text-center href="?login=true">Login</a></p>
            <?php }else{ ?>
               <h3><i class="fas fa-user-astronaut"></i> Bienvenido</h3>
               <p>He trabajando arduamente para hacer mi primer ABM de usuarios autogestionado con PHP 5.5, MySQLi, y Bootstrap.</p>
               <h6><a href="?signin=true" class="text-orange-50" text-center>Comencemos!</a></h6>
            <?php } ?>
         </div>


      </div>
   </div>
</div>

<?php include("includes/footer.php") ?>
