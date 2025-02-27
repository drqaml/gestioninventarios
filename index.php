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
        <h1 class="title">Iniciar sesión</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

            <label for="">Correo electrónico</label>
            <input type="text" name="email" id="" required>
            <span class="msg-error"></span>

            <label for="">Contraseña</label>
            <input type="password" name="password" id="" required>
            <span class="msg-error"></span>

            <input type="submit" value="Iniciar sesión">
        </form>

        <span class="text-footer">¿Aún no tienes una cuenta? <a href="/register.php">Regístrate</a></span>
    </div>
    <div class="ctn-text">
        <div class="capa"></div>
        <h1 class="title-description">Bienvenido a Js company</h1>
        <p class="text-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, doloremque.</p>
    </div>

</div>

</body>
</html>