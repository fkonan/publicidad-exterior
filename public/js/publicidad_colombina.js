doc.addEventListener('change', (e) => {
   if (e.target.matches('#colombina_esquinero')) {
      if (e.target.value == "SI") {
         doc.getElementById('colombina_numero_elementos').value = '2';

         doc.getElementById('divElemento2').classList.remove('d-none');
         doc.getElementById('divFachada2').classList.remove('d-none');

         limpiarElementos2(true);
      }
      if (e.target.value == "NO") {
         document.getElementById('colombina_numero_elementos').value = '1';

         doc.getElementById('divElemento2').classList.add('d-none');
         doc.getElementById('divFachada2').classList.add('d-none');

         limpiarElementos2(false);
      }
   }

   if (e.target.matches('#colombina_alto_elemento1') || e.target.matches('#colombina_ancho_elemento1')) {
      let area = calcularArea(doc.getElementById('colombina_alto_elemento1').value, doc.getElementById('colombina_ancho_elemento1').value, doc.getElementById('colombina_numero_caras1').value);
      doc.getElementById('colombina_area_total_elemento1').value = area;
   }

   if (e.target.matches('#colombina_alto_elemento2') || e.target.matches('#colombina_ancho_elemento2')) {
      let area = calcularArea(doc.getElementById('colombina_alto_elemento2').value, doc.getElementById('colombina_ancho_elemento2').value, doc.getElementById('colombina_numero_caras2').value);
      doc.getElementById('colombina_area_total_elemento2').value = area;
   }

   if (e.target.matches('#colombina_alto_fachada1') || e.target.matches('#colombina_ancho_fachada1')) {
      let area = calcularArea(doc.getElementById('colombina_alto_fachada1').value, doc.getElementById('colombina_ancho_fachada1').value,1);
      doc.getElementById('colombina_area_total_fachada1').value = area;
      if (area>0 && area < 8) {
         Swal.fire({
            title: "¡Atención!",
            text: "Para las medidas especificadas no requiere permiso de publicidad exterior.",
            icon: "info"
         });
         doc.getElementById('btn_enviar_solicitud').disabled = true;
         return;
      } else {
         doc.getElementById('btn_enviar_solicitud').disabled = false;
      }
   }

   if (e.target.matches('#colombina_alto_fachada2') || e.target.matches('#colombina_ancho_fachada2')) {
      let area = calcularArea(doc.getElementById('colombina_alto_fachada2').value, doc.getElementById('colombina_ancho_fachada2').value,1);
      doc.getElementById('colombina_area_total_fachada2').value = area;
      if (area > 0 && area < 8) {
         Swal.fire({
            title: "¡Atención!",
            text: "Para las medidas especificadas no requiere permiso de publicidad exterior.",
            icon: "info"
         });
         doc.getElementById('btn_enviar_solicitud').disabled = true;
         return;
      }else{
         doc.getElementById('btn_enviar_solicitud').disabled = false;
      }
   }
});

function limpiarElementos2(required = false) {
   doc.getElementById('colombina_alto_elemento2').value = '';
   doc.getElementById('colombina_ancho_elemento2').value = '';
   doc.getElementById('colombina_area_total_elemento2').value = '';
   doc.getElementById('colombina_descripcion2').value = '';

   doc.getElementById('colombina_alto_fachada2').value = '';
   doc.getElementById('colombina_ancho_fachada2').value = '';
   doc.getElementById('colombina_area_total_fachada2').value = '';

   doc.getElementById('colombina_alto_elemento2').required = required;
   doc.getElementById('colombina_ancho_elemento2').required = required;
   doc.getElementById('colombina_area_total_elemento2').required = required;
   doc.getElementById('colombina_descripcion2').required = required;

   doc.getElementById('colombina_alto_fachada2').required = required;
   doc.getElementById('colombina_ancho_fachada2').required = required;
   doc.getElementById('colombina_area_total_fachada2').required = required;
}

function calcularArea(alto, ancho,caras) {
   return (alto * ancho)*caras;
}
