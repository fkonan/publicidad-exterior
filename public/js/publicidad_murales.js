doc.addEventListener('change', (e) => {
   if (e.target.matches('#murales_alto_elemento1') || e.target.matches('#murales_ancho_elemento1')) {
      let area = calcularArea(doc.getElementById('murales_alto_elemento1').value, doc.getElementById('murales_ancho_elemento1').value,1);
      doc.getElementById('murales_area_total_elemento1').value = area;
   }
});

function calcularArea(alto, ancho, caras ) {
   return (alto * ancho) * caras;
}
