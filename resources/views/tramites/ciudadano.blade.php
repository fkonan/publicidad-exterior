<!-- datos Generales-->
{{-- @if ($errors->any())
<div class="alert alert-danger">
<ul>
	@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
</ul>
</div>
@endif --}}

<div class="row form-group mt-2" id = "datosPersona">
	<div class="col-md-12 pl-1 pr-1 pt-3">
		<h3 class="headline-l-govco mt-3 pl-0">1. Datos Generales de la Solicitud</h3>
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3">
		<label for="TipoPersona" class="form-label">Tipo de persona* </label>
		<select class="form-control  @error('tipo_persona') is-invalid @enderror"
			name="TipoPersona" id="TipoPersona" required onchange = "javascript: activarRep(this.value);">
			<option value="">Seleccione</option>
			<option value="Natural" @if($Datos->PersonaTipDoc!='NIT') {{"selected"}} @endif >Natural</option>
			<option value="Juridica" @if($Datos->PersonaTipDoc=='NIT') {{"selected"}} @endif >Juridica</option>
		</select>
		@error('tipo_persona')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3 Natural @if($Datos->PersonaTipDoc=='NIT') {{'d-none'}} @endif">
		<label for="nom_responsable" class="form-label">Nombres del contribuyente*
		</label>
		<input value="{{ $Datos->PersonaNombre }}" type="text"
			class="form-control name_validate  @error('nom_solicitante') is-invalid @enderror"
			name="nom_responsable" id="nom_responsable" maxlength="25" minlength="4"
			onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">
		@error('nom_responsable')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3 Natural @if($Datos->PersonaTipDoc=='NIT') {{'d-none'}} @endif">
		<label for="ape_responsable" class="form-label">Apellidos del contribuyente*</label>
		<input value="{{ $Datos->PersonaApe }}" type="text"
			class="form-control name_validate  @error('ape_responsable') is-invalid @enderror"
			name="ape_responsable" id="ape_responsable" maxlength="25" minlength="4"
			onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">
		@error('ape_responsable')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-12 pl-1 pr-1 pt-3 Juridica @if($Datos->PersonaTipDoc!='NIT') {{'d-none'}} @endif">
		<label for="razon_social" class="form-label">Razon Social y/o Responsable * </label>
		<input type="text" value="{{ $Datos->PersonaNombre }}"
			class="form-control   @error('razon_social') is-invalid @enderror "
			name="razon_social" id="razon_social" maxlength="100" minlength="4"
			onkeypress="return Observaciones(event)" onkeyup="aMayusculas(this.value,this.id)">
		@error('razon_social')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3">
		<label for="tipo_documento" class="form-label">Tipo de Documento * </label>
		<select class="form-control  @error('tipo_documento') is-invalid @enderror"
			name="tipo_documento" id="tipo_documento" >
			<option value="C.C" @if($Datos->PersonaTipDoc == "C.C"){{"selected"}} @endif>Cedula de Ciudadanía</option>
			<option value="C.E." @if($Datos->PersonaTipDoc == "C.E."){{"selected"}} @endif>Cedula de Extranjería</option>
			<option value="NIT" @if($Datos->PersonaTipDoc == "NIT"){{"selected"}} @endif>NIT</option>
		</select>
		@error('tipo_documento')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3">
		<label for="ide_responsable" class="form-label">Número de Identificación* </label>
		<input value="{{ $Datos->PersonaDoc }}" type="text"
			class="form-control number_validate  @error('ide_responsable') is-invalid @enderror"
			name="ide_responsable" id="ide_responsable" maxlength="15" minlength="4" required
			onkeypress="return Numeros(event)">
		@error('ide_responsable')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-12 pl-1 pt-3">
		<label for="dir_responsable_sol" class="form-label">Dirección o Nomenclatura  de notificación fisica*
		</label><button type="button" class="btn btn-link" onclick='javascript:campo="#dir_solicitante";'><span
				style="text-transform: lowercase; font-size: 12px;" class="text-primary"
				data-toggle="modal" data-target="#ModalDireccionesEventos">(Clic para insertar
				direccion)</span></button>
		<input type="text" value="{{ $Datos->PersonaDir }}"
			class="form-control  @error('dir_responsable_sol') is-invalid @enderror"
			name="dir_solicitante" id="dir_solicitante" maxlength="120" required readonly>
		@error('dir_responsable_sol')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3">
		<label for="barrio_responsable_sol" class="form-label">Barrio* </label>
		<select name="barrio_responsable_sol" id="barrio_responsable_sol"
			class="form-control @error('barrio_responsable_sol') is-invalid @enderror barrios" required>
			<option value=""></option>
			@foreach ($Barrios as $barrio)
				<option {{ old('barrio_responsable_sol') == $barrio->nombre ? "selected" : "" }}  value="{{ $barrio->nombre }}">{{ $barrio->nombre }}</option>

			@endforeach
		</select>
		@error('barrio_responsable_sol')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3">
		<label for="tel_responsable" class="form-label">Teléfono / Celular Responsable* </label>
		<input value="{{ $Datos->PersonaTel }}" type="text"
			class="form-control  @error('tel_responsable') is-invalid @enderror number_validate"
			name="tel_responsable" id="tel_responsable" maxlength="10" minlength="7" required
			onkeypress="return Numeros(event)">
		@error('tel_responsable')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3">
		<label for="email_responsable" class="form-label">Correo electrónico notificación electronica*</label>
		<input value="{{ $Datos->PersonaMail }}" type="mail"
			class="form-control  @error('email_responsable') is-invalid @enderror email_validate"
			name="email_responsable" id="email_responsable" required>
		@error('email_responsable')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3">
		<label for="email_confirmado" class="form-label">Confirme su correo* </label>
		<input type="mail"
			class="form-control  @error('email_confirmado') is-invalid @enderror email_validate"
			name="email_confirmado" id="email_confirmado" required onpaste="return false;">
		@error('email_confirmado')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>

