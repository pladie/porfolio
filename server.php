<?php
session_start();
require './database.php';

$username = "";
$email    = "";
$password = "";
$errors = array(); 

// LOGIN USER
if (isset($_POST['login_user'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
  
    // if (count($errors) == 0) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $password = md5($password);
        $sql = "SELECT * FROM usuarios WHERE usunombre='$username' AND usuclave='$password'";
        $q = $pdo->prepare($sql);
        $q -> execute();
        $cant = $q -> rowCount();

        if ( $cant == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: abm.php');
        }else {
            if ($cant == 0)
              array_push($errors, "Usuario no habilitado en el sistema");
            else
              array_push($errors, "Wrong username/password combination"+ $cant);
        }
    // }
}
?>