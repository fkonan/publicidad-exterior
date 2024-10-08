const doc = document;
doc.addEventListener('DOMContentLoaded', function () {

   doc.addEventListener('click', (e) => {

      if (e.target.matches('.btnValidar')) {
         let documento = doc.getElementById('PersonaDoc').value;
         let tipo_documento = doc.getElementById('PersonaTipDoc').value;

         $(doc).on({
            ajaxStart: function () {
               $("#loadMe").modal({
                  backdrop: "static",
                  keyboard: false,
                  show: true,
               });
            },
            ajaxStop: function () {
               setInterval(() => {
                  $('#loadMe').modal('hide');
               }, 1000);
            }
         });

         $.ajax({
            type: "GET",
            url: "/publicidad-exterior/validar-documento",
            data: {
               'documento': documento, 'tipo_documento': tipo_documento
            },

            success: function (response) {
               if (response.success) {
                  doc.getElementById('dir_solicitante').value = response.persona.PersonaDir;
                  doc.getElementById('PersonaTel').value = response.persona.PersonaTel;
                  doc.getElementById('PersonaMail').value = response.persona.PersonaMail;
                  doc.getElementById('PersonaBarrio').value = response.persona.PersonaBarrio;
                  $("#PersonaBarrio").trigger('change.select2');
                  doc.getElementById('PersonaTip').value = response.persona.PersonaTip;
                  validarTipoPersona(response.persona.PersonaTip);
                  doc.getElementById('PersonaNombre').value = response.persona.PersonaNombre;
                  doc.getElementById('PersonaApe').value = response.persona.PersonaApe;
                  doc.getElementById('PersonaRazon').value = response.persona.PersonaRazon;

                  doc.getElementById('divInfo').classList.remove('d-none');
                  $('#loadMe').modal('hide');
               } else {
                  doc.getElementById('divInfo').classList.remove('d-none');
                  $('#loadMe').modal('hide');
               }
            },
            error: function () {
               alert("error de petición ajax");
            },
         }).done(function () {
            console.log('done')
            $('#loadMe').modal('hide');
         })
      }

   });

   doc.addEventListener('change', (e) => {
      if (e.target.matches('#PersonaTip')) {
         validarTipoPersona(e.target.value);
      }

      if (e.target.matches('#tipo_publicidad')) {
         if (e.target.value == 'RENOVACION') {
            doc.getElementById('divRenovacion').classList.remove('d-none');
            doc.getElementById('fecha_vencimiento').value = '';
            doc.getElementById('fecha_renovacion').value = '';
            doc.getElementById('fecha_vencimiento').required = true;
            doc.getElementById('fecha_renovacion').required = true;
         } else {
            doc.getElementById('divRenovacion').classList.add('d-none');
            doc.getElementById('fecha_vencimiento').value = '';
            doc.getElementById('fecha_renovacion').value = '';
            doc.getElementById('fecha_vencimiento').required = false;
            doc.getElementById('fecha_renovacion').required = false;
         }
      }

      if (e.target.matches('#publicidad_modalidad')) {
         let modalidad = e.target.value;
         if (modalidad) {
            $.ajax({
               url: '/publicidad-exterior/solicitud/modalidad/' + modalidad,
               type: 'GET',
               success: function (response) {
                  $('#divVistasModalidades').html(response);
                  cargarAdjuntos(modalidad);

                  $('#dynamic-script').remove();
                  // Cargar el nuevo script correspondiente a la modalidad
                  var scriptPath = '/js/publicidad_' + modalidad + '.js';
                  var scriptElement = document.createElement('script');
                  scriptElement.src = scriptPath;
                  scriptElement.id = 'dynamic-script'; // Para que sea fácil de eliminar después si cambia la modalidad
                  document.body.appendChild(scriptElement);
               },
               error: function (xhr) {
                  $('#divVistasModalidades').html('<p>Ha ocurrido un error al cargar la vista.</p>');
               }
            });
         } else {
            $('#divVistasModalidades').html(''); // Limpiar el div si no hay selección
            $('#dynamic-script').remove();
         }
      }
   });


   let frmPersona = doc.getElementById('myForm');

   if (frmPersona){
      frmPersona.addEventListener('submit', (e) => {
         e.preventDefault();
         let formData = new FormData(frmPersona);

         $(doc).on({
            ajaxStart: function () {
               $("#loadMe").modal({
                  backdrop: "static",
                  keyboard: false,
                  show: true,
               });
            },
            ajaxStop: function () {
               setInterval(() => {
                  $('#loadMe').modal('hide');
               }, 1000);
            }
         });
         $.ajax({
            type: "POST",
            url: "/publicidad-exterior/personas/guardar",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {

            },
            success: function (response) {
               if (response.success) {
                  $('#loadMe').modal('hide');
                  Swal.fire({
                     icon: 'success',
                     title: 'Persona guardada correctamete',
                     text: 'Continue haciendo su solicitud'
                  });
                  setInterval(() => {
                     window.location.href = "/publicidad-exterior/solicitud/" + response.persona.PersonaDoc;
                  }, 2000);
               } else {
                  $('#loadMe').modal('hide');
                  printErrorMsg(response.error);
               }
            },
            error: function () {
               alert("error de petición ajax");
            },
         }).done(function () {
            $('#loadMe').modal('hide');
         })
      });
   }
});

