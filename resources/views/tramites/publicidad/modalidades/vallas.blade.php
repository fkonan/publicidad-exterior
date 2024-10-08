{{-- Fomulario para vallas --}}
<div class="row">
   <div class="col-md-12 form-group">
      <label for="vallas_direccion_elemento1" class="form-label">Dirección de ubicación del elemento
         publicitario<code>*</code></label>
      <input type="text" class="form-control  @error('vallas_direccion_elemento1') is-invalid @enderror" name="vallas_direccion_elemento1"
         id="vallas_direccion_elemento1" maxlength="120" required>

      @error('vallas_direccion_elemento1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>
</div>

<div class="row mb-3">
   <div class="col-md-6">
      <label for="vallas_tipo_valla" class="form-label">Tipo de valla<code>*</code></label>
      <select class="form-control  @error('vallas_tipo_valla') is-invalid @enderror" name="vallas_tipo_valla" id="vallas_tipo_valla">
         <option value="">Seleccione</option>
         <option value="CONVENCIONAL">CONVENCIONAL</option>
         <option value="TUBULAR">TUBULAR</option>
      </select>

      @error('vallas_tipo_valla')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>
   <div class="col-md-4">
         <label for="vallas_numero_elementos" class="form-label">Número de elementos<code>*</code></label>
         <input type="number" class="form-control" name="vallas_numero_elementos" id="vallas_numero_elementos" value="1"
            readOnly required>
      </div>
</div>


<div class="row mb-3">
   <div class="col-md-4">
      <label for="vallas_alto_elemento1" class="form-label">Alto del elemento(mts)<code>*</code></label>
      <input type="number" class="form-control  @error('vallas_alto_elemento1') is-invalid @enderror"
         name="vallas_alto_elemento1" id="vallas_alto_elemento1" required>

      @error('vallas_alto_elemento1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="vallas_ancho_elemento1" class="form-label">Ancho del elemento(mts)<code>*</code>
      </label>
      <input type="number" value="{{ old('vallas_ancho_elemento1') }}"
         class="form-control  @error('vallas_ancho_elemento1') is-invalid @enderror" name="vallas_ancho_elemento1"
         id="vallas_ancho_elemento1" required>

      @error('vallas_ancho_elemento1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-2">
      <label for="vallas_numero_caras1" class="form-label"># de caras<code>*</code>
      </label>
      <input type="number" value="{{ old('vallas_numero_caras1') }}"
         class="form-control  @error('vallas_numero_caras1') is-invalid @enderror" name="vallas_numero_caras1"
         id="vallas_numero_caras1" required>

      @error('vallas_numero_caras1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-2">
      <label for="vallas_area_total_elemento1" class="form-label">Area total</label>
      <input type="number" class="form-control" name="vallas_area_total_elemento1" id="vallas_area_total_elemento1"
         readonly required>
   </div>
</div>

