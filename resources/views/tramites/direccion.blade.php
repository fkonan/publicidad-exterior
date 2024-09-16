{{-- MODAL DIRECCIONES --}}

    <div id="ModalDireccionesEventos" class="modal fade center" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width: 1000px!important;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background:#E5EEFB;">
                    <h4 class="modal-title">Ingresa tu Dirección</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row form-row">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD01"
                                    style="font-family: 'Barlow', sans-serif;"> Calle - Carrera *</label>
                                <select name="DD01" id="DD01" type="text" class="form-control input-md modal1"
                                    required="required"
                                    title="Selecciona el tipo de indicación inicial para la dirección que desea ingresar">
                                    <option value=""></option>
                                    @foreach ($Parametros2 as $parametro2)
                                        <option value="{{ $parametro2->ParDes }}">{{ $parametro2->ParDes }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD02"
                                    style="font-family: 'Barlow', sans-serif;">N° - Nombre * </label>
                                <input id="DD02" name="DD02" type="text" class="form-control modal1" maxlength="20"
                                    required="required"
                                    title="En este campo se deberá digitar número o nombre según corresponda a la selección en el campo anterior, te recomendamos observar el campo de visualización que se encuentra al final de este módulo para organizar tu dirección correctamente."
                                    onkeypress="return NumDoc(event)" onchange="aMayusculas(this.value,this.id)"
                                    style="height: 29px!important;">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD03"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD03" name="DD03" type="text" class="form-control input-md modal1"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                                    <option value=""></option>
                                    @foreach ($Parametros1 as $parametro1)
                                        <option value="{{ $parametro1->ParNom }}">{{ $parametro1->ParNom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD04"
                                    style="font-family: 'Barlow', sans-serif;">Numero* </label>
                                <input id="DD04" name="DD04" type="text" class="form-control modal1" maxlength="4"
                                    title="Digita en este campo el primer número de tu dirección"
                                    onkeypress="return Numeros(event)" required="required" style="height: 29px!important;">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD05"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD05" name="DD05" type="text" class="form-control input-md modal1"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                                    <option value=""></option>
                                    @foreach ($Parametros1 as $parametro1)
                                        <option value="{{ $parametro1->ParNom }}">{{ $parametro1->ParNom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD06"
                                    style="font-family: 'Barlow', sans-serif;">Numero* </label>
                                <input id="DD06" name="DD06" type="text" class="form-control modal1" maxlength="4"
                                    title="Digita en este campo el primer número de tu dirección"
                                    onkeypress="return Numeros(event)" style="height: 29px!important;">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD07"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD07" name="DD07" type="text" class="form-control input-md modal1"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                                    <option value=""></option>
                                    @foreach ($Parametros1 as $parametro1)
                                        <option value="{{ $parametro1->ParNom }}">{{ $parametro1->ParNom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-2 col-sm-12 col-xs-12 caja_ultima"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD08"
                                    style="font-family: 'Barlow', sans-serif;">Complemento </label>
                                <input id="DD08" name="DD08" type="text" class="form-control modal1" maxlength="80"
                                    title="Digita en este el complemento de tu direccion"
                                    onkeyup="aMayusculas(this.value,this.id)">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br><br>
                            <div class="form-group">
                                <input
                                    style="background-color: #004884; color: #FFFFFF; font-weight: bold; border-radius:8px;"
                                    name="Direccion" id="DD000" type="text" class="form-control input-md DD00"
                                    data-toggle="tooltip" title="Previsualizador de la dirección introducida"
                                    data-delay='{"show":"30", "hide":"30"}' placeholder="Pre visualizador de direcciones"
                                    required="required" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info"
                        id="btnDireccionEventos1" value="Boton" onclick="javascript:direccion();">Ingresar Dirección</button>
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info"
                        data-dismiss="modal">Cerrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div id="ModalUbicacion" class="modal fade center" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width: 1000px!important;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background:#E5EEFB;">
                    <h4 class="modal-title">Ingresa tu Dirección</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row form-row">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD01"
                                    style="font-family: 'Barlow', sans-serif;"> Calle - Carrera *</label>
                                <select name="DD01" id="DD010" type="text" class="form-control input-md modal2"
                                    required="required"
                                    title="Selecciona el tipo de indicación inicial para la dirección que desea ingresar">
                                    <option value=""></option>
                                    @foreach ($Parametros2 as $parametro2)
                                        <option value="{{ $parametro2->ParDes }}">{{ $parametro2->ParDes }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD02"
                                    style="font-family: 'Barlow', sans-serif;">N° - Nombre * </label>
                                <input id="DD020" name="DD02" type="text" class="form-control modal2" maxlength="20"
                                    required="required"
                                    title="En este campo se deberá digitar número o nombre según corresponda a la selección en el campo anterior, te recomendamos observar el campo de visualización que se encuentra al final de este módulo para organizar tu dirección correctamente."
                                    onkeypress="return NumDoc(event)" onchange="aMayusculas(this.value,this.id)"
                                    style="height: 29px!important;">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD03"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD030" name="DD03" type="text" class="form-control input-md modal2"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                                    <option value=""></option>
                                    @foreach ($Parametros1 as $parametro1)
                                        <option value="{{ $parametro1->ParNom }}">{{ $parametro1->ParNom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD04"
                                    style="font-family: 'Barlow', sans-serif;">Numero* </label>
                                <input id="DD040" name="DD04" type="text" class="form-control modal2" maxlength="4"
                                    title="Digita en este campo el primer número de tu dirección"
                                    onkeypress="return Numeros(event)" required="required" style="height: 29px!important;">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD05"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD050" name="DD050" type="text" class="form-control input-md modal2"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                                    <option value=""></option>
                                    @foreach ($Parametros1 as $parametro1)
                                        <option value="{{ $parametro1->ParNom }}">{{ $parametro1->ParNom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD06"
                                    style="font-family: 'Barlow', sans-serif;">Numero* </label>
                                <input id="DD060" name="DD06" type="text" class="form-control modal2" maxlength="4"
                                    title="Digita en este campo el primer número de tu dirección"
                                    onkeypress="return Numeros(event)" style="height: 29px!important;">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD07"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD070" name="DD070" type="text" class="form-control input-md modal2"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                                    <option value=""></option>
                                    @foreach ($Parametros1 as $parametro1)
                                        <option value="{{ $parametro1->ParNom }}">{{ $parametro1->ParNom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-2 col-sm-12 col-xs-12 caja_ultima"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD08"
                                    style="font-family: 'Barlow', sans-serif;">Complemento </label>
                                <input id="DD080" name="DD08" type="text" class="form-control modal2" maxlength="80"
                                    title="Digita en este el complemento de tu direccion"
                                    onkeyup="aMayusculas(this.value,this.id)">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br><br>
                            <div class="form-group">
                                <input
                                    style="background-color: #004884; color: #FFFFFF; font-weight: bold; border-radius:8px;"
                                    name="Direccion" id="DD0000" type="text" class="form-control input-md DD00"
                                    data-toggle="tooltip" title="Previsualizador de la dirección introducida"
                                    data-delay='{"show":"30", "hide":"30"}' placeholder="Pre visualizador de direcciones"
                                    required="required" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info"
                        id="btnModalUbicacionEvento" value="Boton">Ingresar Dirección</button>
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info"
                        data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
