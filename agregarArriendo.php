<?php 
session_start();

if(! isset($_SESSION['Cargo'])){
    session_destroy();
    header("Location: index.php");
}else{
    $_SESSION['Rut'] = $_SESSION['Rut'];
    echo "<h2>El usuario conectado es:".$_SESSION['Nombre']." ".$_SESSION['Apellido'];
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/agregarArriendo.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   

    <title>agregarArriendo</title>
  

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

<script type="text/javascript">
     function ValidaSoloNumeros(){
        if((event.keyCode < 48)|| (event.keyCode > 57 ))
            event.returnValue = false;
     }   
     function ValidaSoloLetras(){
        if((event.keyCode !=32 ) && (event.keyCode < 65) ||
            (event.keyCode > 90 ) && (event.keyCode < 97) 
            ||(event.keyCode > 122 ))
            event.returnValue = false;
     }</script>
    <title>Bienvenido <?php echo $_SESSION['Nombre']." ".$_SESSION['Apellido'] ?></title>
</head>

<body onload="IniciarReloj24()">
    <form name="reloj24"> <!-- Este form es otro aparte del que usamos para nuestro formulario -->
        <input class="reloj"  type="text" size="4" name="txtDigitos" style="background-color:#EAF2F8;
		border-color:transparent; text-align:right" value="" disabled>

		<!-- COLOCAR LA FECHA ACTUAL AL FORMULARIO -->
	<?php date_default_timezone_set('America/Santiago');
            $vaFecha=date('d-M-Y');
        ?>
        <input class="fecha" type="text" name="caja_fecha" size="7" style="background-color:#EAF2F8;
		border-color:transparent; text-align:right" value="<?php echo $vaFecha; ?>" disabled>
    </form>
	
</body>

<body bgcolor="#EAF2F8">
<form method="post">	
<?php error_reporting (0); ?>  
	<center>
    <div class="container">

	<h1>Agregar Arriendo</h1>

	<table>
		<tr>
            <td> Rut cliente :</td>
            <td><input type="text" name="txtRut" value="" size="30" maxlength="30" onkeypress="ValidaSoloNumeros()"></td>
            <td>- <input type="text" name="txtDigito" value="" size="2" onkeypress="ValidaSoloNumeros()"></td>
        </tr>
        <tr>
            <td>* Nombre :</td>
            <td><input type="text" name="txtNom" value="" size="30" maxlength="30" onkeypress="ValidaSoloLetras()"></td>
        </tr>
            <td>* Apellido :</td>
            <td><input type="text" name="txtApe" value="" size="30" maxlength="30" onkeypress="ValidaSoloLetras()"></td>
        </tr>
        </tr>
            <td>* Fecha arriendo :</td>
            <td><input type="date" name="txtFech" value="" size="30" maxlength="30" ></td>
        </tr>
    	</tr>
            <td>* Hora :</td>
            <td><input type="time" name="txtHora" value="" size="30" maxlength="30"></td>
        </tr>
        </tr>
            <td>* Estado :</td>
            <td><input type="text" name="txtEstado" value="" size="30" maxlength="30"></td>
        </tr>
	</center>
        
     </table> 
      	
        	
        	<center><input type="submit" name="btnAgre" value="AGREGAR" size="25" maxlength="30"></center>
            
            <button type="submit"><a href="menu.php">Volver</a></button>
</div>

 <?php 

if ($_POST['btnAgre']=="AGREGAR"){

	include("funciones.php");
	$cnn = Conectar();
    $vaDig = Verifica($_POST['txtRut']);
    $vaNum = $_POST['txtRut'];
    $Rut = $_POST['txtRut']."-".$_POST['txtDigito'];
    $nom = $_POST['txtNom'];
    $ape = $_POST['txtApe'];
    $fech = $_POST['txtFech'];
    $hora = $_POST['txtHora'];
    $estado = $_POST['txtEstado'];
    if($_POST['txtDigito']=="k") { $_POST['txtDigito']=="K";}
    if($_POST['txtDigito']==$vaDig){
       $rs = mysqli_query($cnn,"SELECT * FROM arriendos WHERE RUT = '$Rut'");
       if($row = mysqli_fetch_array($rs)){
        echo "<script>alert('Ya existe un trabajador registrado con ese rut')</script>";
    }else{
        if(empty($nom) || empty($ape) || empty($fech) || empty($hora) || empty($estado)){
            echo "<script> alert('Los campos obligatorios deben contener datos')</script>";
        }else{
            $sql="insert into arriendos values('$Rut','$nom','$ape','$fech','$hora','$estado')";
            mysqli_query($cnn,$sql);
            echo "<script> alert('El registro ha sido ingresado correctamente')</script>";
        }
    }
 }else{
    
    ?><script>alert("Rut Incorrecto")</script><?php
 }

}
  ?>  
	
		
	
</form>

</body>
</html>