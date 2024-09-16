
<div class="col-md-12 form-group">
   <label for="sub_modalidad" class="form-label">Submodalidad <code>*</code> </label>
   <select class="form-control  @error('sub_modalidad') is-invalid @enderror" name="sub_modalidad" id="sub_modalidad" required>
      <option value="">Seleccione</option>
      <option value="AVISOS DE IDENTIFICACION DE PROYECTOS INMOBILIARIOS" {{ old('sub_modalidad') == 'AVISOS DE IDENTIFICACION DE PROYECTOS INMOBILIARIOS' ? 'selected' : '' }}>AVISOS DE IDENTIFICACION DE PROYECTOS INMOBILIARIOS</option>
      <option value="AVISOS TIPO COLOMBINA" {{ old('sub_modalidad') == 'AVISOS TIPO COLOMBINA' ? 'selected' : '' }}>AVISOS TIPO COLOMBINA</option>
      <option value="AVISOS DE IDENTIFICACION DE ESTABLECIMIENTOS" {{ old('sub_modalidad') == 'AVISOS DE IDENTIFICACION DE ESTABLECIMIENTOS' ? 'selected' : '' }}>AVISOS DE IDENTIFICACION DE ESTABLECIMIENTOS</option>
   </select>

   @error('sub_modalidad')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
   @enderror
</div>

<div class="col-md-6 form-group">
   <label for="propiedad_privada" class="form-label">Se encuentra en propiedad privada? <code>*</code> </label>
   <select class="form-control  @error('propiedad_privada') is-invalid @enderror" name="propiedad_privada" id="propiedad_privada" required>
      <option value="">Seleccione</option>
      <option value="SI" {{ old('propiedad_privada') == 'SI' ? 'selected' : '' }}>SI</option>
      <option value="NO" {{ old('propiedad_privada') == 'NO' ? 'selected' : '' }}>NO</option>
   </select>

   @error('propiedad_privada')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
   @enderror
</div>

<div class="col-md-6">
   <label for="inferior_treintaDias" class="form-label">Publicidad inferior a 30 dias? <code>*</code></label>
   <select class="form-control  @error('inferior_treintaDias') is-invalid @enderror" name="inferior_treintaDias" id="inferior_treintaDias" required>
      <option value="">Seleccione</option>
      <option value="SI" {{ old('inferior_treintaDias') == 'SI' ? 'selected' : '' }}>SI</option>
      <option value="NO" {{ old('inferior_treintaDias') == 'NO' ? 'selected' : '' }}>NO</option>
   </select>

   @error('inferior_treintaDias')
      <span class="invalid-feedback" role="alert">
         <strong class="text-danger">{{ $message }}</strong>
      </span>
   @enderror
</div>

<div class="col-md-6">
   <label for="fecha_inicial_fijacion" class="form-label">Fecha de fijación de la publicidad
      <code>*</code> </label>
   <input type="date" value="{{ old('fecha_inicial_fijacion') }}" class="form-control  @error('fecha_inicial_fijacion') is-invalid @enderror" name="fecha_inicial_fijacion" id="fecha_inicial_fijacion" required>

   @error('fecha_inicial_fijacion')
   <span class="invalid-feedback" role="alert">
      <strong class="text-danger">{{ $message }}</strong>
   </span>
   @enderror
</div>

<div class="col-md-6 form-group">
   <label for="fecha_final_fijacion" class="form-label">Fecha de retiro de la publicidad
      <code>*</code> </label>
   <input type="date" value="{{ old('fecha_final_fijacion') }}" class="form-control  @error('fecha_final_fijacion') is-invalid @enderror" name="fecha_final_fijacion" id="fecha_final_fijacion" required>

   @error('fecha_final_fijacion')
   <span class="invalid-feedback" role="alert">
      <strong class="text-danger">{{ $message }}</strong>
   </span>
   @enderror
</div>

<div class="col-md-6 divInmobiliarios d-none">
   <label for="alto_fachada" class="form-label">Alto de la fachada <code>*</code>
   </label>
   <input type="number" value="{{ old('alto_fachada') }}" class="form-control  @error('alto_fachada') is-invalid @enderror" name="alto_fachada" id="alto_fachada" required>

   @error('alto_fachada')
   <span class="invalid-feedback" role="alert">
      <strong class="text-danger">{{ $message }}</strong>
   </span>
   @enderror
</div>

<div class="col-md-6 divInmobiliarios d-none">
   <label for="ancho_fachada" class="form-label">Ancho de la fachada <code>*</code>
   </label>
   <input type="number" value="{{ old('ancho_fachada') }}" class="form-control  @error('ancho_fachada') is-invalid @enderror" name="ancho_fachada" id="ancho_fachada" required>

   @error('ancho_fachada')
   <span class="invalid-feedback" role="alert">
      <strong class="text-danger">{{ $message }}</strong>
   </span>
   @enderror
</div>