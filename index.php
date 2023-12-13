<?php 
 session_start ()
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- INCORPORAR LA HORA A UN FORMULARIO -->
	<script language="javascript">
	var RelojID24 = null
	var RelojEjecutandose24 = false
	function DetenerReloj24 (){
		if(RelojEjecutandose24)
		clearTimeout(RelojID24)
		RelojEjecutandose24 = false}
	function MostrarHora24 () {
		var ahora = new Date()
		var horas = ahora.getHours()
		var minutos = ahora.getMinutes()
		var segundos = ahora.getSeconds()
		var ValorHora
	//establece las horas
	if (horas < 10)
		ValorHora = "0" + horas
	else
		ValorHora = "" + horas
	//establece los minutos
	if (minutos < 10)
		ValorHora += ":0" + minutos
	else
		ValorHora += ":" + minutos
	//establece los segundos
	if (segundos < 10)
		ValorHora += ":0" + segundos
	else
		ValorHora += ":" + segundos
		document.reloj24.txtDigitos.value = ValorHora
	//si se desea tener el reloj en la barra de estado, reemplazar la anterior por esta
	//window.status = ValorHora
		RelojID24 = setTimeout("MostrarHora24()",1000)
		RelojEjecutandose24 = true
	}
	function IniciarReloj24 () {
		DetenerReloj24()
		MostrarHora24()
	}
	</script>
    </head>

    <body onload="IniciarReloj24()">
    <form name="reloj24"> <!-- Este form es otro aparte del que usamos para nuestro formulario -->
        <input type="text" size="6" name="txtDigitos" style="background-color:E7DE4D;
		border-color:transparent; text-align:right" value="" disabled>

		<!-- COLOCAR LA FECHA ACTUAL AL FORMULARIO -->
	<?php date_default_timezone_set('America/Santiago');
            $vaFecha=date('d-M-Y');
        ?>
        <input type="text" name="caja_fecha" size="10" style="background-color:E7DE4D;
		border-color:transparent; text-align:right" value="<?php echo $vaFecha; ?>" disabled>
    </form>
	
</body>


    <body bgcolor="E7DE4D">
    <center>
        <form method="post">
        <?php error_reporting (0); ?>
        <h1><FONT COLOR="white">INICIAR SESIÓN </FONT></h1>
    <table><br><br><br>
    
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
        <input  type="submit" name="btnAcceder" value="Acceder">
        </div>

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