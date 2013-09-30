
function display_informacion(){
	$("#div_info").show("slow");
	$("#div_contacto").css("display", "none");	
	$("#div_productos").css("display", "none");	
	$("#div_estetica").css("display", "none");	
        $("#li_info").attr("class", "active");
	$("#li_contacto").attr("class", null);
	$("#li_productos").attr("class", null);
	$("#li_estetica").attr("class", null);
}		

function display_contacto(){
	$("#div_info").css("display", "none");	
	$("#div_contacto").show("slow");
	$("#div_productos").css("display", "none");	
	$("#div_estetica").css("display", "none");	
        $("#li_info").attr("class", null);
	$("#li_contacto").attr("class", "active");
	$("#li_productos").attr("class", null);
	$("#li_estetica").attr("class", null);
}
function display_productos(){
	$("#div_info").css("display", "none");	
	$("#div_contacto").css("display", "none");	
	$("#div_productos").show("slow");
	$("#div_estetica").css("display", "none");	
        $("#li_info").attr("class", null);
	$("#li_contacto").attr("class", null);
	$("#li_productos").attr("class", "active");
	$("#li_estetica").attr("class", null);
}
function display_estetica(){
	$("#div_info").css("display", "none");	
	$("#div_contacto").css("display", "none");	
	$("#div_productos").css("display", "none");	
	$("#div_estetica").show("slow");
        $("#li_info").attr("class", null);
	$("#li_contacto").attr("class", null);
	$("#li_productos").attr("class", null);
	$("#li_estetica").attr("class", "active");
}

function validar(formulario) {
  if (formulario.nombre.value.length < 4) {
    alert("Escriba por lo menos 4 caracteres en el campo \"Nombre\".");
    formulario.nombre.focus();
    return (false);
  }
  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú ";
  var checkStr = formulario.nombre.value;
  var allValid = true; 
  for (i = 0; i < checkStr.length; i++) {
    ch = checkStr.charAt(i); 
    for (j = 0; j < checkOK.length; j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length) { 
      allValid = false; 
      break; 
    }
  }
  if (!allValid) { 
    alert("Escriba sólo letras en el campo \"Nombre\"."); 
    formulario.nombre.focus(); 
    return (false); 
  } 
  var checkOK = "0123456789"; 
  var checkStr = formulario.edad.value; 
  var allValid = true; 
  var decPoints = 0; 
  var allNum = ""; 
  for (i = 0; i < checkStr.length; i++) { 
    ch = checkStr.charAt(i); 
    for (j = 0; j < checkOK.length; j++) 
      if (ch == checkOK.charAt(j))
        break; 
    if (j == checkOK.length) { 
      allValid = false; 
      break; 
    } 
    allNum += ch; 
  } 
  if (!allValid) { 
    alert("Escriba sólo dígitos en el campo \"Edad\".");
    formulario.edad.focus(); 
    return (false); 
  } 
  var chkVal = allNum; 
  var prsVal = parseInt(allNum); 
  if (chkVal != "" && !(prsVal >= "18" && prsVal <= "30")) { 
    alert("Escriba un valor mayor o igual que 18 y menor o igual que 30 en el campo \"Edad\"."); 
    formulario.edad.focus();
    return (false); 
  }
  if ((formulario.correo.value.indexOf ('@', 0) == -1)||(formulario.correo.value.length < 5)) { 
    alert("Escriba una dirección de correo válida en el campo \"Dirección de correo\"."); 
    return (false); 
  }
  return (true); 
}


