// FUNCIONES DE CAJA DE TEXTO.
/** Esta funcion me permite controlar los caracteres que se van a diguitar en el campo numero de documento **/
function NumDoc(e){

  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toLowerCase();
  letras = "0123456789-";
  especiales = [8,37,14,15,32,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,
    84,85,86,87,88,89,90,97,98,99,100,101,102,103,104,105,106,107,108,109,
    110,111,112,113,114,115,116,117,118,119,120,121,122,130,160,161,162,163,164,165,239];
  tecla_especial = false
      for(var i in especiales){
          if(key == especiales[i]){
            tecla_especial = true;
          break;
            }
        }

      if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}


/** Esta funcion me permite controlar los caracteres que se van a diguitar en el campo Nombres y Apellidos **/
function Letras(n){

  key = n.keyCode || n.which;
  tecla = String.fromCharCode(key).toLowerCase();
  numeros = "ñÑ ";
  especiales = [14,15,32,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,
  84,85,86,87,88,89,90,97,98,99,100,101,102,103,104,105,106,107,108,109,
  110,111,112,113,114,115,116,117,118,119,120,121,122,130,160,161,162,163,164,165,239];
  tecla_especial = false
      for(var i in especiales){
          if(key == especiales[i]){
            tecla_especial = true;
          break;
            }
        }

      if(numeros.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}

/** Esta funcion me permite controlar los caracteres que se van a diguitar en el campo Nombres y Apellidos **/
function Observaciones(n){

  key = n.keyCode || n.which;
  tecla = String.fromCharCode(key).toLowerCase();
  numeros = "ñÑ1234567890 -.,: ";
  especiales = [14,15,32,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,
  84,85,86,87,88,89,90,97,98,99,100,101,102,103,104,105,106,107,108,109,
  110,111,112,113,114,115,116,117,118,119,120,121,122,130,160,161,162,163,164,165,239];
  tecla_especial = false
      for(var i in especiales){
          if(key == especiales[i]){
            tecla_especial = true;
          break;
            }
        }

      if(numeros.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}


/**Esta funcion me permite convertir los textos digitados a mayusculas **/
function aMayusculas(obj,id){

    obj = obj.toUpperCase();
    document.getElementById(id).value = obj;
}

/** Esta funcion me devuelve solo los numeros se usa para las cajas varchar con opcion numerica o campos time y date**/
function Numeros(e){

    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = [8];
    tecla_especial = false
        for(var i in especiales){
            if(key == especiales[i]){
              tecla_especial = true;
            break;
              }
          }

        if(letras.indexOf(tecla)==-1 && !tecla_especial)
          return false;
}

function IP(e){

    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789.";
    especiales = [8,37];
    tecla_especial = false
        for(var i in especiales){
            if(key == especiales[i]){
              tecla_especial = true;
            break;
              }
          }

        if(letras.indexOf(tecla)==-1 && !tecla_especial)
          return false;
}


/** Funcion email la cual me permite la digitacion de los carateres necesarios para el registro de un correo electronico **/
function Email(em){

    key = em.keyCode || em.which;
    tecla = String.fromCharCode(key).toLowerCase();
    numeros = "@-_&.0123456789";
    especiales = [9,32,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,
    84,85,86,87,88,89,90,97,98,99,100,101,102,103,104,105,106,107,108,109,
    110,111,112,113,114,115,116,117,118,119,120,121,122];
    tecla_especial = false
        for(var i in especiales){
            if(key == especiales[i]){
              tecla_especial = true;
            break;
              }
          }

        if(numeros.indexOf(tecla)==-1 && !tecla_especial)
          return false;
}

// funcion para limitar campos de direcciones
function Direccion(n){

  key = n.keyCode || n.which;
  tecla = String.fromCharCode(key).toLowerCase();
  numeros = "0123456789-#ñÑ.: ";
  especiales = [14,15,32,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,
  84,85,86,87,88,89,90,97,98,99,100,101,102,103,104,105,106,107,108,109,
  110,111,112,113,114,115,116,117,118,119,120,121,122,130,160,161,162,163,164,165,239];
  tecla_especial = false
      for(var i in especiales){
          if(key == especiales[i]){
            tecla_especial = true;
          break;
            }
        }

      if(numeros.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}

// funcion campo date: maximo

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //
    var yyyy = today.getFullYear();
     if(dd<10){
            dd='0'+dd
        }
        if(mm<10){
            mm='0'+mm
        }

    // today = yyyy+'-'+mm+'-'+dd;
    // document.getElementById("fecha_matricula").setAttribute("max", today);



    // funciones espectaculos

    function agregarFila() {

      // Swal.fire('Any fool can use a computer')
      let tipo_boleteria = document.getElementById('tipo_boleteria').value;
      let valor_boleteria = document.getElementById('valor_boleteria').value;
      let cantidad_boleteria = document.getElementById('cantidad_boleteria').value;
      let table = document.getElementById("tablaBoleteria");
      var tbodyRowCount = table.tBodies[0].rows.length;
      var id_table = 1 +tbodyRowCount;





      let valor_boletas = new Intl.NumberFormat("es-CO").format(valor_boleteria);

      if (tipo_boleteria.length == 0) {
       Swal.fire('Debes completar el campo tipo de boleteria')
         return;
      }

      if (valor_boleteria.length == 0) {
        Swal.fire('Debes completar el campo valor de boleteria')
        return;
      }

      if (cantidad_boleteria.length == 0) {
        Swal.fire('Debes completar el campo Numero de boleteria')
        return;
      }

      if(valor_boleteria.startsWith("0")){
        valor_boleteria = "0";
     }
     if(cantidad_boleteria.startsWith("0")){
      cantidad_boleteria = "0";
    }



      document.getElementById("tablaBoleteria").getElementsByTagName('tbody')[0].insertRow(-1).innerHTML =
         `<tr id="boleta_${id_table}">
            <td data-tb="${tipo_boleteria}" id="boleta_${id_table}">
               ${tipo_boleteria}
            </td>
            <td data-vb="${valor_boleteria}">
               $${valor_boletas}
            </td>
            <td data-cantidad="${cantidad_boleteria}">
            ${cantidad_boleteria}
            </td>
            <td>
               <div class="row">
                  <div class="col">
                  <div class="btn-group" role="group" aria-label="Basic example">
                  <a onClick="editarFila('${tipo_boleteria}',${valor_boleteria},${cantidad_boleteria},${id_table})" class="btn btn-success btn-xs btn-sm col text-white">
                        Editar
                     </a>
                     <a onClick="eliminarFila(this)" class="btn btn-danger btn-xs btn-sm col text-white">
                        Eliminar
                     </a>
                     </div>
                  </div>
               </div>
            </td>
         </tr>`;
      $("#tipo_boleteria").val('');
      $("#valor_boleteria").val('');
      $("#cantidad_boleteria").val('');

      // let total_oculto = Number(total) + Number(subtotal);
      // let suma_total = new Intl.NumberFormat("es-CO").format(total_oculto);
      // $('#total').val(suma_total);
      // $('#total_oculto').val(total_oculto);
      $('#ModalBoleteria').modal('hide');

    }

    function eliminarFila(fila) {

      Swal.fire({
        title: 'ESTAS SEGURO DE ELIMINAR ESTE REGISTRO?',
        text: "Este cambio es irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3772FF',
        cancelButtonColor: '#A80521',
        confirmButtonText: 'Si, eliminar'
      }).then((result) => {
        if (result.isConfirmed) {
          fila.closest("tr").remove();
          return;

        }
      })



    }

    function editarFila(tipo,valor,cantidad,id_fila) {

      $('#ModalBoleteria').modal('show');
      $('#btnBoleteria').addClass('d-none');
      $('#btnEditBoleteria').removeClass('d-none');
      $('#tipo_boleteria').val(tipo);
      $('#valor_boleteria').val(valor);
      $('#cantidad_boleteria').val(cantidad);
      $('#parametro').val(id_fila);

    }
    function updateFila(){


      let parametro = document.getElementById('parametro').value;
      $('#boleta_'+parametro).parent().remove();
      agregarFila();



    }

    function borrarCampos(){
      $("#tipo_boleteria").val('');
      $("#valor_boleteria").val('');
      $("#cantidad_boleteria").val('');
      return;


    }
    function openModal(){
      $("#tipo_boleteria").val('');
      $("#valor_boleteria").val('');
      $("#cantidad_boleteria").val('');
      $('#ModalBoleteria').modal('show');
      $('#btnBoleteria').removeClass('d-none');
      $('#btnEditBoleteria').addClass('d-none');

    }

    Array.prototype.forEach.call(document.getElementsByClassName('g-recaptcha'), function(element) {
      //Add a load event listener to each wrapper, using capture.
      element.addEventListener('load', function(e) {
          //Get the data-tabindex attribute value from the wrapper.
          var tabindex = e.currentTarget.getAttribute('data-tabindex');
          //Check if the attribute is set.
          if (tabindex) {
              //Set the tabIndex on the iframe.
              e.target.tabIndex = tabindex;
          }
      }, true);
  });

  document.addEventListener('submit',(e)=>{
      if(e.target.matches('.formConsultarTramite')){
       let response = grecaptcha.getResponse();
      if (response.length == 0) {
        alert("Captcha no verificado");
        e.preventDefault();
        return;
     }
    }
  })

  document.addEventListener('keypress', (e)=>{
    if(e.target.matches('.labelGen')){
      if(e.keyCode === 13 || e.keyCode === 32){
        if(e.target.firstElementChild.tagName ==='INPUT'){
          e.target.firstElementChild.checked = true;

        }
      }

    }
  })

   //  var button = document.getElementById('button-modal');
   //  button.addEventListener("keypress", function(event) {
   //   if (event.key === "Enter") {
   //     event.preventDefault();
   //     button.click();
   //   }
   // });


   // var button2 = document.getElementById('button-modal-2');
   // button2.addEventListener("keypress", function(event) {
   //   if (event.key === "Enter") {
   //     event.preventDefault();
   //     button2.click();
   //   }
   // });





