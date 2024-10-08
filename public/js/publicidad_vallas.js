doc.addEventListener('change', (e) => {
   if (e.target.matches('#vallas_alto_elemento1') || e.target.matches('#vallas_ancho_elemento1')
      || e.target.matches('#vallas_numero_caras1')) {
      let area = calcularArea(doc.getElementById('vallas_alto_elemento1').value, doc.getElementById('vallas_ancho_elemento1').value, doc.getElementById('vallas_numero_caras1').value);
      doc.getElementById('vallas_area_total_elemento1').value = area;
   }
});

function calcularArea(alto, ancho, caras ) {
   return (alto * ancho) * caras;
}
