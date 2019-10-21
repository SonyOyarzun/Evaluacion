<?php
$fecha=date("Y");
$pathInPieces = explode('/',$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);  
$ruta='http://'.$pathInPieces[0]."/";
$mensaje="<!DOCTYPE html>
<html lang='es'>
<head>
	<meta charset='utf-8'>
	<title>Asignacion</title>
</head>
<body style='background-color: white '>

<table style='max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;'>
	<tr>
		<td style='background-color: #ecf0f1; text-align: left; padding: 0'>
				<img width='20%' style='display:block; margin: 1.5% 3%' src='https://i.postimg.cc/KvNScWs1/owl-icon-overlay-black.png'>
			</a>
		</td>
	</tr>

	<tr>
		<td style='padding: 0'>
			<img style='padding: 0; display: block' src='https://i.postimg.cc/m2RWs4Vx/LOGO.png' width='100%'>
		</td>
	</tr>
	
	<tr>
		<td style='background-color: #ecf0f1'>
			<div style='color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif'>
				<h2 style='color: #e67e22; margin: 0 0 7px'>Hola $evaluado!</h2>
				<p style='margin: 2px; font-size: 15px'>
					$evaluador quiere contactarse contigo en base los siguientes resultados de la evaluacion $encuesta</p>
	<tr>
		<td style='padding: 0'>
			<img style='padding: 0; display: block' src='data:image/png;base64,$imagen' width='100%'>
		</td>
	</tr>
				<div style='width: 100%;margin:20px 0; display: inline-block;text-align: center'>
					
				</div>
				<div style='width: 100%; text-align: center'>
					<a style='text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db' href='$ruta'>Ir a la página</a>	
				</div>
				<p style='color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0'> Owl Evaluacion $fecha </p>
			</div>
		</td>
	</tr>
</table>
</body>
</html>";