<?php 
 session_start ()
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css/index.css">
    <title>Iniciar sesion</title>
    </head>

    <body>
            <div class="container">

        <form method="post">
        <?php error_reporting (0); ?>
        <h1>INICIAR SESIÓN</h1>
    
        <tr>
            <td><b>Usuario :
            </td><td><input type="textRut" name="txtRut" value="" placeholder="ingrese su rut"></td>
        </tr>
        <br>
        <tr>
            <td><b>Clave : <b></td>
            <td> <input type="password" name="txtContra" value="" maxlenght="15" placeholder="ingrese su contraseña"></td>
        </tr>
       

    
    </table>
<br><br>
        <input type="submit" name="btnAcceder" value="Acceder">
    

    <?php 
    if($_POST['btnAcceder']=="Acceder"){
        include("funciones.php");
        $cnn = Conectar();
        $user = $_POST['txtRut'];
        $pass = $_POST['txtContra'];
        $sql1 = "SELECT * FROM dueño WHERE (RUT='$user')";
        $result = $cnn->query($sql1);

if ($result->num_rows > 0) {
    // Se encontró un empleado con el RUT especificado
    $row = $result->fetch_assoc();
    $estado = $row['Estado'];}
    if ($estado == 'Inactivo') {

        echo "<script>alert('Usuario inactivo')</script>";
        exit();}
        else{
        $sql = "select * from dueño where usuario='$user' and clave='$pass'";
        echo $sql;
        $rs=mysqli_query($cnn,$sql);
            if(mysqli_num_rows($rs) !=0){
                if($row=mysqli_fetch_array($rs)){
                    
                    $_SESSION['Nombre'] = $row[1];
                    $_SESSION['Apellido'] = $row[2];
                    $_SESSION['Cargo'] = $row[5];
                    $_SESSION['Rut'] = $row[0];
                
                    switch ($_SESSION['Cargo']){
                        case 1:
                            echo "<script>alert('Usted es $_SESSION[Nombre] $_SESSION[Apellido] y es Dueño')</script>";
                            echo "<script type='text/javascript'>window.location='menu.php'</script>";
                            break; 
                }
            }
        }else{
            echo "<script>alert('Usuario o Clave incorrecta!')</script>";
        }
}}
?>

        </form>
        </center>
    </body>
</html>