{{-- Fomulario para colombina --}}
<div class="row">
   <div class="col-md-12 form-group">
      <label for="colombina_direccion_elemento1" class="form-label">Dirección de ubicación del elemento
         publicitario<code>*</code></label>
      <input type="text" class="form-control  @error('colombina_direccion_elemento1') is-invalid @enderror"
         name="colombina_direccion_elemento1" id="colombina_direccion_elemento1" maxlength="120" required>

      @error('colombina_direccion_elemento1')
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
      <label for="colombina_esquinero" class="form-label">El local es esquinero?</label>
      <select class="form-control" name="colombina_esquinero" id="colombina_esquinero" required>
         <option value="NO" selected>NO</option>
         <option value="SI">SI</option>
      </select>
   </div>

   <div class="col-md-3">
      <label for="colombina_numero_elementos" class="form-label">Número de elementos<code>*</code></label>
      <input type="number" class="form-control" name="colombina_numero_elementos" id="colombina_numero_elementos"
         value="1" readOnly required>
   </div>
</div>

<div class="row mb-3">
   <div class="col-md-12 form-group">
      <label for="colombina_descripcion1" class="form-label">Descripción del elemento 1<code>*</code></label>
      <input type="text" class="form-control  @error('colombina_descripcion1') is-invalid @enderror"
         name="colombina_descripcion1" id="colombina_descripcion1" maxlength="120" required>

      @error('colombina_descripcion1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="colombina_alto_elemento1" class="form-label">Alto del elemento(mts)<code>*</code></label>
      <input type="number" class="form-control  @error('colombina_alto_elemento1') is-invalid @enderror"
         name="colombina_alto_elemento1" id="colombina_alto_elemento1" required>

      @error('colombina_alto_elemento1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="colombina_ancho_elemento1" class="form-label">Ancho del elemento(mts)<code>*</code>
      </label>
      <input type="number" value="{{ old('colombina_ancho_elemento1') }}"
         class="form-control  @error('colombina_ancho_elemento1') is-invalid @enderror"
         name="colombina_ancho_elemento1" id="colombina_ancho_elemento1" required>

      @error('colombina_ancho_elemento1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-2">
      <label for="colombina_numero_caras1" class="form-label"># de caras<code>*</code>
      </label>
      <input type="number" value="{{ old('colombina_numero_caras1') }}"
         class="form-control  @error('colombina_numero_caras1') is-invalid @enderror" name="colombina_numero_caras1"
         id="colombina_numero_caras1" required>

      @error('colombina_numero_caras1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-2">
      <label for="colombina_area_total_elemento1" class="form-label">Area total</label>
      <input type="number" class="form-control" name="colombina_area_total_elemento1"
         id="colombina_area_total_elemento1" readonly required>
   </div>
</div>

<div class="row mb-3">
   <div class="col-md-4">
      <label for="colombina_alto_fachada1" class="form-label">Alto de la fachada(mts)<code>*</code></label>
      <input type="number" class="form-control  @error('colombina_alto_fachada1') is-invalid @enderror"
         name="colombina_alto_fachada1" id="colombina_alto_fachada1" required>

      @error('colombina_alto_fachada1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="colombina_ancho_fachada1" class="form-label">Ancho de la fachada(mts)<code>*</code>
      </label>
      <input type="number" value="{{ old('colombina_ancho_fachada1') }}"
         class="form-control  @error('colombina_ancho_fachada1') is-invalid @enderror"
         name="colombina_ancho_fachada1" id="colombina_ancho_fachada1" required>

      @error('colombina_ancho_fachada1')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="colombina_area_total_fachada1" class="form-label">Area total de la fachada</label>
      <input type="number" class="form-control" name="colombina_area_total_fachada1"
         id="colombina_area_total_fachada1" readonly required>
   </div>
</div>

<div class="row mb-3 d-none border-top" id="divElemento2">
   <div class="col-md-12 form-group">
      <label for="colombina_descripcion2" class="form-label">Descripción del elemento 2<code>*</code></label>
      <input type="text" class="form-control  @error('colombina_descripcion2') is-invalid @enderror"
         name="colombina_descripcion2" id="colombina_descripcion2" maxlength="120" required>

      @error('colombina_descripcion2')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="colombina_alto_elemento2" class="form-label">Alto del elemento 2(mts)<code>*</code></label>
      <input type="number" class="form-control  @error('colombina_alto_elemento2') is-invalid @enderror"
         name="colombina_alto_elemento2" id="colombina_alto_elemento2" required>

      @error('colombina_alto_elemento2')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="colombina_ancho_elemento2" class="form-label">Ancho del elemento 2(mts)<code>*</code>
      </label>
      <input type="number" value="{{ old('colombina_ancho_elemento2') }}"
         class="form-control  @error('colombina_ancho_elemento2') is-invalid @enderror"
         name="colombina_ancho_elemento2" id="colombina_ancho_elemento2" required>

      @error('colombina_ancho_elemento2')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-2">
      <label for="colombina_numero_caras2" class="form-label"># de caras<code>*</code>
      </label>
      <input type="number" value="{{ old('colombina_numero_caras2') }}"
         class="form-control  @error('colombina_numero_caras2') is-invalid @enderror" name="colombina_numero_caras2"
         id="colombina_numero_caras2" required>

      @error('colombina_numero_caras2')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-2">
      <label for="colombina_area_total_elemento2" class="form-label">Area total 2</label>
      <input type="number" class="form-control" name="colombina_area_total_elemento2"
         id="colombina_area_total_elemento2" readonly required>
   </div>
</div>



<div class="row mb-3 d-none" id="divFachada2">
   <div class="col-md-4">
      <label for="colombina_alto_fachada2" class="form-label">Alto de la fachada 2(mts)<code>*</code></label>
      <input type="number" class="form-control  @error('colombina_alto_fachada2') is-invalid @enderror"
         name="colombina_alto_fachada2" id="colombina_alto_fachada2" required>

      @error('colombina_alto_fachada2')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="colombina_ancho_fachada2" class="form-label">Ancho de la fachada 2(mts)<code>*</code>
      </label>
      <input type="number" value="{{ old('colombina_ancho_fachada2') }}"
         class="form-control  @error('colombina_ancho_fachada2') is-invalid @enderror"
         name="colombina_ancho_fachada2" id="colombina_ancho_fachada2" required>

      @error('colombina_ancho_fachada2')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
      @enderror
   </div>

   <div class="col-md-4">
      <label for="colombina_area_total_fachada2" class="form-label">Area total fachada 2</label>
      <input type="number" class="form-control" name="colombina_area_total_fachada2"
         id="colombina_area_total_fachada2" readonly required>
   </div>
</div>
