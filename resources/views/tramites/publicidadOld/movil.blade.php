<div id="vehiculos">
   <div class="col-md-12">
   <label for="agregar_vehiculo pb-3">Agregar vehículo <button type="button" class="btn btn-round btn-sm btn-middle" style="padding:5px!important;"
         onclick="openModal()">Anexar</button></label>
      <div class="table-simple-headblue-govco">
      <table class="table display table-responsive-sm table-responsive-md" style="width:100%" id="tablaVehiculo">
         <thead>
            <tr>
               <th>Tipo de Boleteria</th>
               <th>Valor</th>
               <th>N° de boletas Impresas</th>
               <th>Acción</th>

            </tr>
         </thead>
         <tbody>

         </tbody>
      </table>
      </div>
   </div>
</div>

{{-- <div class="col-md-4 form-group">
   <label for="alto_vehiculo" class="form-label">Alto de la publicidad en vehículo<code>*</code>
   </label>
   <input type="number" value="{{ old('alto_vehiculo') }}" class="form-control  @error('alto_vehiculo') is-invalid @enderror" name="alto_vehiculo" id="alto_vehiculo" required>

   @error('alto_vehiculo')
   <span class="invalid-feedback" role="alert">
      <strong class="text-danger">{{ $message }}</strong>
   </span>
   @enderror
</div>

<div class="col-md-4 form-group">
   <label for="ancho_vehiculo" class="form-label">Ancho de la publicidad en vehículo <code>*</code>
   </label>
   <input type="number" value="{{ old('ancho_vehiculo') }}" class="form-control  @error('ancho_vehiculo') is-invalid @enderror" name="ancho_vehiculo" id="ancho_vehiculo" required>

   @error('ancho_vehiculo')
   <span class="invalid-feedback" role="alert">
      <strong class="text-danger">{{ $message }}</strong>
   </span>
   @enderror
</div>

<div class="col-md-12 form-group">
   <label for="observacion_vehiculo" class="form-label">Observacion de la publicidad del vehículo</label>
   <textarea name="observacion_vehiculo" class="form-control" rows="5" placeholder="Digita las observaciones" id="observacion_vehiculo" maxlength="300"></textarea>

   @error('observacion_vehiculo')
   <span class="invalid-feedback" role="alert">
      <strong class="text-danger">{{ $message }}</strong>
   </span>
   @enderror
</div>

<div class="col-md-4 form-group">
   <label for="tipo_vehiculo" class="form-label">Tipo de vehículo <code>*</code>
   </label>
   <input type="number" value="{{ old('tipo_vehiculo') }}" class="form-control  @error('tipo_vehiculo') is-invalid @enderror" name="tipo_vehiculo" id="tipo_vehiculo" required>

   @error('tipo_vehiculo')
   <span class="invalid-feedback" role="alert">
      <strong class="text-danger">{{ $message }}</strong>
   </span>
   @enderror
</div>

<div class="col-md-4 form-group">
   <label for="placa_vehiculo" class="form-label">Placas del vehículo <code>*</code>
   </label>
   <input type="number" value="{{ old('placa_vehiculo') }}" class="form-control  @error('placa_vehiculo') is-invalid @enderror" name="placa_vehiculo" id="placa_vehiculo" required>

   @error('placa_vehiculo')
   <span class="invalid-feedback" role="alert">
      <strong class="text-danger">{{ $message }}</strong>
   </span>
   @enderror
</div> --}}


<div class="col-md-4">
   <label for="fecha_inicial_fijacion" class="form-label">Fecha de fijación de la publicidad
      <code>*</code> </label>
   <input type="date" value="{{ old('fecha_inicial_fijacion') }}" class="form-control  @error('fecha_inicial_fijacion') is-invalid @enderror" name="fecha_inicial_fijacion" id="fecha_inicial_fijacion" required>

   @error('fecha_inicial_fijacion')
   <span class="invalid-feedback" role="alert">
      <strong class="text-danger">{{ $message }}</strong>
   </span>
   @enderror
</div>

<div class="col-md-4">
   <label for="fecha_final_fijacion" class="form-label">Fecha de retiro de la publicidad
      <code>*</code> </label>
   <input type="date" value="{{ old('fecha_final_fijacion') }}" class="form-control  @error('fecha_final_fijacion') is-invalid @enderror" name="fecha_final_fijacion" id="fecha_final_fijacion" required>

   @error('fecha_final_fijacion')
   <span class="invalid-feedback" role="alert">
      <strong class="text-danger">{{ $message }}</strong>
   </span>
   @enderror
</div>