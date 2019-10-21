
function enviarMail(opcion) {

    console.log("Enviando mail...");
    
    var rut, nombre, apellido, evaluador, grafico,elemento,boton,encuesta;

    switch (opcion) {
        case 1:
            rut = $("#id_evaluado1").val();
            nombre = $("#nombre1").val();
            apellido = $("#apellido1").val();
            encuesta = $("#nombre_encuesta").val();
            grafico = $("#densityChart")
            elemento="#resultados";
            boton="#citar";
            break;
        case 2:
            rut = $("#id_evaluado2").val();
            nombre = $("#nombre2").val();
            apellido = $("#apellido2").val();
            evaluador = $("#evaluador2").val();
            encuesta = $("#nombre_encuesta2").val();
            grafico = $("#densityChart2");
            elemento="#resultados2";
            boton="#citar2";
            break;
    }
   console.log("nombre"+nombre)
  
   var imagen = (grafico[0]).toDataURL("image/png");
 
 
   console.log("data url :"+imagen)

    var parametros = {
        'rut': rut,
        'nombre': nombre,
        'evaluador': evaluador,
        'imagen': imagen,
        'nombre_encuesta': encuesta,
    }

   
    $.ajax({
        type: "POST",
        url: "ajax/citar_trabajador.php",
        data: parametros,
        beforeSend: function (objeto) {
            $(elemento).html('<img src="./img/ajax-loader.gif"> Cargando...'); 
        },
        success: function (datos) {
            console.log(datos);
            $(elemento).html(datos);   
            $(boton).attr("disabled", false);       
            load(1);
        }
    });
    }
    