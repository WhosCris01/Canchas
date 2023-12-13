<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/visualizarArriendo.css">

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
	<center>
	<div class="container">
    <h1><u>Todos los arriendos</u></h1>
<form method="post">	
<?php error_reporting (0); ?>  

	<input type="submit" name="btnMostrar" value="        Mostrar Todos        ">
	<br><br>

<?php
	if($_POST['btnMostrar']=="        Mostrar Todos        "){
    include("funciones.php");
    $cnn = Conectar();
    $rs = mysqli_query($cnn, "select * from arriendos");
			echo "<table align='center' border='2'>";
			echo "<tr align='center'>";
			echo "<td><b>Rut</td>";
			echo "<td><b>Nombre</td>";
			echo "<td><b>Apellido</td>";
			echo "<td><b>Fecha</td>";
			echo "<td><b>Hora</td>";
			echo "<td><b>Estado</td>";
			echo "<tr>";

	while($row = mysqli_fetch_array($rs)){

			echo "<tr>";
			echo "<td> $row[Rut] </td>";
			echo "<td> $row[Nombre] </td>";
			echo "<td> $row[Apellido] </td>";
			echo "<td> $row[Fecha] </td>";
			echo "<td> $row[Hora] </td>";
			echo "<td> $row[Estado] </td>";
	}
	echo "</table>";
}
?>
<br><br>
		<td><button type="submit"><a href="menu.php">Volver</a></button></td>

	</center>
	<div>
</form>

</body>
</html>