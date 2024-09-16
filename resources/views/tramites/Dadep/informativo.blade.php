<!---contacto -->

<div class="accordion accordion-govco" id="EjemploAccordion-2">
	<div class="card mb-0">
		<div class="card-header row no-gutters" id="headingUno">
			<button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse"
				data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
					<span class="title">¿Tienes dudas?</span>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<div class="btn-icon-close">
						<span class="govco-icon govco-icon-minus"></span>
						<span class="govco-icon govco-icon-simpled-arrow"></span>
					</div>
				</div>
			</button>
		</div>
		<div id="collapse1" class="collapse" aria-labelledby="headingUno"
			data-parent="#EjemploAccordion-2">
			<div class="card-body bg-color-selago">
				<div class="container">
					<p class="form-inline my-0">
						<span class="govco-icon govco-icon-email"></span> 
						<a style="color: #3366CC; font-size: 13px!important;" href="mailto:dadep@bucaramanga.gov.co"
							target="_blank"> dadep@bucaramanga.gov.co</a>
					</p>
					<p class="form-inline my-0">
						<span class="govco-icon govco-icon-call-center"></span>
						<a style="color: #3366CC; font-size: 13px!important;" href="tel:0376337000"> (+57)7 633 70 00 EXT 224</a>
					</p>

					<p class="form-inline my-0"><span class="govco-icon govco-icon-attached-n 2x"></span><a
						style="color: #3366CC; font-size: 13px!important;" href="{{asset('library/Manuales/M-TIC-1400-170-016 M.Usuario. Areas Cesión DADEP (ciudadano).pdf')}}" target="_blank">Descargue manual de usuario</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
	
<!---sugerencias -->
<div class="accordion accordion-govco" id="acc4">
	<div class="card">
		<div class="card-header row no-gutters" id="c4">
			<button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse"
				data-target="#coll4" aria-expanded="false" aria-controls="coll4" id="btn_colapse">
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
					<span class="title">¿Como fue tu experiencia durante el proceso?</span>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<div class="btn-icon-close">
						<span class="govco-icon govco-icon-minus"></span>
						<span class="govco-icon govco-icon-simpled-arrow"></span>
					</div>
				</div>
			</button>
		</div>
		<div id="coll4" class="collapse" aria-labelledby="c4" data-parent="#acc4">
			<div class="card-body bg-color-selago">
				<div class="row justify-content-center spacer no-gutters">
					<div class="col-3 pl-3 pt-2">
						<button type="button" id="btn-facil-global"
							class="btn-symbolic-govco align-column-govco btn-facil-global"
							value="FACIL">
							<span class="govco-icon govco-icon-check-cn size-3x"></span>
							<span class="btn-govco-text">Facil</span>
						</button>
					</div>

					<div class="col-3 pl-3 pt-2">
						<button type="button" id="btn-dificil-global"
							class="btn-symbolic-govco align-column-govco btn-dificil-global"
							value="DIFICIL">
							<span class="govco-icon govco-icon-x-cn size-3x"></span>
							<span class="btn-govco-text">Dificil</span>
						</button>
					</div>
				</div>
				
				{{-- modulo tramites --}}
				<input id="modulo" type="hidden" class="form-control modulo"
					value="PERMISOS PARA ESPECTACULOS PUBLICOS">


				<div class="container text-center">
					<button type="button" class="btn btn-round btn-middle btn-block"
						id="btn-sugerencias" data-toggle="tooltip" data-placement="right"
						title="Después de escribir tus sugerencias oprime FACIL o DIFICIL para enviarlas"
						style="">Escribe
						tus sugerencias</button><br>
					<div id="Texto_sugerencias" style="display: none;">
						<p style="color:#3366CC;"> Gracias por compartir tu experiencia</p>
					</div>

					<div id="text-button" style="padding-bottom: 10px; display: none;">
						<label class="text-left small">Escribe tus comentarios</label>
						<textarea class="form-control pb-2" rows="5"
							placeholder="Queremos conocer tu experiencia, sugerencias y consejos"
							id="text-area" maxlength="300" onkeypress="return Direccion(event)"
							onkeyup="aMayusculas(this.value,this.id)"></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
             
<!---consulta -->
<div class="accordion accordion-govco pt-0" id="acc3">
	<div class="card">
		<div class="card-header row no-gutters" id="c3">
			<button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse"
				data-target="#coll3" aria-expanded="false" aria-controls="coll3">
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
					<span class="title">Consulto mi Solicitud</span>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<div class="btn-icon-close">
						<span class="govco-icon govco-icon-minus"></span>
						<span class="govco-icon govco-icon-simpled-arrow"></span>
					</div>
				</div>
			</button>
		</div>
		<div id="coll3" class="collapse" aria-labelledby="c3" data-parent="#acc3">
			<div class="card-body bg-color-selago">
				<div class="container text-center">
					<button data-toggle="modal" data-target="#ModalConsulta" type="button"
						class="btn btn-round btn-middle">CONSULTE AQUÍ
					</button>
				</div>
			</div>
		</div>
	</div>
</div>