function cargarAdjuntos(modalidad) {
   $(doc).on({
      ajaxStart: function () {
         $("#loadMe").modal({
            backdrop: "static",
            keyboard: false,
            show: true,
         });
      },
      ajaxStop: function () {
         setInterval(() => {
            $('#loadMe').modal('hide');
         }, 1000);
      }
   });
   $.ajax({
      type: "GET",
      url: "/publicidad-exterior/cargar-documentos/" + modalidad,

      success: function (response) {
         if (response.success) {
            let datos = response.documentos;
            let adjuntos = '';
            let divAdjuntos = doc.getElementById('divAdjuntos');
            divAdjuntos.innerHTML = '';

            datos.forEach(el => {
               adjuntos = `
               <div class="col-md-6">
                  <label for="${el.codigo_adjunto}" class="form-label">${el.titulo_adjunto}</label>
                  <div class="form-group">
                     <input class="documentos_adjuntos form-control" id="${el.codigo_adjunto}" accept="application/pdf" name="${el.codigo_adjunto}" type="file" data-overwrite-initial="true">
                  </div>
               </div>`;
               divAdjuntos.innerHTML += adjuntos;
            });

            datos.forEach(el => {
               $('#' + el.codigo_adjunto).fileinput({
                  theme: 'fas',
                  language: 'es',
                  browseClass: 'btn btn-primary',
                  browseLabel: 'Examinar',
                  removeClass: 'btn btn-danger',
                  allowedFileExtensions: [
                     'pdf'
                  ],
                  overwriteInitial: true,
                  maxFileSize: 10000
               });
            });
            $('#loadMe').modal('hide');
         } else {
            doc.getElementById('divInfo').classList.remove('d-none');
            $('#loadMe').modal('hide');
         }
      },
      error: function () {
         alert("error de petición ajax");
      },
   }).done(function () {
      console.log('done')
      $('#loadMe').modal('hide');
   })
}

function validarTipoPersona(value) {
   if (value == 'Juridica') {
      doc.getElementById('natural_nombre').classList.add('d-none');
      doc.getElementById('natural_ape').classList.add('d-none');
      doc.getElementById('juridica').classList.remove('d-none');
   }
   if (value == 'Natural') {
      doc.getElementById('natural_nombre').classList.remove('d-none');
      doc.getElementById('natural_ape').classList.remove('d-none');
      doc.getElementById('juridica').classList.add('d-none');
   }
   doc.getElementById('PersonaNombre').value = '';
   doc.getElementById('PersonaApe').value = '';
   doc.getElementById('PersonaRazon').value = '';
}







$("#PersonaBarrio").select2({
   width: "100%",
   placeholder: "Seleccione",
});

let fecha_instalacion = document.getElementById('fecha_instalacion');
let div_fecha_instalacion = document.getElementById('div_fecha_instalacion');

$('#publicidad_instalada').change(function (e) {
   if (e.target.value == 'SI') {
      div_fecha_instalacion.classList.remove('d-none');
      $("#publicidad_instalada").prop('required', true);
      fecha_instalacion.value = "";
   }
   if (e.target.value == 'NO') {
      div_fecha_instalacion.classList.add('d-none');
      $("#publicidad_instalada").prop('required', false);
      fecha_instalacion.value = "";
   }
});

$(".tablas-publicidad").DataTable({
   language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
         sFirst: "Primero",
         sLast: "Último",
         sNext: "Siguiente",
         sPrevious: "Anterior",
      },

      oAria: {
         sSortAscending:
            ": Activar para ordenar la columna de manera ascendente",
         sSortDescending:
            ": Activar para ordenar la columna de manera descendente",
      },
   },
   responsive: true,
   scrollX: 400,
   scrollCollapse: true,
   pageLength: 3
});

$('.adj_certificado_lyt').fileinput({
   theme: 'fas',
   language: 'es',
   browseClass: 'btn btn-primary',
   browseLabel: 'Examinar',
   removeClass: 'btn btn-danger',
   allowedFileExtensions: [
      'pdf'
   ],
   overwriteInitial: true,
   maxFileSize: 10000
});

$('.adj_camara_comercio').fileinput({
   theme: 'fas',
   language: 'es',
   browseClass: 'btn btn-primary',
   browseLabel: 'Examinar',
   removeClass: 'btn btn-danger',
   allowedFileExtensions: [
      'pdf'
   ],
   overwriteInitial: true,
   maxFileSize: 10000
});

$('.adj_autorizacion_propietarios').fileinput({
   theme: 'fas',
   language: 'es',
   browseClass: 'btn btn-primary',
   browseLabel: 'Examinar',
   removeClass: 'btn btn-danger',
   allowedFileExtensions: [
      'pdf'
   ],
   overwriteInitial: true,
   maxFileSize: 10000
});

$('.adj_fotomontaje').fileinput({
   theme: 'fas',
   language: 'es',
   browseClass: 'btn btn-primary',
   browseLabel: 'Examinar',
   removeClass: 'btn btn-danger',
   allowedFileExtensions: [
      'pdf'
   ],
   overwriteInitial: true,
   maxFileSize: 10000
});

$('.documentos_publicidad').fileinput({
   theme: 'fas',
   language: 'es',
   browseClass: 'btn btn-primary',
   browseLabel: 'Examinar',
   removeClass: 'btn btn-danger',
   allowedFileExtensions: [
      'pdf'
   ],
   overwriteInitial: true,
   maxFileSize: 10000
});