function agregar_producto(){
				contador++;
				
				var id ='<div class="well"><table><label><tr><td> Id Modelo: </td><td><input style="width:100px" type="text" class="nombremodelo" name="nombremodelo'+contador+'" id="nombremodelo'+contador+'"></td></tr></label>';
               var tipo =' <label><tr><td> Tipo de Modelo: </td><td><input style="width:100px" type="text" class="tipodemodelo" name="tipodemodelo'+contador+'" id="tipodemodelo'+contador+'"></td></tr></label> ';
               var nombreusuario =' <label><tr><td> Nombre Usuario: </td><td><input style="width:100px" type="text" class="nombreusuario" name="nombreusuario'+contador+'" id="nombreusuario'+contador+'"></td></tr></label>';
               var nombreti = '<label><tr><td> Nombre Contraparte TI: </td><td><input style="width:100px" type="text" class="nombreti" name="nombreti'+contador+'" id="nombreti'+contador+'"></td></tr></label>';
               var versionqlikview =' <label><tr><td> Version Qlikview: </td><td><input style="width:100px" type="text" class="versionqlikview'+contador+'" name="versionqlikview'+contador+'" id="versionqlikview'+contador+'"></td></tr></label>';
               var tiempomodelo = ' <label><tr><td> Tiempo de Recarga Modelo: </td><td><input style="width:100px" type="text" class="tiemporegarga" name="tiemporegarga'+contador+'" id="tiemporegarga'+contador+'"></td></tr></label>';
                var tiempogestion =' <label><tr><td> Tiempo de recarga Gestiones: </td><td><input style="width:100px" type="text" class="tiempogestion" name="tiempogestion'+contador+'" id="tiempogestion'+contador+'"></td></tr></label> ';
          		var def ='<label><tr><td> Definicion: </td><td><textarea name="definicion'+contador+'"  style="margin-left:0px;" id="definicion'+contador+'" class="definicion"></textarea></td></tr></label> </table></div>';

				
				var boton = '<a class="btn btn-primary btn-large" style="margin-left:1%" id="agregar_tabla" href="javascript:agregar_tabla2()">Nueva Tabla</a>';

				
			
				var inicio_fieldset='<fieldset>';		
				var fin_fieldset='</fieldset>';	
				//var listar = inicio_fieldset+nombre+precio+descripcion+producto+fin_fieldsetssssssprueba;				
				var listar = inicio_fieldset+id+tipo+nombreusuario+nombreti+versionqlikview+tiempomodelo+tiempogestion+def+boton+fin_fieldset;				
       			$('#lista_productos').append(listar);			
}


var contadore=1;
function agregar_tabla(){
				contadore++;
				
         		var nombretabla ='<label> Nombre Tabla: <input style="width:100px" type="text" class="nombretabla" name="nombretabla'+contadore+'" id="nombretabla'+contadore+'"></label>';
                var fuente ='<label> Fuente: <input style="width:100px" type="text" class="fuente" name="fuente'+contadore+'" id="fuente'+contadore+'"></label>';
                var definicion ='<label> Definicion: <textarea name="descripcion'+contadore+'"  style="margin-left:0px;" id="descripcion'+contadore+'" class="descripcion"></textarea></label>';
			
			
				var inicio_fieldset='<fieldset>';		
				var fin_fieldset='</fieldset>';	
				var listar = inicio_fieldset+nombretabla+fuente+definicion+fin_fieldset;				
       			$('#lista_tablas').append(listar);			
}

var contadores=1;
function agregar_tabla2(){
				contadores++;
				
         		var nombretabla ='<label> Nombre Tabla: <input style="width:100px" type="text" class="nombretabla" name="nombretabla'+contadores+'" id="nombretabla'+contadores+'"></label>';
                var fuente ='<label> Fuente: <input style="width:100px" type="text" class="fuente" name="fuente'+contadores+'" id="fuente'+contadores+'"></label>';
                var definicion ='<label> Definicion: <textarea name="descripcion'+contadores+'"  style="margin-left:0px;" id="descripcion'+contadores+'" class="descripcion"></textarea></label>';
			
			
				var inicio_fieldset='<fieldset>';		
				var fin_fieldset='</fieldset>';	
				var listar = inicio_fieldset+nombretabla+fuente+definicion+fin_fieldset;				
       			$('#lista_productos').append(listar);			
}



