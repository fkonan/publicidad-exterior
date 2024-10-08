doc.addEventListener('change', (e) => {
   if (e.target.matches('#comerciales_esquinero')) {
      if (e.target.value == "SI") {
         doc.getElementById('comerciales_numero_elementos').value = '2';

         doc.getElementById('divElemento2').classList.remove('d-none');
         doc.getElementById('divFachada2').classList.remove('d-none');

         limpiarElementos2(true);
      }
      if (e.target.value == "NO") {
         document.getElementById('comerciales_numero_elementos').value = '1';

         doc.getElementById('divElemento2').classList.add('d-none');
         doc.getElementById('divFachada2').classList.add('d-none');

         limpiarElementos2(false);
      }
   }

   if (e.target.matches('#comerciales_alto_elemento1') || e.target.matches('#comerciales_ancho_elemento1')) {
      let area = calcularArea(doc.getElementById('comerciales_alto_elemento1').value, doc.getElementById('comerciales_ancho_elemento1').value);
      doc.getElementById('comerciales_area_total_elemento1').value = area;
   }

   if (e.target.matches('#comerciales_alto_elemento2') || e.target.matches('#comerciales_ancho_elemento2')) {
      let area = calcularArea(doc.getElementById('comerciales_alto_elemento2').value, doc.getElementById('comerciales_ancho_elemento2').value);
      doc.getElementById('comerciales_area_total_elemento2').value = area;
   }

   if (e.target.matches('#comerciales_alto_fachada1') || e.target.matches('#comerciales_ancho_fachada1')) {
      let area = calcularArea(doc.getElementById('comerciales_alto_fachada1').value, doc.getElementById('comerciales_ancho_fachada1').value);
      doc.getElementById('comerciales_area_total_fachada1').value = area;
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

   if (e.target.matches('#comerciales_alto_fachada2') || e.target.matches('#comerciales_ancho_fachada2')) {
      let area = calcularArea(doc.getElementById('comerciales_alto_fachada2').value, doc.getElementById('comerciales_ancho_fachada2').value);
      doc.getElementById('comerciales_area_total_fachada2').value = area;
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
   doc.getElementById('comerciales_alto_elemento2').value = '';
   doc.getElementById('comerciales_ancho_elemento2').value = '';
   doc.getElementById('comerciales_area_total_elemento2').value = '';

   doc.getElementById('comerciales_alto_fachada2').value = '';
   doc.getElementById('comerciales_ancho_fachada2').value = '';
   doc.getElementById('comerciales_area_total_fachada2').value = '';

   doc.getElementById('comerciales_alto_elemento2').required = required;
   doc.getElementById('comerciales_ancho_elemento2').required = required;
   doc.getElementById('comerciales_area_total_elemento2').required = required;

   doc.getElementById('comerciales_alto_fachada2').required = required;
   doc.getElementById('comerciales_ancho_fachada2').required = required;
   doc.getElementById('comerciales_area_total_fachada2').required = required;
}

function calcularArea(alto, ancho) {
   return alto * ancho;
}
