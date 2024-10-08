doc.addEventListener('change', (e) => {
   if (e.target.matches('#inmobiliarios_alto_elemento1') || e.target.matches('#inmobiliarios_ancho_elemento1')
      || e.target.matches('#inmobiliarios_numero_caras1')) {
      let area = calcularArea(doc.getElementById('inmobiliarios_alto_elemento1').value, doc.getElementById('inmobiliarios_ancho_elemento1').value, 1);
      doc.getElementById('inmobiliarios_area_total_elemento1').value = area;
   }
});

function calcularArea(alto, ancho, caras ) {
   return (alto * ancho) * caras;
}
