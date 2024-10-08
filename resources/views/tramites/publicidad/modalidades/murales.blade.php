{{-- Fomulario para vallas --}}
<div class="row">
   <div class="col-md-12 form-group">
      <label for="murales_direccion_elemento1" class="form-label">Dirección de ubicación del elemento
         publicitario<code>*</code></label>
      <input type="text" class="form-control  @error('murales_direccion_elemento1') is-invalid @enderror" name="murales_direccion_elemento1"
         id="murales_direccion_elemento1" maxlength="120" required>

      @error('murales_direccion_elemento1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>
</div>

<div class="row mb-3">
   <div class="col-md-4">
      <label for="murales_alto_elemento1" class="form-label">Alto del elemento(mts)<code>*</code></label>
      <input type="number" class="form-control  @error('murales_alto_elemento1') is-invalid @enderror"
         name="murales_alto_elemento1" id="murales_alto_elemento1" required>

      @error('murales_alto_elemento1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="murales_ancho_elemento1" class="form-label">Ancho del elemento(mts)<code>*</code>
      </label>
      <input type="number" value="{{ old('murales_ancho_elemento1') }}"
         class="form-control  @error('murales_ancho_elemento1') is-invalid @enderror" name="murales_ancho_elemento1"
         id="murales_ancho_elemento1" required>

      @error('murales_ancho_elemento1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-2">
      <label for="murales_area_total_elemento1" class="form-label">Area total</label>
      <input type="number" class="form-control" name="murales_area_total_elemento1" id="murales_area_total_elemento1"
         readonly required>
   </div>
</div>
