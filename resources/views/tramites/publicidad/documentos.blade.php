<div class="row form-group mt-2">
    <h3 class="headline-l-govco mt-3 pl-0">5. Adjuntar documentos a la Solicitud</h3>

    <div class="col-md-6 pl-1 pr-1 pt-3 documento d-none" id="Grupo0">
        <label for="documento0" class="form-label">Foto montaje o plano digitalizado</label> &nbsp;
        <small style="font-size: 11px!important; text-align:justify!important;"><em
                style="font-size: 11px!important; text-align:justify!important;">Adjuntar foto montaje o plano
                digitalizado</em>
        </small>
        <div class="form-group">
            <div class="file-loading">
                <input class=" @error('documento0') is-invalid @enderror documentos_adjuntos" id="documento0"
                    accept="application/pdf" name="documento0" type="file" data-overwrite-initial="true">
                @error('documento0')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-6 pl-1 pr-1 pt-3 documento d-none" id="Grupo1">
        <label for="documento1" class="form-label">Cámara de comercio
            <small style="font-size: 11px!important;text-align:justify!important;">
                <em style="font-size: 11px!important">
                    Adjuntar cámara de comercio.
                </em> <br>
            </small>
        </label><br>
        <div class="form-group">
            <div class="file-loading">
                <input class=" @error('documento1') is-invalid @enderror documentos_adjuntos" id="documento1"
                    accept="application/pdf" name="documento1" type="file" data-overwrite-initial="true">
                @error('documento1')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-6 pl-1 pr-1 pt-3 documento d-none" id="Grupo2">
        <label for="documento2" class="form-label">Certificado de libertad y tradición<small
                style="font-size: 11!important;" aling="justify"><em style="font-size: 11px!important" aling="justify">:
                    Adjuntar certificado de libertad y tradicción.</em></small> </label>
        <div class="form-group">
            <div class="file-loading">
                <input class=" @error('documento2') is-invalid @enderror documentos_adjuntos" id="documento2"
                    accept="application/pdf" name="documento2" type="file" data-overwrite-initial="true">
                @error('documento2')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-6 pl-1 pr-1 pt-3 documento d-none" id="Grupo3">
        <label for="documento3" class="form-label">Autorización del propietario</label>
        <small style="font-size: 11px!important; text-align:justify!important;"><em
                style="font-size: 11px!important; text-align:justify!important;">Adjuntar autorización del
                propietario.</em>
        </small>
        <div class="form-group">
            <div class="file-loading">
                <input class=" @error('documento3') is-invalid @enderror documentos_adjuntos" id="documento3"
                    accept="application/pdf" name="documento3" type="file" data-overwrite-initial="true">
                @error('documento3')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-6 pl-1 pr-1 pt-3 documento d-none" id="Grupo4">
        <label for="documento4" class="form-label">Licencia de construcción</label>
        <small style="font-size: 11px!important; text-align:justify!important;"><em
                style="font-size: 11px!important; text-align:justify!important;">Adjuntar licencia de construcción.</em>
        </small>
        <div class="form-group">
            <div class="file-loading">
                <input class=" @error('documento4') is-invalid @enderror documentos_adjuntos" id="documento4"
                    accept="application/pdf" name="documento4" type="file" data-overwrite-initial="true">
                @error('documento4')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-6 pl-1 pr-1 pt-3 documento d-none" id="Grupo5">
        <label for="documento5" class="form-label">Tarjeta de propiedad del vehículo</label>
        <small style="font-size: 11px!important; text-align:justify!important;"><em
                style="font-size: 11px!important; text-align:justify!important;">Adjuntar tarjeta de propiedad del
                vehículo.</em><br><br><br><br>
        </small>
        <div class="form-group">
            <div class="file-loading">
                <input class=" @error('documento5') is-invalid @enderror documentos_adjuntos" id="documento5"
                    accept="application/pdf" name="documento5" type="file" data-overwrite-initial="true">
                @error('documento5')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-6 pl-1 pr-1 pt-3 documento d-none" id="Grupo6">
        <label for="documento6" class="form-label">Regitro único tributario - RUT</label>
        <small style="font-size: 11px!important; text-align:justify!important;"><em
                style="font-size: 11px!important; text-align:justify!important;">Adjuntar Rut.</em><br>
        </small>
        <div class="form-group">
            <div class="file-loading">
                <input class=" @error('documento6') is-invalid @enderror documentos_adjuntos" id="documento6"
                    accept="application/pdf" name="documento6" type="file" data-overwrite-initial="true">
                @error('documento5')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <script>
        function documentos(modalidad) {
            $('.documento').addClass('d-none');
            var movil = [0, 1, 6];
            var vallas = [0, 1, 2, 3, 6];
            var murales = [1, 2, 3, 6];
            var pendones = [0, 1, 4, 6];
            var aerea = [0, 1, 6];
            var pasacalles = [1, 6];
            var doc = [vallas, pendones, murales, pasacalles, aerea, movil];
            var grupos = doc[modalidad];
            for (i = 0; i < grupos.length; i++) {
                var nombre = "#Grupo" + grupos[i];
                $(nombre).find('input').attr('required', true);
                // $(nombre).attr('required',true);
                $(nombre).removeClass('d-none');
            }
        }
    </script>
</div>