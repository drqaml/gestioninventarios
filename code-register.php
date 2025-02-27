<?php
require_once 'conexion.php';

$username = $email = $password = "";
$username_err = $email_err = $password_err = "";

// Simular variables para entorno CLI
if (php_sapi_name() === 'cli') {
    // Simulación en CLI
    $_SERVER['REQUEST_METHOD'] = "POST";
    $_POST['username'] = "usuario_prueba";
    $_POST['email'] = "correo@prueba.com";
    $_POST['password'] = "123456";
}

// Verificamos si REQUEST_METHOD existe antes de proceder
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === "POST") {
    if (empty(trim($_POST['username']))) {
        $username_err = "Por favor ingrese un nombre de usuario.";
    } else {
        $sql = "SELECT ID_Usuario FROM usuario WHERE Nombre = ?";
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST['username']);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) === 1) {
                    $username_err = "Este nombre de usuario ya está en uso.";
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                echo "Oops! Algo salió mal. Por favor intente de nuevo más tarde.";
            }
        }
    }

    /*email*/
    if (empty(trim($_POST['email']))) {
        $email_err = "Por favor ingrese un correo electronico.";
    } else {
        $sql = "SELECT ID_Usuario FROM usuario WHERE Correo_Electronico = ?";
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = trim($_POST['email']);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) === 1) {
                    $email_err = "Este correo ya está en uso.";
                } else {
                    $email = trim($_POST['email']);
                }
            } else {
                echo "Oops! Algo salió mal. Por favor intente de nuevo más tarde.";
            }
        }
    }
    /*contraseña*/
    if (empty(trim($_POST['password']))) {
        $password_err = "Por favor ingrese una contraseña.";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        $password = trim($_POST['password']);
    }

    // comprobamos los errores antes de insertar en la base de datos
    if (empty($username_err) && empty($email_err) && empty($password_err)) {
        $sql = "INSERT INTO usuario (Nombre, Correo_Electronico, Contraseña) VALUES (?, ?, ?)";
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);

            //ESTABLECER PARAMETROS
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if (mysqli_stmt_execute($stmt)) {
                echo "Usuario registrado exitosamente.";
            } else {
                echo "Algo salió mal. Por favor intente de nuevo más tarde.";
            }
        }
    }
    mysqli_close($conexion);
}
?>