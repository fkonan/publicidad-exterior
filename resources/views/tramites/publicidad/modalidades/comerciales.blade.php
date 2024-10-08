{{-- Fomulario para comerciales --}}
<div class="row">
   <div class="col-md-12 form-group">
      <label for="comerciales_direccion_elemento1" class="form-label">Dirección de ubicación del elemento
         publicitario<code>*</code></label>
      <input type="text" class="form-control  @error('comerciales_direccion_elemento1') is-invalid @enderror"
         name="comerciales_direccion_elemento1" id="comerciales_direccion_elemento1" maxlength="120" required>

      @error('comerciales_direccion_elemento1')
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

<div class="row mb-3">
   <div class="col-md-3">
      <label for="comerciales_esquinero" class="form-label">El local es esquinero?</label>
      <select class="form-control" name="comerciales_esquinero" id="comerciales_esquinero" required>
         <option value="NO" selected>NO</option>
         <option value="SI">SI</option>
      </select>
   </div>

   <div class="col-md-3">
      <label for="comerciales_numero_elementos" class="form-label">Número de elementos<code>*</code></label>
      <input type="number" class="form-control" name="comerciales_numero_elementos" id="comerciales_numero_elementos"
         value="1" readOnly required>
   </div>
</div>

<div class="row mb-3">
      <div class="col-md-4">
      <label for="comerciales_alto_elemento1" class="form-label">Alto del elemento(mts)<code>*</code></label>
      <input type="number" class="form-control  @error('comerciales_alto_elemento1') is-invalid @enderror"
         name="comerciales_alto_elemento1" id="comerciales_alto_elemento1" required>

      @error('comerciales_alto_elemento1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="comerciales_ancho_elemento1" class="form-label">Ancho del elemento(mts)<code>*</code>
      </label>
      <input type="number" value="{{ old('comerciales_ancho_elemento1') }}"
         class="form-control  @error('comerciales_ancho_elemento1') is-invalid @enderror"
         name="comerciales_ancho_elemento1" id="comerciales_ancho_elemento1" required>

      @error('comerciales_ancho_elemento1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="comerciales_area_total_elemento1" class="form-label">Area total del elemento</label>
      <input type="number" class="form-control" name="comerciales_area_total_elemento1"
         id="comerciales_area_total_elemento1" readonly required>
   </div>
</div>

<div class="row mb-3">
   <div class="col-md-4">
      <label for="comerciales_alto_fachada1" class="form-label">Alto de la fachada(mts)<code>*</code></label>
      <input type="number" class="form-control  @error('comerciales_alto_fachada1') is-invalid @enderror"
         name="comerciales_alto_fachada1" id="comerciales_alto_fachada1" required>

      @error('comerciales_alto_fachada1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="comerciales_ancho_fachada1" class="form-label">Ancho de la fachada(mts)<code>*</code>
      </label>
      <input type="number" value="{{ old('comerciales_ancho_fachada1') }}"
         class="form-control  @error('comerciales_ancho_fachada1') is-invalid @enderror"
         name="comerciales_ancho_fachada1" id="comerciales_ancho_fachada1" required>

      @error('comerciales_ancho_fachada1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="comerciales_area_total_fachada1" class="form-label">Area total de la fachada</label>
      <input type="number" class="form-control" name="comerciales_area_total_fachada1"
         id="comerciales_area_total_fachada1" readonly required>
   </div>
</div>

<div class="row mb-3 d-none border-top" id="divElemento2">
   <div class="col-md-4">
      <label for="comerciales_alto_elemento2" class="form-label">Alto del elemento 2(mts)<code>*</code></label>
      <input type="number" class="form-control  @error('comerciales_alto_elemento2') is-invalid @enderror"
         name="comerciales_alto_elemento2" id="comerciales_alto_elemento2">

      @error('comerciales_alto_elemento2')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="comerciales_ancho_elemento2" class="form-label">Ancho del elemento 2(mts)<code>*</code>
      </label>
      <input type="number" value="{{ old('comerciales_ancho_elemento2') }}"
         class="form-control  @error('comerciales_ancho_elemento2') is-invalid @enderror"
         name="comerciales_ancho_elemento2" id="comerciales_ancho_elemento2">

      @error('comerciales_ancho_elemento2')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="comerciales_area_total_elemento2" class="form-label">Area total del elemento 2</label>
      <input type="number" class="form-control" name="comerciales_area_total_elemento2"
         id="comerciales_area_total_elemento2" readonly>
   </div>
</div>



<div class="row mb-3 d-none" id="divFachada2">
   <div class="col-md-4">
      <label for="comerciales_alto_fachada2" class="form-label">Alto de la fachada 2(mts)<code>*</code></label>
      <input type="number" class="form-control  @error('comerciales_alto_fachada2') is-invalid @enderror"
         name="comerciales_alto_fachada2" id="comerciales_alto_fachada2">

      @error('comerciales_alto_fachada2')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="comerciales_ancho_fachada2" class="form-label">Ancho de la fachada 2(mts)<code>*</code>
      </label>
      <input type="number" value="{{ old('comerciales_ancho_fachada2') }}"
         class="form-control  @error('comerciales_ancho_fachada2') is-invalid @enderror"
         name="comerciales_ancho_fachada2" id="comerciales_ancho_fachada2">

      @error('comerciales_ancho_fachada2')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="comerciales_area_total_fachada2" class="form-label">Area total fachada 2</label>
      <input type="number" class="form-control" name="comerciales_area_total_fachada2"
         id="comerciales_area_total_fachada2" readonly>
   </div>
</div>

