function pone_fecha(){
	
	
	var datos = new FormData();
	datos.append('accion','obtienefecha');
	enviaAjax(datos);	
	
}
function consultar(){
	var datos = new FormData();
	datos.append('accion','consultar');
	enviaAjax(datos);	
}
function destruyeDT(){
	//1 se destruye el datatablet
	if ($.fn.DataTable.isDataTable("#tablapersona")) {
            $("#tablapersona").DataTable().destroy();
    }
}
function crearDT(){
	//se crea nuevamente
    if (!$.fn.DataTable.isDataTable("#tablapersona")) {
            $("#tablapersona").DataTable({
              language: {
                lengthMenu: "Mostrar _MENU_ por página",
                zeroRecords: "No hay productos registrados",
                info: "Mostrando página _PAGE_ de _PAGES_",
                infoEmpty: "No hay productos registradoss",
                infoFiltered: "(filtrado de _MAX_ registros totales)",
                search: "Buscar:",
                paginate: {
                  first: "Primera",
                  last: "Última",
                  next: "Siguiente",
                  previous: "Anterior",
                },
              },
              autoWidth: false,
              order: [[1, "asc"]],
            });
    }         
}
$(document).ready(function(){
	//para obtener la fecha del servidor y calcular la 
	//edad de nacimiento que debe ser mayor a 18 
	pone_fecha();
	//fin de colocar fecha en input fecha de nacimiento
	
	//ejecuta una consulta a la base de datos para llenar la tabla
	consultar();




	
	
//VALIDACION DE DATOS	
	$("#codigo").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#codigo").on("keyup",function(){
		validarkeyup(/^[0-9]{1,5}$/,$(this),
		$("#scodigo"),"El código debe tener entre 1 y 5 dígitos numéricos");
	});
	
	
	$("#nombre").on("keypress",function(e){
		validarkeypress(/^[A-Za-z\b\s\u00f1\u00d1\u00E0-\u00FC]*$/,e);
	});
	
	$("#nombre").on("keyup",function(){
		validarkeyup(/^[a-zA-ZÀ-ÿ\s'-]{2,50}$/,
		$(this),$("#snombre"),"Solo letras en el nombre y minimo 3 caracteres");
	});
	
	$("#descripcion").on("keypress",function(e){
		validarkeypress(/^[A-Za-z\b\s\u00f1\u00d1\u00E0-\u00FC]*$/,e);
	});
	
	$("#descripcion").on("keyup",function(){
		validarkeyup(/^[A-Za-z\b\s\u00f1\u00d1\u00E0-\u00FC]{3,120}$/,
		$(this),$("#sdescripcion"),"Solo letras, Minimo 3 Maximo 120 Caracteres");
	});
	$("#cantidad").on("keypress",function(e){
		validarkeypress(/^[0-9-\b]*$/,e);
	});
	
	$("#cantidad").on("keyup",function(){
		validarkeyup(/^[0-9]{1,9}$/,$(this),
		$("#scantidad"),"Solo se permiten digitos con un maximo de 9");
	});

	$("#almacen").on("keypress",function(e){
		validarkeypress(/^[A-Za-z\b\s\u00f1\u00d1\u00E0-\u00FC]*$/,e);
	});
	
	$("#almacen").on("keyup",function(){
		validarkeyup(/^[a-zA-ZÀ-ÿ\s'-]{2,50}$/,
		$(this),$("#salmacen"),"Solo letras para el nombre de almacen/deposito");
	});

	
	
	
//FIN DE VALIDACION DE DATOS



//CONTROL DE BOTONES
$("#proceso").on("click",function(){
	if($(this).text()=="INCLUIR"){
		if(validarenvio()){
			var datos = new FormData();
			datos.append('accion','incluir');
			datos.append('codigo',$("#codigo").val());
			datos.append('nombre',$("#nombre").val());
			datos.append('descripcion',$("#descripcion").val());
			datos.append('cantidad',$("#cantidad").val());
			datos.append('proveedor',$("#proveedor").val());
			
			datos.append('almacen',$("#almacen").val());
			datos.append('cod_categoria',$("#cod_categoria").val());
			

			enviaAjax(datos);
		}
	}
	else if($(this).text()=="MODIFICAR"){
		if(validarenvio()){
			var datos = new FormData();
			datos.append('accion','modificar');
			datos.append('codigo',$("#codigo").val());
			datos.append('nombre',$("#nombre").val());
			datos.append('descripcion',$("#descripcion").val());
			datos.append('cantidad',$("#cantidad").val());
			datos.append('proveedor',$("#proveedor").val());
			datos.append('cod_categoria',$("#cod_categoria").val());
			datos.append('almacen',$("#almacen").val());

			
			enviaAjax(datos);
		}
	}
	if($(this).text()=="ELIMINAR"){
		if(validarkeyup(/^[0-9]{1,8}$/,$("#codigo"),
		$("#scodigo"),"el codigo debe ser de 1 a N digitos")==0){
	    muestraMensaje("Codigo del producto a eliminar invalido");	
		
	    }
		else{
			var datos = new FormData();
			datos.append('accion','eliminar');
			datos.append('codigo',$("#codigo").val());
			enviaAjax(datos);
		}
	}
});
$("#incluir").on("click",function(){
	limpia();
	$("#proceso").text("INCLUIR");
	$("#modal1").modal("show");
});





	
	
});

