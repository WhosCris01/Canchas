<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/eliminarArriendo.css">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulario</title>

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
        <input class="reloj" type="text" size="4" name="txtDigitos" style="background-color:04BDC0;
		border-color:transparent; text-align:right" value="" disabled>

		<!-- COLOCAR LA FECHA ACTUAL AL FORMULARIO -->
	<?php date_default_timezone_set('America/Santiago');
            $vaFecha=date('d-M-Y');
        ?>
        <input class="fecha" type="text" name="caja_fecha" size="7" style="background-color:04BDC0;
		border-color:transparent; text-align:right" value="<?php echo $vaFecha; ?>" disabled>
    </form>
	
</body>

<body bgcolor="04BDC0">
<form method="post">	
	<center>
	<div class="container">
	<h1>Eliminar Arriendo</h1>
    <?php error_reporting (0) ?> 
<?php

if($_POST['btnVer']=="Buscar"){
    include("funciones.php");
    $cnn = Conectar();
    $Rut = $_POST['txtRut'];
    $rs = mysqli_query($cnn, "select * from arriendos where rut='$Rut'");
    if($row = mysqli_fetch_array($rs)){
        $nom = $row[1];
        $ape = $row[2];
        $fecha = $row[3];
        $hora = $row[4];
        $estado = $row[5];
    }else{
        echo "<script>alert('no hay datos con ese rut')</script>";
    }
}
?>
	<table>
		<tr>
            <td> Rut :</td>
            <td><input type="text" name="txtRut" value="<?php echo "$Rut" ?>" size="25" maxlength="30"></td>
            <td><input type="submit" name="btnVer" value="Buscar" size="25" maxlength="30"></td>
        </tr>
        <tr>
            <td>Nombre :</td>
            <td><input type="text" name="txtNom" value="<?php echo "$nom" ?>" size="25" maxlength="30" disabled="disabled"></td>
        </tr>
        <tr>
            <td>Apellido :</td>
            <td><input type="text" name="txtApe" value="<?php echo "$ape"?>" size="25" maxlength="30" disabled="disabled"></td>
        </tr>
        </tr>
            <td>Fecha arriendo :</td>
            <td><input type="date" name="dtFnc" value="<?php echo "$fecha" ?>" size="25" maxlength="30" disabled="disabled" ></td>
        </tr>
        <tr>	
            <td>Hora :</td>
            <td><input type="time" name="txtHora" value="<?php echo "$hora" ?>" size="30" maxlength="30"></td>
        </tr>
        <tr>	
            <td>Estado :</td>
            <td><input type="text" name="txtEstado" value="<?php echo "$estado" ?>" size="30" maxlength="30"></td>
        </tr>

       
	</center>
        
     </table> 
      	
	 <br>	
        	<center><input type="submit" name="btnEliminar" value="Eliminar" size="25" maxlength="30"></center>
  	        <br>
            <button type="submit"><a href="menu.php">Volver</a></button>
 <?php 
 

if ($_POST['btnEliminar']=="Eliminar"){

	include("funciones.php");
	$cnn = Conectar();
	 $Rut = $_POST['txtRut'];
	 $nom = $_POST['txtNom'];
	 $ape = $_POST['txtApe'];

	 $sql="delete from arriendos where(Rut = '$Rut')";
	


mysqli_query($cnn,$sql);

echo "<script>alert('Eliminamos el registro')</script>";

}

  ?>  
	
		
	
</form>

</body>
</html>