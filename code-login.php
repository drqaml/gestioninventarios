<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: bienvenida.php");
    exit;
}

require_once "conexion.php";

$email = $password = "";
$email_err = $password_err = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor, ingrese el correo electronico";
    } else {
        $email = trim($_POST['email']);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, ingrese la contraseña";
    } else {
        $password_err = trim($_POST['password']);
    }


    //validar credenciales
    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT ID_Usuario, Nombre, Correo_Electronico, Contraseña FROM usuario WHERE Correo_Electronico = ?";
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = $email;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
            }

            if(mysqli_stmt_num_rows($stmt) === 1){
                mysqli_stmt_bind_result($stmt, $id, $username, $email, $hashed_password);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                        session_start();

                        //almacenar datos en variables de sesion
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["email"] = $email;

                        header("location: bienvenida.php");
                    }else{
                        $password_err = "La contraseña que has ingresado no es válida";
                    }
                }else{
                    $email_err = "No se encontró ninguna cuenta con ese correo electrónico";
                }
            }else{
                echo "Oops! Algo salió mal. Por favor intente de nuevo más tarde.";
            }
        }
    }

    mysqli_close($conexion);
}