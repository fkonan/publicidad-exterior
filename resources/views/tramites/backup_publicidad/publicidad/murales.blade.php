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