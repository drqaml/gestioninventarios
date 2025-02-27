<?php
include 'code-register.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Js company</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="container-all">
    <div class="ctn-form">
        <img src="assets/Logo.jpg" alt="" class="logo">
        <h1 class="title">Registrate</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="">Usuario</label>
            <input type="text" name="username" id="" required>
            <span class="msg-error"><?php echo $username_err; ?></span>

            <label for="">Correo electrónico</label>
            <input type="text" name="email" id="" required>
            <span class="msg-error"> <?php echo $email_err?></span>

            <label for="">Contraseña</label>
            <input type="password" name="password" id="" required>
            <span class="msg-error"> <?php echo $password_err?></span>

            <input type="submit" value="Registrarse">
        </form>

        <span class="text-footer">¿Ya tienes una cuenta? <a href="/index.php">Iniciar sesión</a></span>
    </div>
    <div class="ctn-text">
        <div class="capa"></div>
        <h1 class="title-description">Bienvenido a Js company</h1>
        <p class="text-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, doloremque.</p>
    </div>

</div>

</body>
</html>