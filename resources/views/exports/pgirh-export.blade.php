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
   <th colspan="10" style="text-align:center; font-size:14px; background-color:#6FF473;"><b>REPORTE FORMULARIO RH1</b></th>
   <th colspan="3" style="text-align:center; font-size:12px;"><b>RESIDUOS NO PELIGROSOS</b></th>
   <th colspan="12" style="text-align:center; font-size:12px;"><b></b>RESIDUOS PELIGROSOS</th>
    </tr>    
    <tr>
      <th style="font-size: 9px; font-weight: bold; font-size: 12px;">NOMBRE ESTABLECIMIENTO POR SEDE</th>
      <th style="font-size: 9px; font-weight: bold; font-size: 12px;">ACTIVIDAD COMERCIAL</th>
      <th style="font-size: 9px; font-weight: bold; font-size: 12px;">NIT</th>
      <th style="font-size: 9px; font-weight: bold; font-size: 12px;">DIRECCION</th>
      <th style="font-size: 9px; font-weight: bold; font-size: 12px;">TELEFONO</th>
      <th style="font-size: 9px; font-weight: bold; font-size: 12px;">CORREO ELECTRONICO</th>
      <th style="font-size: 9px; font-weight: bold; font-size: 12px;">MUNICIPIO</th>
      <th style="font-size: 9px; font-weight: bold; font-size: 12px;">GESTOR DE RESIDUOS</th>
      <th style="font-size: 9px; font-weight: bold; font-size: 12px;">RESPONSABLE DEL DILIGENCIAMIENTO/CARGO</th>
      <th style="font-size: 9px; font-weight: bold; font-size: 12px;">AÑO REPORTADO / SEMESTRE</th>
      <th style="font-size: 9px; font-weight: bold; font-size: 12px;">FECHA DEL REPORTE</th>
      <th style="font-size: 9px; background-color: #00B050;">Orgánicos aprovechables<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #fff;">Aprovechables<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #000000; color:#ffffff">No aprovechables<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #FF0000;color:#000">Biosanitarios<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #FF0000;color:#000">Anatomopatologicos<br>  (Kg)</th>
      <th style="font-size: 9px; background-color: #FF0000;color:#000">Cortopunzantes<br>  (Kg)</th>
      <th style="font-size: 9px; background-color: #FF0000;color:#000">Animales<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #F07662;color:#000">Farmacos<br> (Kg)</th >
      <th style="font-size: 9px; background-color: #F07662;color:#000">Citóxicos<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #F07662;color:#000">Metales Pesados<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #F07662;color:#000">Reactivos <br> (Kg)</th>
      <th style="font-size: 9px; background-color: #F07662;color:#000">Contenedores Presurizados<br> (Kg)</th>
      <th style="font-size: 9px; background-color: #F07662;color:#000;">Aceites Usados <br>(Kg)</th>
      <th style="font-size: 9px; background-color: #C60B06;color:#000;">Fuentes Abiertas <br></th>
      <th style="font-size: 9px; background-color: #C60B06;color:#000;">Fuentes Cerradas <br></th>
      {{-- <th style="font-size: 9px; background-color: #FF0000;color:#000;">Pilas<br>(Kg)</th> --}}
    </tr>                                  
   @foreach ($data as $item)
    <tr>
      <td>{{$item->razon_social}} - @if($item->nombre_sede){{$item->nombre_sede}} @endif</td>
      <td>@if($item->descripcion == $item->detalle)
        {{$item->descripcion}}
        @else
        {{$item->descripcion}} - {{$item->detalle}}
        @endif
      
      </td>
      <td>{{$item->nit}}</td>
      <td>{{($item->direccion) ? $item->direccion : $item->direccion_empresa}}</td>
      <td>{{$item->telefono}}</td>
      <td>{{$item->correo_electronico}}</td>
      <td>BUCARAMANGA</td>
      <td>{{$item->gestor_residuos}}</td>
      <td>{{$item->nombre_solicitante}}</td>
      <td>{{$item->year}}/{{$item->semestre}}</td>
      <td>{{$item->created_at}}</td>
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
        
    </tr> 
 
    
 
    @endforeach  
                         
                                    
</table>