</div>

<div class="row form-group Juridica mt-2 @if($Datos->PersonaTipDoc!='NIT') {{'d-none'}} @endif" id = "datosRepresentante">
	<div class="col-md-12 pl-1 pr-1 pt-3">
		<h3 class="headline-l-govco mt-3 pl-0 ">2. Datos del Representante legal</h3>
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3 >
		<label for="RepNombre" class="form-label">Nombres Representante legal*</label>
		<input value="{{ old('RepNombre') }}" type="text"
			class="form-control name_validate  @error('nom_solicitante') is-invalid @enderror"
			name="RepNombre" id="RepNombre" maxlength="25" minlength="4"
			onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">
		@error('nom_responsable')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3">
		<label for="RepApellido" class="form-label">Apellidos del Representante legal*</label>
		<input value="{{ old('RepApellido') }}" type="text"
			class="form-control name_validate  @error('ape_responsable') is-invalid @enderror"
			name="RepApellido" id="RepApellido" maxlength="25" minlength="4"
			onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">
		@error('ape_responsable')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3">
		<label for="RepTipDoc" class="form-label">Tipo de Documento* </label>
		<select class="form-control  @error('tipo_documento') is-invalid @enderror"
			name="RepTipDoc" id="RepTipDoc">
			<option value="">Seleccione</option>
			<option value="C.C.">Cedula de Ciudadanía</option>
			<option value="C.E.">Cedula de Extranjería</option>
			<option value="NIT">NIT</option>
		</select>
		@error('tipo_documento')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3">
		<label for="RepDoc" class="form-label">Número de Identificación* </label>
		<input value="{{ old('RepDoc') }}" type="text"
			class="form-control number_validate  @error('ide_responsable') is-invalid @enderror"
			name="RepDoc" id="RepDoc" maxlength="15" minlength="4"
			onkeypress="return Numeros(event)">
		@error('ide_responsable')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3">
		<label for="RepTel" class="form-label">Teléfono / Celular* </label>
		<input value="{{ old('RepTel') }}" type="text"
			class="form-control  @error('tel_responsable') is-invalid @enderror number_validate"
			name="RepTel" id="RepTel" maxlength="10" minlength="7"
			onkeypress="return Numeros(event)">
		@error('tel_responsable')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3">
		<label for="RepMail" class="form-label">Correo Electronico* </label>
		<input value="{{ old('RepMail') }}" type="mail"
			class="form-control  @error('email_responsable') is-invalid @enderror email_validate"
			name="RepMail" id="RepMail">
		@error('email_responsable')
			<span class="invalid-feedback" role="alert">
				<strong class="text-danger">{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="col-md-6 pl-1 pr-1 pt-3">
		<label for="email_confirmado" class="form-label">Confirme su correo* </label>
		<input type="mail"
			class="form-control  @error('email_confirmado') is-invalid @enderror email_validate"
			name="email_confirmado" id="email_confirmado"  onpaste="return false;">
		@error('email_confirmado')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<script>
		function activarRep(tipo)
		{
			if (tipo == "Juridica"){
			alert(tipo);
				$('.Juridica').removeClass('d-none');
				$('.Natural').addClass('d-none');
			}else{

				$('.Juridica').addClass('d-none');
				$('.Natural').removeClass('d-none');
				alert(tipo);
			}
		}

	</script>

</div>
<!-- end -->
