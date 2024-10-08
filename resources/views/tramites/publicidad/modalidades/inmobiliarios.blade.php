{{-- Fomulario para inmobiliarios --}}
<div class="row">
   <div class="col-md-12 form-group">
      <label for="inmobiliarios_direccion_elemento1" class="form-label">Dirección de ubicación del elemento
         publicitario<code>*</code></label>
      <input type="text" class="form-control  @error('inmobiliarios_direccion_elemento1') is-invalid @enderror"
         name="inmobiliarios_direccion_elemento1" id="inmobiliarios_direccion_elemento1" maxlength="120" required>

      @error('inmobiliarios_direccion_elemento1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>
</div>

<div class="row">
   <div class="col-md-12">
      <p><b>Por favor consulte la norma:</b> Artículo 13 literal C y D del <a
            href="https://www.bucaramanga.gov.co/wp-content/uploads/2023/08/Acuerdo_026_2018.pdf"
            target="_blank">Acuerdo 026 del 2018</a>, que regula el tamaño de los avisos.</p>
   </div>
</div>

<div class="row">
   <div class="col-md-12 form-group">
      <label for="inmobiliarios_descripcion1" class="form-label">Descripción del elemento<code>*</code></label>
      <input type="text" class="form-control  @error('inmobiliarios_descripcion1') is-invalid @enderror"
         name="inmobiliarios_descripcion1" id="inmobiliarios_descripcion1" maxlength="120" required>

      @error('inmobiliarios_descripcion1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>
</div>

<div class="row mb-3">
   <div class="col-md-3">
      <label for="inmobiliarios_numero_elementos" class="form-label">Número de elementos<code>*</code></label>
      <input type="number" class="form-control" name="inmobiliarios_numero_elementos"
         id="inmobiliarios_numero_elementos" value="1" readOnly required>
   </div>

   <div class="col-md-3">
      <label for="inmobiliarios_alto_elemento1" class="form-label">Alto del elemento(mts)<code>*</code></label>
      <input type="number" class="form-control  @error('inmobiliarios_alto_elemento1') is-invalid @enderror"
         name="inmobiliarios_alto_elemento1" id="inmobiliarios_alto_elemento1" required>

      @error('inmobiliarios_alto_elemento1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-3">
      <label for="inmobiliarios_ancho_elemento1" class="form-label">Ancho del elemento(mts)<code>*</code>
      </label>
      <input type="number" value="{{ old('inmobiliarios_ancho_elemento1') }}"
         class="form-control  @error('inmobiliarios_ancho_elemento1') is-invalid @enderror"
         name="inmobiliarios_ancho_elemento1" id="inmobiliarios_ancho_elemento1" required>

      @error('inmobiliarios_ancho_elemento1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-3">
      <label for="inmobiliarios_area_total_elemento1" class="form-label">Area total del elemento</label>
      <input type="number" class="form-control" name="inmobiliarios_area_total_elemento1"
         id="inmobiliarios_area_total_elemento1" readonly required>
   </div>
</div>
