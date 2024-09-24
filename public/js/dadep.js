//funciones agregadas
 var campoDir = "";
function direccion() {
        var direccion = $("#DD000").val();
       $("#ModalDireccionesEventos").modal("hide");
       $(campo).val("");
       $(campo).val(direccion);

}


 /*============================================================================
    =            input de  Licencia Urbanizacion  minlength = 10
                 id = "PredioLicencia"               maxlength =15
    ============================================================================*/

    $("#PredioLicencia").change(function () {
        var input8 = document.getElementById("PredioLicencia").value;
        var ValInput8 = input8.match(/^[0-9/-]{4,10}$/);
        if (ValInput8 == null) {
            alert(
                "No se permiten letras, menos de cuatro(4) digitos ni más de diez(10) digitos, Solo se permite los caracteres especiales (-)"
            );
            $("#PredioLicencia").focus();
            $("#PredioLicencia").val("");
        }
    });






/*============================================================================
    =            input de  Matricula  minlength = 9
                 id = "PredioMatricula"               maxlength =12
    ============================================================================*/

  $("#PredioMatricula").change(function () {
        var input8 = document.getElementById("PredioMatricula").value;
        var ValInput8 = input8.match(/^[0-9/-]{9,12}$/);
        if (ValInput8 == null) {
            alert(
                "No se permiten letras, menos de nueve(9) digitos ni más de doce(12) digitos, Solo se permite los caracteres especiales (-)"
            );
            $("#PredioMatricula").focus();
            $("#PredioMatricula").val("");
        }
    });



/*============================================================================
    =            input de  Area total  minlength = 2
                 id = "AreaTotal"               maxlength =5
    ============================================================================*/

  $("#AreaTotal").change(function () {
        var input8 = document.getElementById("AreaTotal").value;
        var ValInput8 = input8.match(/^[0-9/]{2,6}$/);
        if (ValInput8 == null) {
            alert(
                "No se permiten letras, ni caracteres especiales o menos de dos(2) digitos ni más de seis(6) digitos,"
            );
            $("#AreaTotal").focus();
            $("#AreaTotal").val("");
        }
    });

    /*============================================================================
    =            input de  Area Cesion  minlength = 2
                 id = "PredioMatricula"         maxlength =6
    ============================================================================*/

  $("#AreaCesion").change(function () {
        var input8 = document.getElementById("AreaCesion").value;
        var ValInput8 = input8.match(/^[0-9/]{2,6}$/);
        if (ValInput8 == null) {
            alert(
                "No se permiten letras, ni caracteres especiales o menos de dos(2) digitos ni más de seis(6) digitos,"
            );
            $("#AreaCesion").focus();
            $("#AreaCesion").val("");
        }
    });


    /*============================================================================
    =            input de  Escritura Pública    minlength = 4
                 id = "PredioMatricula"               maxlength =4
    ============================================================================*/

  $("#PredioEscritura").change(function () {
        var input8 = document.getElementById("PredioEscritura").value;
        var ValInput8 = input8.match(/^[0-9/]{4}$/);
        if (ValInput8 == null) {
            alert(
                "No se permiten letras, ni mas o menos de cuatro(4) digitos"
            );
            $("#PredioEscritura").focus();
            $("#PredioEscritura").val("");
        }
    });


     /*============================================================================
    =            input de  Ciudad    minlength = 4
                 id = "PredioMatricula"               maxlength =4
    ============================================================================*/

  $("#Ciudad").change(function () {
        var input8 = document.getElementById("Ciudad").value;
        var ValInput8 = input8.match(/^[a-zA-Z/]{4,20}$/);
        if (ValInput8 == null) {
            alert(
                "No se permiten números, ni mas veinte(20) o menos de cuatro(4) digitos"
            );
            $("#Ciudad").focus();
            $("#Ciudad").val("");
        }
    });


    /*============================================================================
    =            input de radicado  minlength = 8
                 id = "Radicado"               maxlength =10
    ============================================================================*/

    $("#Radicado").change(function () {
        var input8 = document.getElementById("Radicado").value;
        var ValInput8 = input8.match(/^[0-9/-]{8,20}$/);
        if (ValInput8 == null) {
            alert(
                "No se permiten letras, menos de ocho(8) digitos ni más de veinte(20) digitos, Solo se permite los caracteres especiales (-)"
            );
            $("#Radicado").focus();
            $("#Radicado").val("");
        }
    });



