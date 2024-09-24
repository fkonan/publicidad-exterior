{{-- MODAL CONSULTAR SOLICITUD --}}

<div id="ModalConsulta" class="modal fade center" role="dialog">
	<div class="modal-dialog modal-lg" style="max-width: 1000px!important;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" style="background:#E5EEFB;">
				<h4 class="modal-title">Consultar Solicitud</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="post" action="{{ route('publicidad.consulta') }}">
				@csrf
				<div class="modal-body">
					<div class="row form-row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
							<div class="form-group">
								<label style="color:#111111;" class="input" for="DD01"
									style="font-family: 'Barlow', sans-serif;">Buscar por</label>
								<select id="VD01" name="tipo_parametro" class="form-control input-md"
									title="Seleccione la opción para validar el documento" required="required">
									<option value="radicado">Número de radicado</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
							<div class="form-group">
								<label style="color:#111111;" class="input" for="DD01"
									style="font-family: 'Barlow', sans-serif;">Digite Numero </label>
								<input type="text" name="parametro" id="parametro" class="form-control input-md"
									title="Seleccione la opción para validar el documento" required="required"
									onkeypress="" onkeyup="aMayusculas(this.value,this.id)"
									maxlength="20" minlength="8">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-round btn-middle btn-outline-info" id="Boton">Realizar Búsqueda</button>
					<button type="button" class="btn btn-round btn-middle btn-outline-info" data-dismiss="modal">Cerrar</button>
				</div>
			</form>
		</div>
	</div>
</div>
