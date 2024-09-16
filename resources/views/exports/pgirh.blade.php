<style>
        
    .tftable {font-size:10px;color:#333333;width:90%;border-width: 1px;border-color: black;border-collapse: collapse; overflow:auto;}
    .tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: black;text-align:left;}
    .tftable tr {background-color:#ffffff;}
    .tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: black;  text-align: center;
      /* center checkbox horizontally */
      vertical-align: middle;
      /* center checkbox vertically */}
    
    .tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: black;border-collapse: collapse; overflow:auto;}
    .tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: black;text-align:left;}
    .tftable tr {background-color:#ffffff;}
    .tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: black;  text-align: center;
      /* center checkbox horizontally */
      vertical-align: middle;
      /* center checkbox vertically */}
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0}
    input[type=number] {
      -moz-appearance:textfield;
    
    }

  table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
    
    </style>

<table class="tftable overflow-x-scroll" border="2" width="100%">
    <tr>
   <th colspan="16" style="text-align:center; font-size:14px; background-color:#6FF473;"><b>REPORTE FORMULARIO RH1 / GENERACIÓN DE RESIDUOS</b></th>
    </tr>
    <tr>
      <th colspan="3" style="font-size: 12px;">
      <b>Empresa:</b>
      </th>
      <th colspan="5" style="font-size: 12px;">{{$empresa}}</th>
      <th colspan="2" style="font-size: 12px;"><b>NIT:</b></th>
      <th colspan="2" style="font-size: 12px; text-align: left;">{{$nit}}</th>
      <th colspan="2" style="font-size: 12px;"><b>SEDE:</b></th>
      <th colspan="2" style="font-size: 12px; text-align: left;">{{$sede}}</th>
    </tr>
    <tr>
      <th style="font-size: 9px;">Mes</th>
      <th style="font-size: 9px; background-color: #00B050;">Orgánicos aprovechables<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #fff;">Aprovechables<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #000000; color:#ffffff">No aprovechables<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #FF0000;color:#000">Biosanitarios<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #FF0000;color:#000">Anatomopatologicos<br>  (Kg)</th>
      <th style="font-size: 9px; background-color: #FF0000;color:#000">Cortopunzantes<br>  (Kg)</th>
      <th style="font-size: 9px; background-color: #FF0000;color:#000">Animales<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #FF0000;color:#000">Farmacos<br> (Kg)</th >
      <th style="font-size: 9px; background-color: #FF0000;color:#000">Citóxicos<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #FF0000;color:#000">Metales Pesados<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #FF0000;color:#000">Reactivos <br> (Kg)</th>
      <th style="font-size: 9px; background-color: #FF0000;color:#000">Contenedores Presurizados<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #FF0000;color:#000;">Aceites Usados <br>(Kg)</th>
      <th style="font-size: 9px; background-color: #FF0000;color:#000;">Fuentes Abiertas <br></th>
      <th style="font-size: 9px; background-color: #FF0000;color:#000;">Fuentes Cerradas <br></th>
      {{-- <th style="font-size: 9px; background-color: #FF0000;color:#000;">Pilas<br>(Kg)</th> --}}
    </tr>
    @php
     $sumBiod =0; 
     $sumReci =0; 
     $sumOrd=0;
     $sumBios = 0; 
     $sumAna = 0; 
     $sumCorto = 0; 
     $sumAni = 0;
     $sumCorr=0; 
     $sumToxi=0;
     $sumInfla = 0;
     $sumExplo = 0;
     $sumRea = 0;
     $sumRAEES = 0;
     $sumLumi = 0;
     $sumPilas = 0;
    //  $sumToner = 0;
     @endphp                                 
   @foreach ($detalle as $item)
    <tr>
      <td>{{$item->mes}}</td>
      <td>{{$item->biodegradable}}</td>
      <td>{{$item->reciclables}}</td>
      <td>{{$item->ordinarios}}</td>
      <td>{{$item->biosanitarios}}</td>
      <td>{{$item->anatomopatologicos}}</td>
      <td>{{$item->cortopunzantes}}</td>
      <td>{{$item->animales}}</td>
      <td>{{$item->farmacos}}</td>
      <td>{{$item->citoxicos}}</td>
      <td>{{$item->metales}}</td>
      <td>{{$item->reactivos}}</td>
      <td>{{$item->contenedores}}</td>
      <td>{{$item->aceites}}</td>
      <td>{{$item->fuentesA}}</td>
      <td>{{$item->fuentesC}}</td>
      {{-- <td>{{$item->pilas}}</td> --}}
        
    </tr> 
    @php
     $sumBiod = $sumBiod + $item->biodegradable;
     $sumReci = $sumReci + $item->reciclables; 
     $sumOrd =  $sumOrd + $item->ordinarios;
     $sumBios = $sumBios + $item->biosanitarios; 
     $sumAna =  $sumAna + $item->anatomopatologicos; 
     $sumCorto = $sumCorto + $item->cortopunzantes; 
     $sumAni = $sumAni + $item->animales; 
     $sumCorr = $sumCorr + $item->farmacos; 
     $sumToxi = $sumToxi + $item->citoxicos; 
     $sumInfla = $sumInfla + $item->metales;
     $sumExplo = $sumExplo + $item->reactivos;
     $sumRea = $sumRea + $item->contenedores; 
     $sumRAEES = $sumRAEES + $item->aceites;
     $sumLumi = $sumLumi + $item->fuentesA;
     $sumPilas = $sumPilas + $item->fuentesC; 
      // $sumToner = $sumToner + $item->pilas;
    
    @endphp
    @endforeach  
    <tr>
      <td><b>Total</b></td>
      <td><b>{{$sumBiod}}</b></td>
      <td><b>{{$sumReci}}</b></td>
      <td><b>{{$sumOrd}}</b></td>
      <td><b>{{$sumBios}}</b></td>
      <td><b>{{$sumAna}}</b></td>
      <td><b>{{$sumCorto}}</b></td>
      <td><b>{{$sumAni}}</b></td>
      <td><b>{{$sumCorr}}</b></td>
      <td><b>{{$sumToxi}}</b></td>
      <td><b>{{$sumInfla}}</b></td>
      <td><b>{{$sumExplo}}</b></td>
      <td><b>{{$sumRea}}</b></td>
      <td><b>{{$sumRAEES}}</b></td>
      <td><b>{{$sumLumi}}</b></td>
      <td><b>{{$sumPilas}}</b></td>
      {{-- <td><b>{{$sumToner}}</b></td> --}}
      
  </tr>                        
                                    
</table>