
<div class="col-md-12 pl-1 pt-3">
	<h4 class="headline-m-govco">Aviso de privacidad y autorización tratamiento de datos personales</h4>

	<a class="btn btn-low px-0"
		href="https://www.bucaramanga.gov.co/Inicio/autorizacion-de-tratamiento-de-datos-personales/"
		target="_blank">Autorizo el tratamiento de datos personales</a>
	<label class="checkbox-govco d-inline">
		<input type="checkbox" id="AT00" name="tratamiento_datos" checked value="SI" />
		<label for="AT00"> </label>
	</label><br>

	<a class="btn btn-low px-0"
		href="https://www.bucaramanga.gov.co/Inicio/autorizacion-de-tratamiento-de-datos-personales/"
		target="_blank">Acepto términos y condiciones</a>
	<label class="checkbox-govco d-inline">
		<input type="checkbox" id="AT01" name="acepto_terminos" checked value="SI" />
		<label for="AT01"> </label>
	</label>
	<p class="text-justify">Confirmo que soy mayor de edad y con plena capacidad para
		diligenciar el presente formulario.
		Así mismo declaro que la información aquí suministrada corresponde a la verdad.
		Declaro que he leído, entiendo y acepto las políticas de tratamiento de los datos que
		suministro, de conformidad con la Ley 1581 de 2012 y demás normas concordantes
		<label class="checkbox-govco d-inline">
			<input type="checkbox" id="AT02" name="confirmo_mayorEdad" checked value="SI" />
			<label for="AT02"> </label>
		</label>
	</p>
    <p class="text-justify">Autorizó para que las comunicaciones, documentos y/o actos administrativos que la entidad profiera a mi nombre sean notificados al correo electrónico suministrado.
		<label class="checkbox-govco d-inline">
			<input type="checkbox" id="AT03" name="confirmo_politica" checked value="SI" />
			<label for="AT03"> </label>
		</label>
	</p>
</div>
<div class="col-md-11 pl-1 pr-1 pt-3">
	<p>Acepto que la información aquí registrada sea compartida con otras entidades y/o
		terceros vinculados a la Alcaldía de Bucaramanga</p>
	@error('compartir_informacion')
		<span class="invalid-feedback" role="alert">
			<strong class="text-danger">{{ $message }}</strong>
		</span>
	@enderror
	<div class="form-check-inline">
		<label class="radiolist-govco radiobutton-govco">
			<input type="radio" name="compartir_informacion" id="rb_si" value="SI" required checked/>
			<label for="rb_si">SI</label>
		</label>
	</div>
	<div class="form-check-inline">
		<label class="radiolist-govco radiobutton-govco">
			<input type="radio" name="compartir_informacion" id="rb_no" value="NO" />
			<label for="rb_no">NO</label>
		</label>
	</div>
</div>
 <!--<div class="g-recaptcha" data-sitekey="6LcoZ0IcAAAAAJO2XZZyhHvhacYdwmr4xKZ5DjgN"></div>-->
