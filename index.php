<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/index.css">
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='scripts/scripts.js'></script>
    <title>Inicio de Sesion</title>
</head>
<body>
    <center>

    <h1 class="h1">Inicio de Sesion</h1>
    
    <form method="post">
        <div>
        <tr>
            <td>Usuario  </td>
            <td><input type="text" name="userBox" value="" size="10"></td>
            <br>
            <td>Contraseña</td>
            <td><input type="password" name="passwordBox" value="" size="10">
            </td>
        </tr>
        <br>
        <input class="button" type="submit" name="btnLogin" value="Ingresar" onclick="logear()">
        </div>
    </form>
    
</body>
</html>