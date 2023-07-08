<?php
  require './database.php';

  if (isset($_POST['update'])) {
    $name = $_POST['nombre'];
    $img  = $_FILES['archivo']['name'];
    $desc = $_POST['descripcion'];
    $id = $_POST['id'];

    $target_dir = "assets/img/";
    $target_file = $target_dir . $img;

    move_uploaded_file($_FILES['archivo']['tmp_name'] , $target_file);

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'UPDATE proyectos SET pronombre ="'.$name.'", proimagen="'.$target_file.'", prodesc="'.$desc.'" WHERE proid='.$id;
    echo $sql;
    $q = $pdo->prepare($sql);
    $q -> execute();
    Database::disconnect();
    header("location:abm.php");
  }


  if (isset($_GET['modificar'])){
    $id = $_GET['modificar'];

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql ='SELECT * FROM proyectos WHERE proid ='.$id;
    $q = $pdo->prepare($sql);
    $q -> execute();
    Database::disconnect();
}

?>
<!doctype html>
<html lang="es" data-bs-theme="auto">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <!-- Bootstrap CSS -->
     <link href="./css/bootstrap.min.css" rel="stylesheet" >
     <link href="./css/dap.css" rel="stylesheet" >
     <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
     <title>Portfolio</title>
    <script src="./js/color-modes.js"></script>

  </head>
<body class="bg-body-tertiary">
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check2" viewBox="0 0 16 16">
      <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
      <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
      <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
      <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
    </symbol>
  </svg>
  <div class="row d-flex justify-content-center mb-5">
    <div class="col-md-10 col-sm-12">
        <div class="card bg-secondary">
            <div class="card-header">
                Datos del Proyecto
            </div>
            <div class="card-body">
                <?php foreach ($q as $row) {?>
                <form action="mod.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['proid']; ?>">
                  <div>
                    <label for="nombre">Nombre del Proyecto</label>
                    <input required class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $row['pronombre']; ?>">
                  </div>
                  <div>
                  <label for="archivo">Imagen del Proyecto (elija la misma si no la quiere modificar)</label>
                    <input required class="form-control" type="file" name="archivo" id="archivo"  value="<?php echo $row['proimagen']; ?>">
                  </div>
                  <br>
                  <div>
                    <label for="descripcion">Indique Descripción del Proyecto</label>
                    <textarea required class="form-control" name="descripcion" id="descripcion" cols="30" rows="4"><?php echo $row['prodesc']; ?></textarea>
                  </div>
                  <div>
                    <br>
                    <input class="btn btn-success" name="update" type="submit" value="Actualizar Proyecto">
                  </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
  </div>
</body>
</html>