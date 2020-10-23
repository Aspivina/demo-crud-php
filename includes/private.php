<?php
  session_start();
  include("../database/db.php");
  include("header.php");

  $contenido = "";
  $titulo = "";
  $row_id = null;
  $editMode = false;

  $notas = null;
  if (isset($_SESSION['notas'])) {
    $notas = $_SESSION['notas'];
  }

  if (isset($_SESSION['user'])) {
    $alias = $_SESSION['user'];
    $id = $_SESSION['id'];
    $query = "SELECT * FROM notas WHERE user_id='$id' ";
    $notas = mysqli_query($conn, $query);
  }
?>

<div class="container myBlock">
  <div class="row spaced-columns ">
    <div class="col-md-10">
      <div class="card card-body">
        <!-- MESSAGES -->
        <?php if (isset($_SESSION['user'])) { ?>
          <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
              <?= $_SESSION['message'] ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
          } ?>
          <div class="accordion" id="accordionExample">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <i class="fas fa-sticky-note"></i> Organiza tus notas personales
                  </button>
                </h2>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="p-3">
                  <div class="card-title d-flex  w-100">
                    <!-- Button trigger modal -->
                    <button 
                    type="button" 
                    class="btn btn-primary mr-auto" 
                    data-toggle="modal" 
                    onclick="newNote()"
                    data-target="#exampleModalCenter">
                      <i class="far fa-plus-square"></i> Nueva Nota
                    </button>
                    <a href="../controllers/controllerStickyNote.php?all=*.*" class="btn btn-secondary">
                      <h6">VER TODAS</h6>
                    </a>
                  </div>
                  <div class="card-body" style="max-height: 300px; overflow-y:scroll">
                    <!-- LISTAR todas las notas -->
                    <table class="table table-bordered">
                      <thead>
                        <tr p-1>
                          <td>ACCION</td>          
                          <td>TITULO</td>
                          <td>CONTENIDO</td>
                          <!-- <td>TITULO</td> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($notas)) {
                        ?>
                          <tr style="padding: 0 !important;">
                            <td style="padding: 10px !important; width: 50px">
                              <a 
                              data-titulo="<?php echo $row['titulo']; ?>" 
                              data-contenido="<?= $row['contenido']; ?>" 
                              data-id="<?= $row['id']; ?>" 
                              data-toggle="modal" 
                              class="btn btn-secondary" 
                              data-target="#exampleModalCenter" 
                              onclick="editNote(event)">
                                <i class="fas fa-marker"></i>
                              </a>
                            </td>
                            <td class="text-truncate" style="padding: 10px !important; max-width: 200px"><?php echo $row['titulo']; ?></td>
                            <td class="text-truncate" style="padding: 10px !important; max-width: 200px"><?php echo $row['contenido']; ?></td>
                            <!-- <td><?php echo $row['modificacion']; ?></td> -->
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <!-- actualiza tus datos -->
              <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-edit"></i> Actualiza tus datos
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                  <form action="../controllers/controllerUpdate.php" method="POST">
                    <div class="form-group">
                      <input type="text" name="alias" class="form-control" placeholder="alias" disabled value="<?php echo $alias; ?>" />
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control" placeholder="current password" />
                    </div>
                    <div class="form-group">
                      <input type="password" name="new_password" class="form-control" placeholder="new password" />
                    </div>
                    <div class="form-group">
                      <input type="password" name="new_password_check" class="form-control" placeholder="new password" />
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" name="update" value="update" />
                  </form>
                  <hr>
                  <a href="../controllers/controllerDelete.php?id=<?php echo $id ?>" class="btn btn-secondary w-100">
                    <i class="far fa-trash-alt text-danger"></i> Quiero darme de baja y eliminar mis datos
                  </a>
                </div>
              </div>
            </div> <!-- actualiza tus datos -->
          </div>
        <?php
        } ?>
      </div>
    </div>
    <!-- <div class="col-md-2">
      <img src="../assets/abrir-datos.jpg" class="img-fluid" />
    </div>     -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <form action="../controllers/controllerStickyNote.php" method="POST" id="exampleModalForm">
            <div class="modal-header">
              <h5 class="modal-title w-100" id="exampleModalLongTitle">
                <input type="text" name="titulo" placeholder="titulo" value="<?php echo $titulo ?>" class="form-control myTitle w-100" />
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="exampleModalLongContent">
              <textarea name="contenido" rows="6" class="form-control w-100" placeholder="Contenido"><?php echo $contenido ?></textarea>
            </div>
            <div class="modal-footer" id="exampleModalFooterActions">
                <button 
                  id="modalDeleteButton"
                  type="submit" 
                  name="delete" 
                  class="btn btn-secondary ">
                  <i class="far fa-trash-alt text-danger"></i> Eliminar
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <input 
                  id="modalSaveButton"
                  type="submit" 
                  name="addNew" 
                  class="btn btn-primary " 
                  value="Guardar">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function editNote(event) {

    let rowData = event.currentTarget;

    let miModal = document.querySelector("#exampleModalLongTitle  > input");
    miModal.value = rowData.dataset.titulo;
    miModal = document.querySelector("#exampleModalLongContent  > textarea");
    miModal.value = rowData.dataset.contenido;

    $row_id = rowData.dataset.id;

    //BOTON de borrar
    let miModalDeleteButton = document.querySelector("#modalDeleteButton");
    miModalDeleteButton.style.display="inline-block";
    console.log(miModalDeleteButton);

    //BOTON de salvar cambios
    let miModalSaveButton = document.querySelector("#modalSaveButton");
    miModalSaveButton.name="update";
    console.log(miModalSaveButton);

    let miModalForm = document.querySelector("#exampleModalForm");
    console.log(miModalForm);
    miModalForm.action="../controllers/controllerStickyNote.php?id="+$row_id;
  }

  function newNote() {
    $contenido = "";
    $titulo = "";
    $row_id = null;
    $editMode = false;

    let miModal = document.querySelector("#exampleModalLongTitle  > input");
    miModal.value = $titulo;
    miModal = document.querySelector("#exampleModalLongContent  > textarea");
    miModal.value = $contenido;

    //BOTON de borrar
    let miModalDeleteButton = document.querySelector("#modalDeleteButton");
    miModalDeleteButton.style.display="none";
    console.log(miModalDeleteButton);

    //BOTON de salvar cambios
    let miModalSaveButton = document.querySelector("#modalSaveButton");
    miModalSaveButton.name="addNew";
    console.log(miModalSaveButton);

    let miModalForm = document.querySelector("#exampleModalForm");
    console.log(miModalForm);
    miModalForm.action="../controllers/controllerStickyNote.php";
  }  
</script>

<?php include("footer.php") ?>