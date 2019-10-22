<?php
header("Location: login.php");
?>
/*
para graficos Charts
https://code.tutsplus.com/es/tutorials/getting-started-with-chartjs-line-and-bar-charts--cms-28384

limpiar BD
TRUNCATE `calificacion`;
TRUNCATE `comentario_general`;
TRUNCATE `historial`;
TRUNCATE `usuario_encuesta`;
*/

/*
logradas
1.ordenar vista de usuario(rut muy no se ve bien)
2.validar que rut incorrectos no se puedan ingresar
3.revisar seguridad de url
4.validar asignacion en las encuestas url 
5.privilegios de usuario
7.ver avances por periodo(asignacion=usuario pero distinta fecha)
8.citar por mail en historial
9.cargando al asignar,mientras manda correos
10.ordenar y limpiar codigo (cambiar * en select)
12.revisar los select y reemplazar por metodos.
13.revisar buscar y poner el metodo recuperar en una variable
14.revisar los page.js
15.cambuar id_usuario por rut usuario/evaluado evaluador historial
16.revisar completar encuesta se cambie estado

pendientes
6.tarea programada - cambiar estado de encuesta pasado un tiempo(cron job o myslq)
11.no se deberia asignar una encuesta sin preguntas



*/