//Validación de todos los campos antes del envio
function validarenvio(){
	if(validarkeyup(/^[A-Za-z0-9]{1,5}$/,$("#codigo"),
	$("#scodigo"),"Campo obligatorio")==0){  		
	muestraMensaje("Este campo es obligatorio");	
	return false;					
}	
else if(validarkeyup(/^[A-Za-z\b\s\u00f1\u00d1\u00E0-\u00FC]{3,30}$/,
	$("#nombre"),$("#snombre"),"Campo obligatorio")==0){
	muestraMensaje("Este campo es obligatorio");
	return false;
}
else if(validarkeyup(/^[A-Za-z\b\s\u00f1\u00d1\u00E0-\u00FC]{3,120}$/,
	$("#descripcion"),$("#sdescripcion"),"Campo obligatorio")==0){
	muestraMensaje("Este campo es obligatorio");
	return false;
}
else if(validarkeyup(/^[0-9]{1,5}$/,
	$("#cantidad"),$("#scantidad"),"Campo obligatorio")==0){
	muestraMensaje("Este campo es obligatorio");
	return false;
}
else if(validarkeyup(/^[A-Za-z\b\s\u00f1\u00d1\u00E0-\u00FC]{3,30}$/,
	$("#almacen"),$("#salmacen"),"Campo obligatorio")==0){
	muestraMensaje("Este campo es obligatorio");
	return false;
}
return true;
}




//Funcion que muestra el modal con un mensaje
function muestraMensaje(mensaje){
	
	$("#contenidodemodal").html(mensaje);
			$("#mostrarmodal").modal("show");
			setTimeout(function() {
					$("#mostrarmodal").modal("hide");
			},5000);
}


//Función para validar por Keypress
function validarkeypress(er,e){
	
	key = e.keyCode;
	
	
    tecla = String.fromCharCode(key);
	
	
    a = er.test(tecla);
	
    if(!a){
	
		e.preventDefault();
    }
	
    
}
//Función para validar por keyup
function validarkeyup(er,etiqueta,etiquetamensaje,
mensaje){
	a = er.test(etiqueta.val());
	if(a){
		etiquetamensaje.text("");
		return 1;
	}
	else{
		etiquetamensaje.text(mensaje);
		return 0;
	}
}

//funcion para pasar de la lista a el formulario
function pone(pos,accion){
	
	linea=$(pos).closest('tr');


	if(accion==0){
		$("#proceso").text("MODIFICAR");
	}
	else{
		$("#proceso").text("ELIMINAR");
	}
	$("#codigo").val($(linea).find("td:eq(1)").text());
	$("#nombre").val($(linea).find("td:eq(2)").text());
	$("#descripcion").val($(linea).find("td:eq(3)").text());
	$("#cantidad").val($(linea).find("td:eq(4)").text());
	$("#proveedor").val($(linea).find("td:eq(5)").text());
	$("#categoria").val($(linea).find("td:eq(6)").text());
	$("#almacen").val($(linea).find("td:eq(7)").text());


	
	$("#modal1").modal("show");
}


//funcion que envia y recibe datos por AJAX
function enviaAjax(datos) {
  $.ajax({
    async: true,
    url: "",
    type: "POST",
    contentType: false,
    data: datos,
    processData: false,
    cache: false,
    beforeSend: function () {},
    timeout: 10000, //tiempo maximo de espera por la respuesta del servidor
    success: function (respuesta) {
    	console.log(respuesta);
      try {
        var lee = JSON.parse(respuesta);
        if (lee.resultado == "obtienefecha") {
          $("#fechadenacimiento").val(lee.mensaje);
        }
		else if (lee.resultado == "consultar") {
		   destruyeDT();	
           $("#resultadoconsulta").html(lee.mensaje);
		   crearDT();
        }

	
		else if (lee.resultado == "incluir") {
           muestraMensaje(lee.mensaje);
		   if(lee.mensaje=='Registro Inluido'){
			   $("#modal1").modal("hide");
			   consultar();
		   }
        }
		else if (lee.resultado == "modificar") {
           muestraMensaje(lee.mensaje);
		   if(lee.mensaje=='Registro Modificado'){
			   $("#modal1").modal("hide");
			   consultar();
		   }
        }
		else if (lee.resultado == "eliminar") {
           muestraMensaje(lee.mensaje);
		   if(lee.mensaje=='Registro Eliminado'){
			   $("#modal1").modal("hide");
			   consultar();
		   }
        }
		else if (lee.resultado == "error") {
           muestraMensaje(lee.mensaje);
        }
      } catch (e) {
        alert("Error en JSON " + e.name);
      }
    },
    error: function (request, status, err) {
      // si ocurrio un error en la trasmicion
      // o recepcion via ajax entra aca
      // y se muestran los mensaje del error
      if (status == "timeout") {
        //pasa cuando superan los 10000 10 segundos de timeout
        muestraMensaje("Servidor ocupado, intente de nuevo");
      } else {
        //cuando ocurre otro error con ajax
        muestraMensaje("ERROR: <br/>" + request + status + err);
      }
    },
    complete: function () {},
  });
}

function limpia(){
	pone_fecha();

	
	$("#codigo").val("");
	$("#nombre").val("");
	$("#proveedor").prop("selectedIndex",0);

}
