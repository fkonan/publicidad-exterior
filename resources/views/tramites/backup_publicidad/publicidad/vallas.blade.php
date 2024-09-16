
<div class="col md-4 form-group">
   <label for="tipo_valla" class="form-label">Tipo de valla <code>*</code> </label>
   <select class="form-control  @error('tipo_valla') is-invalid @enderror" name="tipo_valla" id="tipo_valla" required>
      <option value="">Seleccione</option>
      <option value="CONVENCIONAL" {{ old('tipo_valla') == 'CONVENCIONAL' ? 'selected' : '' }}>CONVENCIONAL</option>
      <option value="TUBULAR" {{ old('tipo_valla') == 'TUBULAR' ? 'selected' : '' }}>TUBULAR</option>
   </select>

   @error('tipo_valla')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
   @enderror
</div>

<div class="col-md-4">
   <label for="numero_caras" class="form-label">Número de caras <code>*</code>
   </label>
   <input type="number" value="{{ old('numero_caras') }}" class="form-control  @error('numero_caras') is-invalid @enderror" name="numero_caras" id="numero_caras" required>

   @error('numero_caras')
   <span class="invalid-feedback" role="alert">
      <strong class="text-danger">{{ $message }}</strong>
   </span>
   @enderror
</div>

<div class="col-md-4">
   <label for="fecha_inicial_fijacion" class="form-label">Fecha inicial de fijación
      <code>*</code> </label>
   <input type="date" value="{{ old('fecha_inicial_fijacion') }}" class="form-control  @error('fecha_inicial_fijacion') is-invalid @enderror" name="fecha_inicial_fijacion" id="fecha_inicial_fijacion" required>

   @error('fecha_inicial_fijacion')
   <span class="invalid-feedback" role="alert">
      <strong class="text-danger">{{ $message }}</strong>
   </span>
   @enderror
</div>

<div class="col-md-4">
   <label for="fecha_final_fijacion" class="form-label">Fecha final de fijación
      <code>*</code> </label>
   <input type="date" value="{{ old('fecha_final_fijacion') }}" class="form-control  @error('fecha_final_fijacion') is-invalid @enderror" name="fecha_final_fijacion" id="fecha_final_fijacion" required>

   @error('fecha_final_fijacion')
   <span class="invalid-feedback" role="alert">
      <strong class="text-danger">{{ $message }}</strong>
   </span>
   @enderror
</div>