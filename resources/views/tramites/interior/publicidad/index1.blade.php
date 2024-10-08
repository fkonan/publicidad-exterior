@extends('layouts.menu')

@section('dashboard')

<div class="container">
   <div class="row mb-4">
      <div class="px-0 col-md-9">
         <nav aria-label="Miga de pan" style="max-height: 20px;">
            <ol class="breadcrumb" style="background-color: #FFFFFF;">
               <li class="breadcrumb-item ml-3 ml-md-0">
                  <a style="color: #004fbf;" class="breadcrumb-text" href="https://www.gov.co/home/">Inicio</a>
               </li>
               <li class="breadcrumb-item ">
                  <div class="image-icon">
                     <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                     <a style="color: #004fbf;" class="breadcrumb-text" href="#">Tramites en Linea</a>
                  </div>
               </li>
               <li class="breadcrumb-item ">
                  <div class="image-icon">
                     <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                     <a style="color: #004fbf;" class="breadcrumb-text" href="#">Interior</a>
                  </div>
               </li>
               <li class="breadcrumb-item ">
                  <div class="image-icon">
                     <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                     <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                           Publicidad Exterior.
                        </b></p>
                  </div>
               </li>
            </ol>
         </nav>
      </div>
   </div>

   <div class="row">
      <h2>Listado de solicitudes radicadas</h2>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm" id="table">
               <thead>
                  <tr>
                     <th>Radicado</th>
                     <th>Tipo de persona</th>
                     <th>Documento solictante</th>
                     <th>Solicitante</th>
                     <th>Tipo de publicidad</th>
                     <th>Fecha de vencimiento</th>
                     <th>Estado de la solicitud</th>
                     <th>Novedad</th>
                     <th>Acciones</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($solicitudes as $solicitud)
                  <tr>
                     <td>{{ $solicitud->radicado }}</td>
                     <td>{{ $solicitud->PersonaTip }}</td>
                     <td>{{ $solicitud->PersonaDoc }}</td>
                     <td>{{ $solicitud->PersonaTip=='Natural'?$solicitud->PersonaNombre . " " .$solicitud->PersonaApe:$solicitud->PersonaRazon }}</td>
                     <td>{{ $solicitud->tipo_publicidad }}</td>
                     <td>{{ $solicitud->fecha_vencimiento }}</td>
                     <td>{{ $solicitud->estado_solicitud }}</td>
                     <td>{{ $solicitud->novedad }}</td>
                     <td>
                        <a href="{{ route('interior.publicidad.detalle', $solicitud->id) }}" class="btn btn-primary">Ver</a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection
@push('custom-scripts')
<script>
   $('#table').bootstrapTable({});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/bootstrap-table.min.js"></script>
@endpush