/*


				<div id="TabbedPanels2" class="TabbedPanels">
                  <ul class="TabbedPanelsTabGroup">
                    <li class="TabbedPanelsTab" tabindex="0">Ficha 1</li>
                    <li class="TabbedPanelsTab" tabindex="0">Ficha 2</li>
                  </ul>
                  <div class="TabbedPanelsContentGroup">
                    <div class="TabbedPanelsContent">Contenido 1</div>
                    <div class="TabbedPanelsContent">Contenido 2</div>
                  </div>
                </div>*/




/*function agregar_foto(){
				contador_fotos++;
				//console.debug(contador);			
				var producto = '<label>Foto de pagina: <input type="hidden" name="MAX_FILE_SIZE" value="300000" /><input name="foto'+contador_fotos+'" type="file" id="foto'+contador_fotos+'" class="archivo_3"></label>';
				var inicio_fieldset='<fieldset>';		
				var fin_fieldset='</fieldset>';							
				var listar = inicio_fieldset+producto+fin_fieldset;				
       			$('#div_fotos').append(listar);			
}*/
function guardar_nueva_pagina(){
	 document.formulario_general.submit();
	/*$('#formulario_general').submit(function() {
			var precios=[];
			var nombre_productos=[];
			$(".precio").each(function(){
				precios.push($(this).val())
			});
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: precios,
				dataType: "json",
				// Mostramos un mensaje con la respuesta de PHP
				success: function(data) {
					alert("hola");
					//$('#result').html(data);
				}
			})        
		
		});*/
	/*ños productos tienen q haberu n boton agregar que agrege 1 ipmut de foto a la vez y eso finalmente enviarlo a la bd junto con todo lo otro
	/*titulo descripcion  mision  vision fono mail face direccion*/
	/*
	    var Formulario = document.formulario_general; 
        var longitudFormulario = Formulario.elements.length; 
        var cadenaFormulario = ""; 
        var sepCampos; 
        sepCampos = ""; 
        for (var i=0; i <= Formulario.elements.length-1;i++) { 
            cadenaFormulario += sepCampos+Formulario.elements[i].name+'='+encodeURI(Formulario.elements[i].value); 
            sepCampos="&"; 
    } 
	$.ajax({
		type: "POST",
		url: "guardar_pagina.php",
		data:cadenaFormulario,
		dataType: "json",
		success: function(data){
			}
		});
		/*
	var titulo =$("#titulo_empresa").val();	
	var descripcion =$("#descripcion").val();
	var servicio=$("#servicio").val();	
	var mision =$("#mision").val();	
	var vision =$("#vision").val();	
	var fono =$("#fono").val();	
	var mail =$("#mail").val();
	var face =$("#face").val();	
	var direccion =$("#direccion").val();	
	var precios=[];
	var nombre_productos=[];
	var archivo_1=[];
	var archivo_2=[];
	$(".precio").each(function(){
		precios.push($(this).val())
	});    
	$(".nombre_producto").each(function(){
		nombre_productos.push($(this).val());
	});   
	$(".archivo_1").each(function(){
		archivo_1.push($(this).val());
	});
	$(".archivo_2").each(function(){
		archivo_2.push($(this).val());
	});
	console.debug(archivo_1+"\n"+archivo_2);
	var mensaje = {
                "titulo" : titulo,
                "descripcion" : descripcion,
				"servicio": servicio,
				"mision" : mision,
				"vision" : vision,
				"fono" : fono,
				"mail" : mail,
				"face" : face,
				"direccion" : direccion,
				"precios": precios,
				"nombre_productos": nombre_productos,
				"archivo_1": archivo_1,
				"archivo_2": archivo_2,				
				
				
        };
	/*$('#formulario_general').submit(function() {
		$.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
			dataType: "json",
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                //$('#result').html(data);
            }
        })        
	
	});*/
	/*$.ajax({
		type: "POST",
		url: "guardar_pagina.php",
		data:mensaje,
		dataType: "json",
		success: function(data){
			}
		});
	*/
}