$(document).ready(function() {
	/*============================================================================
    =            input de usuarios
                id = "user_validate"        maxlength =60
    ============================================================================*/

	$('#user_validate').change(function() {
		var inputdd09 = document.getElementById('user_validate').value;
		var ValInputdd09 = inputdd09.match(/^[a-zA-Z0-9\.@\s]{4,60}$/);
		if (ValInputdd09 == null) {
			alert('Solo se permiten los caracteres especiales (.), ni menos de 4 caracteres');
			$('#user_validate').focus();
			$('#user_validate').val('');
		}
	});

	/*============================================================================
    =            input de  nombres
                id = "name_validate"        maxlength =20
    ============================================================================*/

	$('.name_validate').change(function() {
		$(this).each(function() {
			var input1 = $(this).val();
			var ValInput1 = input1.match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{3,20}$/);
			if (ValInput1 == null) {
				alert(
					'No se permiten números, caracteres especiales, espacios o menos de tres(3) letras ni más de quince(20) letras'
				);
				$(this).focus();
				$(this).val('');
			}
		});
	});

	/*============================================================================
    =            input de  apellidos
                id = "name_validate"        maxlength =20
    ============================================================================*/

	$('#lastname_validate').change(function() {
		var input1 = document.getElementById('lastname_validate').value;
		var ValInput1 = input1.match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{3,20}$/);
		if (ValInput1 == null) {
			alert(
				'No se permiten números, caracteres especiales, espacios o menos de tres(3) letras ni más de quince(20) letras'
			);
			$('#lastname_validate').focus();
			$('#lastname_validate').val('');
		}
	});

	/*============================================================================
    =            input de  numero de documento
                id = "document_validate"        maxlength =15
    ============================================================================*/

	$('.document_validate').change(function() {
		$(this).each(function() {
			var input1 = $(this).val();
			var ValInput1 = input1.match(/^[a-zA-Z0-9\-]{5,15}$/);
			if (ValInput1 == null) {
				alert('No se permiten espacios, solo se permite el carácter especial (-)');
				$(this).focus();
				$(this).val('');
			}
		});
	});

	/*============================================================================
    =            input de  direccion
                id = "address_validate"        maxlength =100
    ============================================================================*/

	$('#address_validate').change(function() {
		var inputdd09 = document.getElementById('address_validate').value;
		var ValInputdd09 = inputdd09.match(/^[a-zA-Z0-9\-#\s]{5,100}$/);
		if (ValInputdd09 == null) {
			alert('Solo se permiten los caracteres especiales (#) (-) o menos de 5 digitos');
			$('#address_validate').focus();
			$('#address_validate').val('');
		}
	});

	/*============================================================================
    =            input de  correo electronico
                id = "email_validate"        maxlength =50
    ============================================================================*/

	$('.email_validate').change(function() {
		$(this).each(function() {
			var input10 = $(this).val();
			var ValInput10 = input10.match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{4,}[.][a-zA-Z0-9\.]{2,12}$/);
			if (ValInput10 == null) {
				alert('Correo no valido, por favor revise');
				$(this).focus();
				$(this).val('');
			}
		});
	});

	/*============================================================================
    =            input de  telefono fijo      minlength = 7
                id = "number_validate"        maxlength =10
    ============================================================================*/

	$('.number_validate').change(function() {
		$(this).each(function() {
			var input8 = $(this).val();
			var ValInput8 = input8.match(/^[0-9]{7,10}$/);
			if (ValInput8 == null) {
				alert(
					'No se permiten letras, caracteres especiales o menos de siete(7) digitos ni más de diez(10) digitos'
				);
				$(this).focus();
				$(this).val('');
			}
		});
	});

	/*============================================================================
    =            input de  telefono movil     minlength = 10
                id = "cel_validate"           maxlength =15
    ============================================================================*/

	$('#cel_validate').change(function() {
		var input8 = document.getElementById('cel_validate').value;
		var ValInput8 = input8.match(/^[0-9]{10,15}$/);
		if (ValInput8 == null) {
			alert(
				'No se permiten letras, caracteres especiales o menos de diez(10) digitos ni más de quince(15) digitos'
			);
			$('#cel_validate').focus();
			$('#cel_validate').val('');
		}
	});

	  /*============================================================================
    =            input de  telefono fijo      minlength = 7
                id = "number_validate"        maxlength =10
    ============================================================================*/

    $(".age_validate").change(function () {
        $(this).each(function () {
            var input8 = $(this).val();
            var ValInput8 = input8.match(/^[0-9]{1,2}$/);
            if (ValInput8 == null) {
                alert(
                    "No se permiten letras, caracteres especiales, se permiten maximo 2(dos) digitos"
                );
                $(this).focus();
                $(this).val("");
            }
        });
    });

	/*============================================================================
    =            FUNCION DE VALIDAR CONTRASEÑAS IGUALES    
                id = "pass_origin"               
                id = "confirmate_pass"               maxlength =20

    ============================================================================*/

	$('#confirmate_pass').change(function() {
		var password = document.getElementById('pass_origin').value;
		var password_confirmate = document.getElementById('confirmate_pass').value;

		if (password_confirmate !== password) {
			alert('Las contraseñas no coinciden, escribelas de nuevo');
			$('#pass_origin').val('');
			$('#confirmate_pass').val('');
			$('#pass_origin').focus();
		}
	});

	/*============================================================================
    =            input de  razon social
                id = "address_validate"        maxlength =100
    ============================================================================*/

	$('.razon_social').change(function() {
		$(this).each(function() {
			var input8 = $(this).val();
			var ValInput8 = input8.match(/^[a-zA-Z0-9\-.,\s]{5,100}$/);
			if (ValInput8 == null) {
				alert('Solo se permiten los caracteres especiales (.)(,)(-) o menos de 5 digitos');
				$(this).focus();
				$(this).val('');
			}
		});
	});

	$('#btn-sugerencias').click(function() {
		$('#text-button').fadeToggle('slow', 'swing');
		$('#text-area').focus();
	});

	$('[data-toggle="tooltip"]').tooltip();
	$('#modalidad').select2({
		width: 'resolve',
		placeholder: 'Seleccione una opción..'
	});

	$('#DD01').select2({
		width: '100%',
		placeholder: 'Seleccione'
	});

	$('#DD03').select2({
		width: '100%',
		placeholder: 'Seleccione letra'
	});

	$('#DD05').select2({
		width: '100%',
		placeholder: 'Seleccione letra'
	});
	$('#DD07').select2({
		width: '100%',
		placeholder: 'Seleccione letra'
	});

	// parqueaderos

	$('#DD010').select2({
		width: '100%',
		placeholder: 'Seleccione'
	});

	$('#DD030').select2({
		width: '100%',
		placeholder: 'Seleccione letra'
	});

	$('#DD050').select2({
		width: '100%',
		placeholder: 'Seleccione letra'
	});
	$('#DD070').select2({
		width: '100%',
		placeholder: 'Seleccione letra'
	});

	$('#barrio_empresa').select2({
		width: '100%',
		placeholder: 'Seleccione letra'
	});
	//fin parqueaderos

	$('#barrio').select2({
		width: '100%',
		placeholder: 'Seleccione Barrio..'
	});
	$('#vereda').select2({
		width: '100%',
		placeholder: 'Seleccione Vereda..'
	});

	$('#selectRoles').select2({
		width: '100%',
		multiple: 'multiple',
		tags: true,
		tokenSeparators: [
			',',
			' '
		]
	});

	$('#barrio_solicitante').select2({
		width: '100%',
		placeholder: 'Seleccione Barrio..'
	});

	// renderizar direccion

	$('.modal1').on('change', function() {
		var dd01 = document.getElementById('DD01').value;
		var dd02 = document.getElementById('DD02').value;
		var dd03 = document.getElementById('DD03').value;
		var dd04 = document.getElementById('DD04').value;
		var dd05 = document.getElementById('DD05').value;
		var dd06 = document.getElementById('DD06').value;
		var dd07 = document.getElementById('DD07').value;
		var dd08 = document.getElementById('DD08').value;


		document.getElementById('DD000').value =
			dd01 + ' ' + dd02 + ' ' + dd03 + '# ' + dd04 + dd05 + '- ' + dd06 + dd07 + ' ' + dd08;
	});

	// segundo modal
	$('.modal2').on('change', function() {
		var dd01 = document.getElementById('DD010').value;
		var dd02 = document.getElementById('DD020').value;
		var dd03 = document.getElementById('DD030').value;
		var dd04 = document.getElementById('DD040').value;
		var dd05 = document.getElementById('DD050').value;
		var dd06 = document.getElementById('DD060').value;
		var dd07 = document.getElementById('DD070').value;
		var dd08 = document.getElementById('DD080').value;

		if(dd01=='ESTADIO'){
			document.getElementById('DD0000').value = '';
			document.getElementById('DD0000').value =
			dd01 + ' ' + dd02 + ' ' + dd03 + ' ' + dd04 + dd05 + ' ' + dd06 + dd07 + ' ' + dd08;
		}else{

		document.getElementById('DD0000').value =
			dd01 + ' ' + dd02 + ' ' + dd03 + '# ' + dd04 + dd05 + '- ' + dd06 + dd07 + ' ' + dd08;
		}
	});

	// $("#btnDireccion").click(function () {
	//     var direccion = $("#DD00").val();
	//     $("#ModalDirecciones").modal("hide");
	//     $("#direccion").val("");
	//     $("#direccion").val(direccion);
	// });

	// parqueadero modal 1
	$('#btnDireccion').click(function() {
		var direccion = $('#DD000').val();
		$('#ModalDirecciones').modal('hide');
		$('#direccion_solicitante').val('');
		$('#direccion_solicitante').val(direccion);
	});

	// parqueadero modal 2
	$('#btnDireccionEmpresas').click(function() {
		var direccion = $('#DD0000').val();
		$('#ModalDireccionesEmpresas').modal('hide');
		$('#direccion_empresa').val('');
		$('#direccion_empresa').val(direccion);
	});

	$('#matricula').change(function() {
		var input8 = document.getElementById('matricula').value;
		var ValInput8 = input8.match(/^[0-9]{5,30}$/);
		if (ValInput8 == null) {
			alert(
				'No se permiten letras, caracteres especiales o menos de cinco(5) digitos ni más de treinta(30) digitos'
			);
			$('#matricula').focus();
			$('#matricula').val('');
		}
	});

	// validaciones Formulario

	$('#nom_titular').change(function() {
		var input1 = document.getElementById('nom_titular').value;
		var ValInput1 = input1.match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{4,20}$/);
		if (ValInput1 == null) {
			alert(
				'No se permiten números, caracteres especiales, espacios o menos de cuatro(4) letras ni más de veinticinco(25) letras'
			);
			$('#nom_titular').focus();
			$('#nom_titular').val('');
		}
	});

	$('#ape_titular').change(function() {
		var input1 = document.getElementById('ape_titular').value;
		var ValInput1 = input1.match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{4,20}$/);
		if (ValInput1 == null) {
			alert(
				'No se permiten números, caracteres especiales, espacios o menos de cuatro(4) letras ni más de veinticinco(25) letras'
			);
			$('#ape_titular').focus();
			$('#ape_titular').val('');
		}
	});

	$('#identificacion_titular').change(function() {
		var input8 = document.getElementById('identificacion_titular').value;
		var ValInput8 = input8.match(/^[0-9]{6,15}$/);
		if (ValInput8 == null) {
			alert(
				'No se permiten letras, caracteres especiales o menos de seis(6) digitos ni más de quince(15) digitos'
			);
			$('#identificacion_titular').focus();
			$('#identificacion_titular').val('');
		}
	});

	$('#tel_titular').change(function() {
		var input8 = document.getElementById('tel_titular').value;
		var ValInput8 = input8.match(/^[0-9]{7,10}$/);
		if (ValInput8 == null) {
			alert(
				'No se permiten letras, caracteres especiales o menos de siete(7) digitos ni más de diez(10) digitos'
			);
			$('#tel_titular').focus();
			$('#tel_titular').val('');
		}
	});

	$('#email_titular').change(function() {
		var input10 = document.getElementById('email_titular').value;
		var ValInput10 = input10.match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{4,}[.][a-zA-Z0-9\.]{2,12}$/);
		if (ValInput10 == null) {
			alert('Correo no valido, por favor revise');
			$('#email_titular').focus();
			$('#email_titular').val('');
		}
	});

	$('#nom_profesional').change(function() {
		var input1 = document.getElementById('nom_profesional').value;
		var ValInput1 = input1.match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{4,20}$/);
		if (ValInput1 == null) {
			alert(
				'No se permiten números, caracteres especiales, espacios o menos de cuatro(4) letras ni más de veinticinco(25) letras'
			);
			$('#nom_profesional').focus();
			$('#nom_profesional').val('');
		}
	});

	$('#ape_profesional').change(function() {
		var input1 = document.getElementById('ape_profesional').value;
		var ValInput1 = input1.match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{4,20}$/);
		if (ValInput1 == null) {
			alert(
				'No se permiten números, caracteres especiales, espacios o menos de cuatro(4) letras ni más de veinticinco(25) letras'
			);
			$('#ape_profesional').focus();
			$('#ape_profesional').val('');
		}
	});

	$('#ide_profesional').change(function() {
		var input8 = document.getElementById('ide_profesional').value;
		var ValInput8 = input8.match(/^[0-9]{6,15}$/);
		if (ValInput8 == null) {
			alert(
				'No se permiten letras, caracteres especiales o menos de seis(6) digitos ni más de quince(15) digitos'
			);
			$('#ide_profesional').focus();
			$('#ide_profesional').val('');
		}
	});

	$('#matricula_profesional').change(function() {
		var input8 = document.getElementById('matricula_profesional').value;
		var ValInput8 = input8.match(/^[0-9]{4,15}$/);
		if (ValInput8 == null) {
			alert(
				'No se permiten letras, caracteres especiales o menos de cuatro(4) digitos ni más de quince(15) digitos'
			);
			$('#matricula_profesional').focus();
			$('#matricula_profesional').val('');
		}
	});

	$('#nom_responsable').change(function() {
		var input1 = document.getElementById('nom_responsable').value;
		var ValInput1 = input1.match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{4,20}$/);
		if (ValInput1 == null) {
			alert(
				'No se permiten números, caracteres especiales, espacios o menos de cuatro(4) letras ni más de veinticinco(25) letras'
			);
			$('#nom_responsable').focus();
			$('#nom_responsable').val('');
		}
	});

	$('#ape_responsable').change(function() {
		var input1 = document.getElementById('ape_responsable').value;
		var ValInput1 = input1.match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{4,20}$/);
		if (ValInput1 == null) {
			alert(
				'No se permiten números, caracteres especiales, espacios o menos de cuatro(4) letras ni más de veinticinco(25) letras'
			);
			$('#ape_responsable').focus();
			$('#ape_responsable').val('');
		}
	});

	$('#ide_profesional').change(function() {
		var input8 = document.getElementById('ide_profesional').value;
		var ValInput8 = input8.match(/^[0-9]{6,15}$/);
		if (ValInput8 == null) {
			alert(
				'No se permiten letras, caracteres especiales o menos de seis(6) digitos ni más de quince(15) digitos'
			);
			$('#ide_profesional').focus();
			$('#ide_profesional').val('');
		}
	});

	$('#tel_responsable').change(function() {
		var input8 = document.getElementById('tel_responsable').value;
		var ValInput8 = input8.match(/^[0-9]{7,10}$/);
		if (ValInput8 == null) {
			alert(
				'No se permiten letras, caracteres especiales o menos de siete(7) digitos ni más de diez(10) digitos'
			);
			$('#tel_responsable').focus();
			$('#tel_responsable').val('');
		}
	});

	// $("#email_responsable").change(function () {
	//     var input10 = document.getElementById("email_responsable").value;
	//     var ValInput10 = input10.match(
	//         /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{4,}[.][a-zA-Z0-9\.]{2,12}$/
	//     );
	//     if (ValInput10 == null) {
	//         alert("Correo no valido, por favor revise");
	//         $("#email_responsable").focus();
	//         $("#email_responsable").val("");
	//     }
	// });

	// $("#email_responsable").change(function () {
	//     var input10 = document.getElementById("email_responsable").value;
	//     var ValInput10 = input10.match(
	//         /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{4,}[.][a-zA-Z0-9\.]{2,12}$/
	//     );
	//     if (ValInput10 == null) {
	//         alert("Correo no valido, por favor revise");
	//         $("#email_responsable").focus();
	//         $("#email_responsable").val("");
	//     }
	// });

	// $("#email_confirmado").change(function () {
	//     var input10 = document.getElementById("email_confirmado").value;
	//     var ValInput10 = input10.match(
	//         /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{4,}[.][a-zA-Z0-9\.]{2,12}$/
	//     );
	//     if (ValInput10 == null) {
	//         alert("Correo no valido, por favor revise");
	//         $("#email_confirmado").focus();
	//         $("#email_confirmado").val("");
	//     }
	// });

	$('#email_confirmado').change(function() {
		var email_confirmado = document.getElementById('email_confirmado').value;
		var email = document.getElementById('email_responsable').value;

		if (email_confirmado !== email) {
			alert('Los correos  no coinciden, escribelos de nuevo');
			$('#email_confirmado').val('');
			$('#email_responsable').val('');
			$('#email_confirmado').focus();
		}
	});

	$('#dir_responsable').change(function() {
		var inputdd09 = document.getElementById('dir_responsable').value;
		var ValInputdd09 = inputdd09.match(/^[a-zA-Z0-9\-#\s]{7,120}$/);
		if (ValInputdd09 == null) {
			alert('Solo se permiten los caracteres especiales (#) (-)');
			$('#dir_responsable').focus();
			$('#dir_responsable').val('');
		}
	});

	// FILE INPUT

	$('#archivo_documento').fileinput({
		theme: 'fas',
		language: 'es',
		browseClass: 'btn btn-primary',
		browseLabel: 'Examinar',
		removeClass: 'btn btn-danger',
		allowedFileExtensions: [
			'pdf'
		],
		overwriteInitial: true,
		maxFileSize: 10000
	});

	$('#archivo_poder').fileinput({
		theme: 'fas',
		language: 'es',
		browseClass: 'btn btn-primary',
		browseLabel: 'Examinar',
		removeClass: 'btn btn-danger',
		allowedFileExtensions: [
			'pdf'
		],
		overwriteInitial: true,
		maxFileSize: 10000
	});

	$('#archivo_poder').fileinput({
		theme: 'fas',
		language: 'es',
		browseClass: 'btn btn-primary',
		browseLabel: 'Examinar',
		removeClass: 'btn btn-danger',
		allowedFileExtensions: [
			'pdf'
		],
		overwriteInitial: true,
		maxFileSize: 10000
	});

	$('#archivo_descripcion').fileinput({
		theme: 'fas',
		language: 'es',
		browseClass: 'btn btn-primary',
		browseLabel: 'Examinar',
		removeClass: 'btn btn-danger',
		allowedFileExtensions: [
			'pdf'
		],
		overwriteInitial: true,
		maxFileSize: 10000
	});

	$('#archivo_planos').fileinput({
		theme: 'fas',
		language: 'es',
		browseClass: 'btn btn-primary',
		browseLabel: 'Examinar',
		removeClass: 'btn btn-danger',
		allowedFileExtensions: [
			'pdf'
		],
		overwriteInitial: true,
		maxFileSize: 10000
	});

	// file input parqueaderos

	$('.documentos_adjuntos').fileinput({
		theme: 'fas',
		language: 'es',
		browseClass: 'btn btn-primary',
		browseLabel: 'Examinar',
		removeClass: 'btn btn-danger',
		allowedFileExtensions: [
			'pdf'
		],
		overwriteInitial: true,
		maxFileSize: 10000
	});

  

	// DATATABLES

	$('.tablas').DataTable({
		language: {
			sProcessing: 'Procesando...',
			sLengthMenu: 'Mostrar _MENU_ registros',
			sZeroRecords: 'No se encontraron resultados',
			sEmptyTable: 'Ningún dato disponible en esta tabla',
			sInfo: 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_',
			sInfoEmpty: 'Mostrando registros del 0 al 0 de un total de 0',
			sInfoFiltered: '(filtrado de un total de _MAX_ registros)',
			sInfoPostFix: '',
			sSearch: 'Buscar:',
			sUrl: '',
			sInfoThousands: ',',
			sLoadingRecords: 'Cargando...',
			oPaginate: {
				sFirst: 'Primero',
				sLast: 'Último',
				sNext: 'Siguiente',
				sPrevious: 'Anterior'
			},

			oAria: {
				sSortAscending: ': Activar para ordenar la columna de manera ascendente',
				sSortDescending: ': Activar para ordenar la columna de manera descendente'
			}
		},
		responsive: true,
		scrollX: 200,
		scrollCollapse: true
	});

	// tablas de exports
	$('.tablas_export').ready(function() {
		var radicado = $('#radicado').val();

		$('.tablas_export').DataTable({
			dom: 'Bfrtip',
			buttons: [
				{
					extend: 'pdfHtml5',
					text: '<span class="govco-icon govco-icon-attached-p size-1x text-white"></span>',
					className: 'btnpdf',
					titleAttr: 'Exportar a Pdf',
					orientation: 'landscape',
					title: 'Trazabilidad Tramite #' + radicado
				}
			],

			language: {
				sProcessing: 'Procesando...',
				sLengthMenu: 'Mostrar _MENU_ registros',
				sZeroRecords: 'No se encontraron resultados',
				sEmptyTable: 'Ningún dato disponible en esta tabla',
				sInfo: 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_',
				sInfoEmpty: 'Mostrando registros del 0 al 0 de un total de 0',
				sInfoFiltered: '(filtrado de un total de _MAX_ registros)',
				sInfoPostFix: '',
				sSearch: 'Buscar:',
				sUrl: '',
				sInfoThousands: ',',
				sLoadingRecords: 'Cargando...',
				oPaginate: {
					sFirst: 'Primero',
					sLast: 'Último',
					sNext: 'Siguiente',
					sPrevious: 'Anterior'
				},

				oAria: {
					sSortAscending: ': Activar para ordenar la columna de manera ascendente',
					sSortDescending: ': Activar para ordenar la columna de manera descendente'
				}
			},
			responsive: true,
			scrollX: 200,
			scrollCollapse: true,
			pageLength: 3
		});
	});

	// FUNCION PARA VALIDACION DE GROSERIAS

	$('#text-area').change(function() {
		var input8 = document.getElementById('text-area').value;
		const palabras = [
			'HPTA',
			'HPTS',
			'HP',
			'MIERDA',
			'IJUEPUTAS',
			'HIJOS DE PUTA',
			'HIJUEPUTAS',
			'GONORREA',
			'MALPARIOS',
			'SU PUTA',
			'MP',
			'FUCK',
			'HUEVON',
			'WEBON',
			'WEBA',
			'GARBIMBA',
			'SAPO',
			'PERRO',
			'LICHIGO',
			'VICHIRO',
			'TOCHE',
			'PINGO',
			'ZUNGA',
			'SUNGA',
			'PEGUELAGARTO',
			'BABOSO',
			'ARRASTRADO',
			'BOBO',
			'BOBALICON',
			'BAZOFIA',
			'CARE CHIMBA',
			'CARECHIMBA',
			'CAREMONDA',
			'CARE E MONDA',
			'CULIPRONTA',
			'COSCORRIA',
			'FUFA',
			'FUFURUFA',
			'FUFA',
			'SARNA',
			'GARNUPIA',
			'GONORRIENTO',
			'IDIOTA',
			'IMBECIL',
			'HUEVA',
			'WEBA',
			'GUEBA',
			'LAMBON',
			'JETON',
			'LOCA',
			'MALPARIDOS',
			'MORRONGA',
			'MARICON',
			'ÑERO',
			'MUERGANO',
			'PENDEJO',
			'PICHURRIA',
			'PIROBO',
			'PREPAGO',
			'PUTA',
			'TONTO',
			'TONTARRON',
			'ZORRA',
			'ZURIPANTA',
			'CULO',
			'TORTOLO',
			'CATRE',
			'DOBLE',
			'PEDORREO',
			'HIJO DE SU GRANDISIMA MADRE'
		];
		var groseria;

		var ValInput9 = input8.match(/^[a-zA-Z0-9\.,\s]{5,300}$/);
		if (ValInput9 == null) {
			alert('Solo se permiten los caracteres especiales (#) (-)');
			$('#text-area').focus();
			$('#text-area').val('');
		}

		for (groseria of palabras) {
			var ValInput8 = input8.indexOf(groseria);
			console.log(ValInput8);
			if (ValInput8 > -1) {
				alert('Este lenguaje NO es adecuado para escribir sugerencias');
				window.location.href = '/';
			}
		}
	});

	// FUNCION DE EXPERIENCIA BOTON FACIL

	$('.btn-facil').click(function() {
		var facil = $('#Facil').val();
		var textArea = $('#text-area').val();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: 'POST',
			url: '/inhumaciones/experiencia',
			dataType: 'json',
			data: {
				valor: facil,
				sugerencias: textArea
			},
			success: function(response) {
				console.log(response);

				if (response.success) {
					$('#Texto_sugerencias').fadeToggle();

					setTimeout(function() {
						$('#Texto_sugerencias').fadeToggle();
					}, 5000);

					$('#Facil').css('pointer-events', 'none');
					$('#Dificil').css('pointer-events', 'none');
					$('#facil').attr('disabled', true);
					$('#Dificil').attr('disabled', true);
					$('#btn-sugerencias').attr('disabled', true);
					$('#text-button').css('display', 'none');
				} else {
					alert('Ha ocurrido un error al realizar la encuesta');
				}
			},
			error: function() {
				alert('error de petición ajax');
			}
		});
	});

	// FUNCION DE EXPERIENCIA BOTON DIFICIL

	$('.btn-dificil').click(function() {
		var Dificil = $('#Dificil').val();
		var textArea = $('#text-area').val();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: 'POST',
			url: '/inhumaciones/experiencia',
			dataType: 'json',
			data: {
				valor: Dificil,
				sugerencias: textArea
			},
			success: function(response) {
				console.log(response);

				if (response.success) {
					$('#Texto_sugerencias').fadeToggle();

					setTimeout(function() {
						$('#Texto_sugerencias').fadeToggle();
					}, 5000);

					$('#Facil').css('pointer-events', 'none');
					$('#Dificil').css('pointer-events', 'none');
					$('#facil').attr('disabled', true);
					$('#Dificil').attr('disabled', true);
					$('#btn-sugerencias').attr('disabled', true);
					$('#text-button').css('display', 'none');
				} else {
					alert('Ha ocurrido un error al realizar la encuesta');
				}
			},
			error: function() {
				alert('error de petición ajax');
			}
		});
	});

	// funcion checkbox

	$('.group_check1').on('change', function() {
		$('.group_check1').not(this).prop('checked', false);
	});

	// FUNCION PARA MOSTRAS CONTRASEÑA

	$('#checkboxPassword-govco').click(function() {
		if (this.checked) {
			$('#password_ldap').attr('type', 'text');
		} else {
			$('#password_ldap').attr('type', 'password');
		}
	});

	$('.estado').change(function() {
		var estado = document.getElementById('estado').value;

		if (estado == 'PENDIENTE') {
			$('#documento_respuesta').attr('disabled', true);
			$('#documento_respuesta').attr('required', false);
		} else if (estado == 'APROBADA') {
			$('#documento_respuesta').attr('disabled', false);
			$('#documento_respuesta').attr('required', true);
		} else if (estado == 'RECHAZADA') {
			$('#documento_respuesta').attr('disabled', false);
			$('#documento_respuesta').attr('required', true);
		} else {
			$('#documento_respuesta').attr('disabled', true);
			$('#documento_respuesta').attr('required', false);
		}
		$('#observaciones_espacio').focus();
	});

	$('#myForm1').ready(function() {
		var estado_solicitud = $('#estado_sol_espacio').val();
		if (estado_solicitud == 'APROBADA' || estado_solicitud == 'RECHAZADA') {
			$('#myBtnEspacio').attr('disabled', true);
			$('#estado').attr('disabled', true);
			$('#observaciones_espacio').attr('disabled', true);
		}
	});

	// select categorizacion de parqueaderos

	$('#estado_solicitud_parqueaderos').change(function() {
		var estado = document.getElementById('estado_solicitud_parqueaderos').value;

		if (estado == 'PENDIENTE') {
			$('#documento_respuesta').attr('disabled', true);
			$('#documento_respuesta').attr('required', false);
		} else if (estado == 'APROBADA') {
			$('#documento_respuesta').attr('disabled', false);
			$('#documento_respuesta').attr('required', true);
		} else if (estado == 'RECHAZADA') {
			$('#documento_respuesta').attr('disabled', true);
			$('#documento_respuesta').attr('required', false);
		} else {
			$('#documento_respuesta').attr('disabled', true);
			$('#documento_respuesta').attr('required', false);
		}
		$('#observaciones').focus();
	});

	// parqueaderos
	$('.myFormDefault').ready(function() {
		var estado_actual = $('.estado_actual').val();

		if (estado_actual == 'ENVIADA') {
			$("#estado_solicitud_parqueaderos option[value='APROBADA']").hide();
			// $("#estado_solicitud_parqueaderos option[value='RECHAZADA']").hide();
		} else if (estado_actual == 'PENDIENTE') {
			$("#estado_solicitud_parqueaderos option[value='APROBADA']").hide();
			// $("#estado_solicitud_parqueaderos option[value='RECHAZADA']").hide();
		} else if (estado_actual == 'RESPUESTA-PLANEACION') {
			$("#estado_solicitud_parqueaderos option[value='PENDIENTE']").hide();
			$("#estado_solicitud_parqueaderos option[value='REVISION-PLANEACION']").hide();
		} else if (estado_actual == 'REVISION-PLANEACION') {
			$('#myBtn').attr('disabled', true);
			$('#estado_solicitud_parqueaderos').attr('disabled', true);
			$('#observaciones').attr('disabled', true);
		} else {
			$('#myBtn').attr('disabled', true);
			$('#estado_solicitud_parqueaderos').attr('disabled', true);
			$('#observaciones').attr('disabled', true);
		}
	});

	// FUNCION DE EXPERIENCIA GlOBAL BOTON FACIL

	$('.btn-facil-global').click(function() {
		var facil = $('#btn-facil-global').val();
		var textArea = $('#text-area').val();
		var modulo = $('.modulo').val();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: 'POST',
			url: '/experiencia/tramites',
			dataType: 'json',
			data: {
				valor: facil,
				sugerencias: textArea,
				tramite: modulo
			},
			success: function(response) {
				// console.log(response);

				if (response.success) {
					$('#Texto_sugerencias').fadeToggle();

					setTimeout(function() {
						$('#Texto_sugerencias').fadeToggle();
					}, 5000);

					$('#Facil').css('pointer-events', 'none');
					$('#Dificil').css('pointer-events', 'none');
					$('#facil').attr('disabled', true);
					$('#Dificil').attr('disabled', true);
					$('#btn-sugerencias').attr('disabled', true);
					$('#text-button').css('display', 'none');
				} else {
					alert('Ha ocurrido un error al realizar la encuesta');
				}
			},
			error: function() {
				alert('error de petición ajax');
			}
		});
	});

	// FUNCION DE EXPERIENCIA BOTON DIFICIL

	$('.btn-dificil-global').click(function() {
		var Dificil = $('#btn-dificil-global').val();
		var textArea = $('#text-area').val();
		var modulo = $('.modulo').val();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: 'POST',
			url: '/experiencia/tramites',
			dataType: 'json',
			data: {
				valor: Dificil,
				sugerencias: textArea,
				tramite: modulo
			},
			success: function(response) {
				// console.log(response);

				if (response.success) {
					$('#Texto_sugerencias').fadeToggle();

					setTimeout(function() {
						$('#Texto_sugerencias').fadeToggle();
					}, 5000);

					$('#Facil').css('pointer-events', 'none');
					$('#Dificil').css('pointer-events', 'none');
					$('#facil').attr('disabled', true);
					$('#Dificil').attr('disabled', true);
					$('#btn-sugerencias').attr('disabled', true);
					$('#text-button').css('display', 'none');
				} else {
					alert('Ha ocurrido un error al realizar la encuesta');
				}
			},
			error: function() {
				alert('error de petición ajax');
			}
		});
	});

	// scripts para eventos publicos

	$('#tipo_persona').change(function() {
		var tipo = $(this).val();
		if (tipo == 1) {
			$('.caja_razon').addClass('d-none');
			$('.caja_nombres').removeClass('d-none');
			$('#nom_responsable').attr('required', true);
			$('#ape_responsable').attr('required', true);
			$('#razon_responsable').attr('required', false);
			$('#razon_responsable').val('');
		} else {
			$('.caja_razon').removeClass('d-none');
			$('.caja_nombres').addClass('d-none');
			$('#nom_responsable').attr('required', false);
			$('#ape_responsable').attr('required', false);
			$('#nom_responsable').val('');
			$('#ape_responsable').val('');
			$('#razon_responsable').attr('required', true);
		}
	});

	//modal 1
	$('#btnDireccionEventos').click(function() {
		var direccion = $('#DD000').val();
		$('#ModalDireccionesEventos').modal('hide');
		$('#dir_responsable_sol').val('');
		$('#dir_responsable_sol').val(direccion);
	});

	// modal 2
	$('#btnModalUbicacionEvento').click(function() {
		var direccion_evento = $('#DD0000').val();
		$('#ModalUbicacion').modal('hide');
		$('#ubicacion_evento').val('');
		$('#ubicacion_evento').val(direccion_evento);
	});

	jQuery(function($) {
		$('#fecha_evento').ready(function() {
			var date = moment().add(15, 'days').format('YYYY-MM-DD');
			//  $('#fecha_evento').val(date);
			$('#fecha_evento').attr('min', date);
		});

		//   $('#fecha_evento').change(function () {

		//    var date = moment($(this).val());
		//    if(date.isoWeekday() == 7 || date.isoWeekday() == 6){
		//        alert("Atención solo se pueden seleccionar dias habiles");
		//        $('#fecha_evento').val('');

		//        return;
		//    }
		// });

		$('.clockpicker').clockpicker({
			placement: 'top',
			align: 'left',
			twelvehour: true,
			donetext: 'Aceptar'
		});
	});

	$('.barrios').select2({
		width: '100%',
		placeholder: 'Seleccione Barrio..'
	});

	$('#estado_solicitud_eventos').change(function() {
		var estado = document.getElementById('estado_solicitud_eventos').value;

		if (estado == 'PENDIENTE') {
			$('#documento_respuesta_eventos').attr('disabled', true);
			$('#documento_respuesta_eventos').attr('required', false);
		} else if (estado == 'APROBADA') {
			$('#documento_respuesta_eventos').attr('disabled', false);
			$('#documento_respuesta_eventos').attr('required', true);
		} else if (estado == 'RECHAZADA') {
			$('#documento_respuesta_eventos').attr('disabled', true);
			$('#documento_respuesta_eventos').attr('required', false);
		} else {
			$('#documento_respuesta_eventos').attr('disabled', true);
			$('#documento_respuesta_eventos').attr('required', false);
		}
		$('#observaciones_eventos').focus();
	});

	$('#myForm_eventos').ready(function() {
		var estado_solicitud = $('.estado_actual').val();
		if (estado_solicitud == 'APROBADA' || estado_solicitud == 'RECHAZADA') {
			$('#myBtn_eventos').attr('disabled', true);
			$('#estado_solicitud_eventos').attr('disabled', true);
			$('#observaciones_eventos').attr('disabled', true);
		}
	});

	$('#cant_personas').change(function() {
		var cantidad = $(this).val();
		if (parseInt(cantidad) <= 50) {
			$('#adj_conceptoCMGRD_arch').attr('required', false);
			$('#adj_certificadoBomberos_arch').attr('required', false);
			$('#adj_hospitalaria_arch').attr('required', false);
			$('.caja-cmgrd').addClass('d-none');
		} else if (parseInt(cantidad) > 50) {
			$('#adj_conceptoCMGRD_arch').attr('required', true);
			$('#adj_certificadoBomberos_arch').attr('required', true);
			$('#adj_hospitalaria_arch').attr('required', false);
			$('.caja-cmgrd').removeClass('d-none');
		}
	});

	$('#pub_ext').change(function() {
		var publicidad = $(this).val();
		if (publicidad == 'SI') {
			$('#adj_publicidad_arch').attr('required', true);
			$('.caja_publicidad').removeClass('d-none');
		} else if (publicidad == 'NO') {
			$('#adj_publicidad_arch').attr('required', false);
			$('.caja_publicidad').addClass('d-none');
		}
	});

	$('#reproduccion_musica').change(function() {
		var publicidad = $(this).val();
		if (publicidad == 'SI') {
			$('#adj_derAutor_arch').attr('required', true);
			$('.caja_derechos').removeClass('d-none');
		} else if (publicidad == 'NO') {
			$('#adj_derAutor_arch').attr('required', false);
			$('.caja_derechos').addClass('d-none');
		}
	});

	// funcion para los forms ciudadanos

	// funcion general spinner de carga

	$('.form-ciudadano').submit(function(e) {
		var response = grecaptcha.getResponse();

		if (response.length == 0) {
			alert('Captcha no verificado');
			e.preventDefault();
			return;
		}
		$('.btn_enviar_solicitud').addClass('d-none');
		$('.btn_carga').removeClass('d-none');
	});
   

	//metrolinea

	$('.select_general').select2({
		width: '100%',
		placeholder: 'Seleccione..'
	});

	$('#ruta_frecuente').select2({
		placeholder: 'Seleccione..',
		width: '100%',
		multiple: 'multiple',
		tags: true,
		tokenSeparators: [
			',',
			' '
		]
	});

	$('#tipo_poblacion').change(function() {
		var tipo = $(this).val();
		if (tipo == 'ESTUDIANTE') {
			$('.caja_estudios').removeClass('d-none');
			$('#institucion_educativa').attr('required', true);
			$('.caja_discapacidad').addClass('d-none');
			$('#discapacidad').attr('required', false);
			$('.caja_certificadoEstudios').removeClass('d-none');
			$('#archivo_certificadoEstudio').attr('required', true);
		} else if (tipo == 'PERSONAS CON DISCAPACIDAD') {
			$('.caja_discapacidad').removeClass('d-none');
			$('#discapacidad').attr('required', true);
			$('.caja_estudios').addClass('d-none');
			$('#institucion_educativa').attr('required', false);
			$('.caja_certificadoEstudios').addClass('d-none');
			$('#archivo_certificadoEstudio').attr('required', false);
		} else {
			$('.caja_discapacidad').addClass('d-none');
			$('#discapacidad').attr('required', false);
			$('.caja_estudios').addClass('d-none');
			$('#institucion_educativa').attr('required', false);
			$('.caja_certificadoEstudios').addClass('d-none');
			$('#archivo_certificadoEstudio').attr('required', false);
		}
	});

	$('#fecha_nacimiento').ready(function() {
		var today = moment(new Date()).format('YYYY-MM-DD');
		$('#fecha_nacimiento').attr('max', today);
	});

	$('#fecha_nacimiento').change(function() {
		var fecha = moment($(this).val());
		var today = moment(new Date());
		var difference = today.diff(fecha, 'year');
		if (difference < 6) {
			alert('ATENCION Niños menores de 6 años no pueden ser registrados en el programa');
			window.location.href = 'https://www.bucaramanga.gov.co/';
			$('#FormMetrolinea').trigger('reset');
		} else if (difference < 18) {
			$('.caja_acudiente').removeClass('d-none');
			$('#nombre_acudiente').attr('required', true);
		} else if (difference >= 18) {
			$('.caja_acudiente').addClass('d-none');
			$('#nombre_acudiente').attr('required', false);
		}
		$('#edad').val(difference);
	});

	// barra accesibilidad
	$('.min-fontsize').click(function() {
		var fuente = $('#body').css('font-size');
		console.log(fuente);
		var fuente_suma = parseInt(fuente) - 2;
		var fuente_px = fuente_suma + 'px';
		if (fuente_suma <= 12) {
			$('*').css('font-size', '12px');
		} else {
			console.log(fuente_suma);
			$('*').css('font-size', fuente_px);
		}
	});
	$('.max-fontsize').click(function() {
		var fuente = $('#body').css('font-size');
		console.log(fuente);
		var fuente_suma = parseInt(fuente) + 2;
		var fuente_px = fuente_suma + 'px';
		if (fuente_suma >= 22) {
			$('*').css('font-size', '22px');
		} else {
			console.log(fuente_suma);
			$('*').css('font-size', fuente_px);
		}
	});

	$('.contrast-ref').click(function() {
		var clase = $('#body').attr('class');
		var color = '#3366CC';
		var color2 = 'white';

		if (clase == 'all') {
			$('#body').removeClass('all');
			$('#myForm').css('background-color', 'white');
			$('#nav-header').css('background-color', color);
			$('#nav-secondary').css('background-color', color2);
			$('.card-cabecera').attr('style', 'background-color: #3366CC!important;');
			$('.div_principal').attr('id', 'div_img');
			$('ol').attr('style', 'background-color: #FFFFFF!important;');
			$('label').attr('style', 'color: #4B4B4B!important;');
			//    $('.all button').attr('style', 'background-color:#FFFFFF!important');
		} else {
			$('#body').addClass('all');
			$('#myForm').css('background-color', 'black');
			$('#nav-header').css('background-color', 'black');
			$('#nav-secondary').css('background-color', 'black');
			$('.card-cabecera').attr('style', 'background-color: black!important;');
			$('.div_principal').attr('id', '');
			$('ol').attr('style', 'background-color: black!important;');
			$('label').attr('style', 'color: #FFFFFF!important;');
			//    $('.all button').attr('style', 'background-color:#000000!important');
		}
	});

	//publicidad exterior

	$('#modalidad').change(function() {
		var url = $(this).find(':selected').attr('data-valor');
		let vista = document.getElementById('camposAdicionales');
      let adjuntos = document.getElementById('camposAdjuntos');
      let numero_elementos = document.getElementById('numero_elementos');
      
      let scriptAdjuntos="";
      let modalidad=this;
      modalidad=modalidad.options[modalidad.selectedIndex].dataset.mod;

      switch (modalidad) {
         case "vallas":
            scriptAdjuntos=`
            <div class="col-md-6 form-group">
               <label for="adj_certificado_lyt" class="form-label">Certificado de libertad y tradición &nbsp; <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
               <div class="form-group">
                  <div class="file-loading">
                     <input class=" @error('adj_certificado_lyt') is-invalid @enderror adj_certificado_lyt" id="adj_certificado_lyt" accept="application/pdf" name="adj_certificado_lyt" type="file" 
                     data-overwrite-initial="true" required>
                     
                     @error('adj_certificado_lyt')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
            </div>
            
            <div class="col-md-6 form-group">
               <label for="adj_camara_comercio" class="form-label">Camara de Comercio &nbsp; <small style="font-size: 10px!important"><em style="font-size: 10px!important">(Mínimo  3 meses de antigüedad)</em> </small> &nbsp; y/o RUT<br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
               <div class="form-group">
                  <div class="file-loading">
                     <input class=" @error('adj_camara_comercio') is-invalid @enderror adj_camara_comercio" id="adj_camara_comercio" accept="application/pdf" name="adj_camara_comercio" type="file" data-overwrite-initial="true" required>
                     
                     @error('adj_camara_comercio')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
            </div>
            
            <div class="col-md-6 form-group">
               <label for="adj_autorizacion_propietarios" class="form-label">Autorización del propietario &nbsp; <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
               <div class="form-group">
                  <div class="file-loading">
                     <input class=" @error('adj_autorizacion_propietarios') is-invalid @enderror adj_autorizacion_propietarios" id="adj_autorizacion_propietarios" accept="application/pdf" name="adj_autorizacion_propietarios" type="file" data-overwrite-initial="true" required>
                     
                     @error('adj_autorizacion_propietarios')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
            </div>

            <div class="col-md-6 form-group">
               <label for="adj_fotomontaje" class="form-label">Fotomontaje o plano digitalizado &nbsp; <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
               <div class="form-group">
                  <div class="file-loading">
                     <input class=" @error('adj_fotomontaje') is-invalid @enderror adj_fotomontaje" id="adj_fotomontaje" accept="application/pdf" name="adj_fotomontaje" type="file" data-overwrite-initial="true" required>
                     
                     @error('adj_fotomontaje')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
            </div>
            `;
            adjuntos.innerHTML = scriptAdjuntos;
            
            $('.adj_certificado_lyt').fileinput({
               theme: 'fas',
               language: 'es',
               browseClass: 'btn btn-primary',
               browseLabel: 'Examinar',
               removeClass: 'btn btn-danger',
               allowedFileExtensions: [
                  'pdf'
               ],
               overwriteInitial: true,
               maxFileSize: 10000
            });

            $('.adj_camara_comercio').fileinput({
               theme: 'fas',
               language: 'es',
               browseClass: 'btn btn-primary',
               browseLabel: 'Examinar',
               removeClass: 'btn btn-danger',
               allowedFileExtensions: [
                  'pdf'
               ],
               overwriteInitial: true,
               maxFileSize: 10000
            }); 

            $('.adj_autorizacion_propietarios').fileinput({
               theme: 'fas',
               language: 'es',
               browseClass: 'btn btn-primary',
               browseLabel: 'Examinar',
               removeClass: 'btn btn-danger',
               allowedFileExtensions: [
                  'pdf'
               ],
               overwriteInitial: true,
               maxFileSize: 10000
            });

            $('.adj_fotomontaje').fileinput({
               theme: 'fas',
               language: 'es',
               browseClass: 'btn btn-primary',
               browseLabel: 'Examinar',
               removeClass: 'btn btn-danger',
               allowedFileExtensions: [
                  'pdf'
               ],
               overwriteInitial: true,
               maxFileSize: 10000
            });
            break;
         case 'murales':
            scriptAdjuntos=`
            <div class="col-md-6 form-group">
               <label for="adj_certificado_lyt" class="form-label">Certificado de libertad y tradición &nbsp; <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
               <div class="form-group">
                  <div class="file-loading">
                     <input class=" @error('adj_certificado_lyt') is-invalid @enderror adj_certificado_lyt" id="adj_certificado_lyt" accept="application/pdf" name="adj_certificado_lyt" type="file" 
                     data-overwrite-initial="true" required>
                     
                     @error('adj_certificado_lyt')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
            </div>
            
            <div class="col-md-6 form-group">
               <label for="adj_autorizacion_propietarios" class="form-label">Autorización del propietario &nbsp; <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
               <div class="form-group">
                  <div class="file-loading">
                     <input class=" @error('adj_autorizacion_propietarios') is-invalid @enderror adj_autorizacion_propietarios" id="adj_autorizacion_propietarios" accept="application/pdf" name="adj_autorizacion_propietarios" type="file" data-overwrite-initial="true" required>
                     
                     @error('adj_autorizacion_propietarios')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
            </div>

            <div class="col-md-6 form-group">
               <label for="adj_fotomontaje" class="form-label">Fotomontaje o plano digitalizado &nbsp; <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
               <div class="form-group">
                  <div class="file-loading">
                     <input class=" @error('adj_fotomontaje') is-invalid @enderror adj_fotomontaje" id="adj_fotomontaje" accept="application/pdf" name="adj_fotomontaje" type="file" data-overwrite-initial="true" required>
                     
                     @error('adj_fotomontaje')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
            </div>
            `;
            adjuntos.innerHTML = scriptAdjuntos;
            
            $('.adj_certificado_lyt').fileinput({
               theme: 'fas',
               language: 'es',
               browseClass: 'btn btn-primary',
               browseLabel: 'Examinar',
               removeClass: 'btn btn-danger',
               allowedFileExtensions: [
                  'pdf'
               ],
               overwriteInitial: true,
               maxFileSize: 10000
            });

            $('.adj_autorizacion_propietarios').fileinput({
               theme: 'fas',
               language: 'es',
               browseClass: 'btn btn-primary',
               browseLabel: 'Examinar',
               removeClass: 'btn btn-danger',
               allowedFileExtensions: [
                  'pdf'
               ],
               overwriteInitial: true,
               maxFileSize: 10000
            });

            $('.adj_fotomontaje').fileinput({
               theme: 'fas',
               language: 'es',
               browseClass: 'btn btn-primary',
               browseLabel: 'Examinar',
               removeClass: 'btn btn-danger',
               allowedFileExtensions: [
                  'pdf'
               ],
               overwriteInitial: true,
               maxFileSize: 10000
            });
            break;
         case 'pasacalles':
               scriptAdjuntos=`
               <div class="col-md-6 form-group">
                  <label for="adj_RUT" class="form-label">RUT &nbsp; <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
                  <div class="form-group">
                     <div class="file-loading">
                        <input class=" @error('adj_RUT') is-invalid @enderror adj_RUT" id="adj_RUT" accept="application/pdf" name="adj_RUT" type="file" data-overwrite-initial="true" required>
                        
                        @error('adj_RUT')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
               </div>
               
               <div class="col-md-6 form-group">
                  <label for="adj_fotomontaje" class="form-label">Fotomontaje o plano digitalizado &nbsp; <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
                  <div class="form-group">
                     <div class="file-loading">
                        <input class=" @error('adj_fotomontaje') is-invalid @enderror adj_fotomontaje" id="adj_fotomontaje" accept="application/pdf" name="adj_fotomontaje" type="file" data-overwrite-initial="true" required>
                        
                        @error('adj_fotomontaje')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
               </div>
               `;
               adjuntos.innerHTML = scriptAdjuntos;
               
               $('.adj_RUT').fileinput({
                  theme: 'fas',
                  language: 'es',
                  browseClass: 'btn btn-primary',
                  browseLabel: 'Examinar',
                  removeClass: 'btn btn-danger',
                  allowedFileExtensions: [
                     'pdf'
                  ],
                  overwriteInitial: true,
                  maxFileSize: 10000
               });
   
               $('.adj_fotomontaje').fileinput({
                  theme: 'fas',
                  language: 'es',
                  browseClass: 'btn btn-primary',
                  browseLabel: 'Examinar',
                  removeClass: 'btn btn-danger',
                  allowedFileExtensions: [
                     'pdf'
                  ],
                  overwriteInitial: true,
                  maxFileSize: 10000
               });
            break;
         case 'aerea':
               scriptAdjuntos=`
               <div class="col-md-6 form-group">
                  <label for="adj_camara_comercio" class="form-label">Camara de Comercio &nbsp; <small style="font-size: 10px!important"><em style="font-size: 10px!important">(Mínimo  3 meses de antigüedad)</em> </small> &nbsp; y/o RUT<br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
                  <div class="form-group">
                     <div class="file-loading">
                        <input class=" @error('adj_camara_comercio') is-invalid @enderror adj_camara_comercio" id="adj_camara_comercio" accept="application/pdf" name="adj_camara_comercio" type="file" data-overwrite-initial="true" required>
                        
                        @error('adj_camara_comercio')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
               </div>
               
               <div class="col-md-6 form-group">
                  <label for="adj_fotomontaje" class="form-label">Fotomontaje o plano digitalizado &nbsp; <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
                  <div class="form-group">
                     <div class="file-loading">
                        <input class=" @error('adj_fotomontaje') is-invalid @enderror adj_fotomontaje" id="adj_fotomontaje" accept="application/pdf" name="adj_fotomontaje" type="file" data-overwrite-initial="true" required>
                        
                        @error('adj_fotomontaje')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
               </div>
               `;
               adjuntos.innerHTML = scriptAdjuntos;
               
               $('.adj_camara_comercio').fileinput({
                  theme: 'fas',
                  language: 'es',
                  browseClass: 'btn btn-primary',
                  browseLabel: 'Examinar',
                  removeClass: 'btn btn-danger',
                  allowedFileExtensions: [
                     'pdf'
                  ],
                  overwriteInitial: true,
                  maxFileSize: 10000
               });
   
               $('.adj_fotomontaje').fileinput({
                  theme: 'fas',
                  language: 'es',
                  browseClass: 'btn btn-primary',
                  browseLabel: 'Examinar',
                  removeClass: 'btn btn-danger',
                  allowedFileExtensions: [
                     'pdf'
                  ],
                  overwriteInitial: true,
                  maxFileSize: 10000
               });
            break;
         case 'avisos':
            scriptAdjuntos=`
            <div class="col-md-6 form-group">
               <label for="adj_camara_comercio" class="form-label">Camara de Comercio &nbsp; <small style="font-size: 10px!important"><em style="font-size: 10px!important">(Mínimo  3 meses de antigüedad)</em> </small> &nbsp; y/o RUT<br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
               <div class="form-group">
                  <div class="file-loading">
                     <input class=" @error('adj_camara_comercio') is-invalid @enderror adj_camara_comercio" id="adj_camara_comercio" accept="application/pdf" name="adj_camara_comercio" type="file" data-overwrite-initial="true" required>
                     
                     @error('adj_camara_comercio')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
            </div>
            
            <div class="col-md-6 form-group">
               <label for="adj_fotomontaje" class="form-label">Fotomontaje o plano digitalizado &nbsp; <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
               <div class="form-group">
                  <div class="file-loading">
                     <input class=" @error('adj_fotomontaje') is-invalid @enderror adj_fotomontaje" id="adj_fotomontaje" accept="application/pdf" name="adj_fotomontaje" type="file" data-overwrite-initial="true" required>
                     
                     @error('adj_fotomontaje')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
            </div>

            <div class="col-md-6 form-group">
               <label for="adj_licencia_construccion" class="form-label">Licencia de construcción &nbsp; <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
               <div class="form-group">
                  <div class="file-loading">
                     <input class=" @error('adj_licencia_construccion') is-invalid @enderror adj_licencia_construccion" id="adj_licencia_construccion" accept="application/pdf" name="adj_licencia_construccion" type="file" data-overwrite-initial="true" required>
                     
                     @error('adj_licencia_construccion')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
            </div>
            `;
            adjuntos.innerHTML = scriptAdjuntos;
            
            $('.adj_camara_comercio').fileinput({
               theme: 'fas',
               language: 'es',
               browseClass: 'btn btn-primary',
               browseLabel: 'Examinar',
               removeClass: 'btn btn-danger',
               allowedFileExtensions: [
                  'pdf'
               ],
               overwriteInitial: true,
               maxFileSize: 10000
            });

            $('.adj_fotomontaje').fileinput({
               theme: 'fas',
               language: 'es',
               browseClass: 'btn btn-primary',
               browseLabel: 'Examinar',
               removeClass: 'btn btn-danger',
               allowedFileExtensions: [
                  'pdf'
               ],
               overwriteInitial: true,
               maxFileSize: 10000
            });

            $('.adj_licencia_construccion').fileinput({
               theme: 'fas',
               language: 'es',
               browseClass: 'btn btn-primary',
               browseLabel: 'Examinar',
               removeClass: 'btn btn-danger',
               allowedFileExtensions: [
                  'pdf'
               ],
               overwriteInitial: true,
               maxFileSize: 10000
            });
            
            break;
         case 'movil':
            scriptAdjuntos=`
                  <div class="col-md-6 form-group">
                  <label for="adj_camara_comercio" class="form-label">Camara de Comercio &nbsp; <small style="font-size: 10px!important"><em style="font-size: 10px!important">(Mínimo  3 meses de antigüedad)</em> </small> &nbsp; y/o RUT<br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
                  <div class="form-group">
                     <div class="file-loading">
                        <input class=" @error('adj_camara_comercio') is-invalid @enderror adj_camara_comercio" id="adj_camara_comercio" accept="application/pdf" name="adj_camara_comercio" type="file" data-overwrite-initial="true" required>
                        
                        @error('adj_camara_comercio')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                           </span>
                        @enderror
                        </div>
                     </div>
                  </div>
               
                  <div class="col-md-6 form-group">
                     <label for="adj_fotomontaje" class="form-label">Fotomontaje o plano digitalizado &nbsp; <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
                     <div class="form-group">
                        <div class="file-loading">
                           <input class=" @error('adj_fotomontaje') is-invalid @enderror adj_fotomontaje" id="adj_fotomontaje" accept="application/pdf" name="adj_fotomontaje" type="file" data-overwrite-initial="true" required>
                           
                           @error('adj_fotomontaje')
                           <span class="invalid-feedback" role="alert">
                              <strong class="text-danger">{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>
                  </div>

                  <div class="col-md-6 form-group">
                     <label for="adj_tarjeta_propiedad" class="form-label">Tarjeta de propiedad del vehículo. &nbsp; <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
                     <div class="form-group">
                        <div class="file-loading">
                           <input class=" @error('adj_tarjeta_propiedad') is-invalid @enderror adj_tarjeta_propiedad" id="adj_tarjeta_propiedad" accept="application/pdf" name="adj_tarjeta_propiedad" type="file" data-overwrite-initial="true" required>
                           
                           @error('adj_tarjeta_propiedad')
                           <span class="invalid-feedback" role="alert">
                              <strong class="text-danger">{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>
                  </div>
            `;
            adjuntos.innerHTML = scriptAdjuntos;

            $('.adj_camara_comercio').fileinput({
               theme: 'fas',
               language: 'es',
               browseClass: 'btn btn-primary',
               browseLabel: 'Examinar',
               removeClass: 'btn btn-danger',
               allowedFileExtensions: [
                  'pdf'
               ],
               overwriteInitial: true,
               maxFileSize: 10000
            });

            $('.adj_fotomontaje').fileinput({
               theme: 'fas',
               language: 'es',
               browseClass: 'btn btn-primary',
               browseLabel: 'Examinar',
               removeClass: 'btn btn-danger',
               allowedFileExtensions: [
                  'pdf'
               ],
               overwriteInitial: true,
               maxFileSize: 10000
            });

            $('.adj_tarjeta_propiedad').fileinput({
               theme: 'fas',
               language: 'es',
               browseClass: 'btn btn-primary',
               browseLabel: 'Examinar',
               removeClass: 'btn btn-danger',
               allowedFileExtensions: [
                  'pdf'
               ],
               overwriteInitial: true,
               maxFileSize: 10000
            });
            break;
         default:
            break;
      }

      if(url!='SIN RUTA'){
         $.ajax({
            type: 'GET',
            url: url,
            success: function(data) {
               vista.innerHTML = data;
               $('#sub_modalidad').change(function() {
                  let subModalidad=$(this).val();
                  let divInmobiliarios=document.getElementsByClassName('divInmobiliarios');
                  switch (subModalidad) { 
                     case 'AVISOS DE IDENTIFICACION DE PROYECTOS INMOBILIARIOS':
                        divInmobiliarios[0].classList.remove('d-none');
                        divInmobiliarios[1].classList.remove('d-none');

                     break;
                     case 'AVISOS TIPO COLOMBINA':
                        divInmobiliarios[0].classList.add('d-none');
                        divInmobiliarios[1].classList.add('d-none');

                     break;

                     case 'AVISOS DE IDENTIFICACION DE ESTABLECIMIENTOS':
                        divInmobiliarios[0].classList.remove('d-none');
                        divInmobiliarios[1].classList.remove('d-none');

                     break;
                  }  
               });
            }
         });
      }else{
         vista.innerHTML = '';
      }
      
      if(numero_elementos.value!=0 || numero_elementos.value!="")
      {
         let modalidad=document.getElementById('modalidad');
         modalidad=modalidad.options[modalidad.selectedIndex].dataset.mod;
         switch (modalidad) {
            case 'movil':
                             
               for (var i = 0; i <numero_elementos.value; i++) {
                  console.log(i);
               }
               return;
               scriptVehiculos=`
                  <div class="col-md-4 form-group">
                     <label for="alto_vehiculo" class="form-label">Alto de la publicidad en vehículo<code>*</code>
                     </label>
                     <input type="number" value="{{ old('alto_vehiculo') }}" class="form-control  @error('alto_vehiculo') is-invalid @enderror" name="alto_vehiculo" id="alto_vehiculo" required>
                  
                     @error('alto_vehiculo')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               
                  <div class="col-md-4 form-group">
                     <label for="ancho_vehiculo" class="form-label">Ancho de la publicidad en vehículo <code>*</code>
                     </label>
                     <input type="number" value="{{ old('ancho_vehiculo') }}" class="form-control  @error('ancho_vehiculo') is-invalid @enderror" name="ancho_vehiculo" id="ancho_vehiculo" required>
                  
                     @error('ancho_vehiculo')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  
                  <div class="col-md-12 form-group">
                     <label for="observacion_vehiculo" class="form-label">Observacion de la publicidad del vehículo</label>
                     <textarea name="observacion_vehiculo" class="form-control" rows="5" placeholder="Digita las observaciones" id="observacion_vehiculo" maxlength="300"></textarea>
                  
                     @error('observacion_vehiculo')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               
                  <div class="col-md-4 form-group">
                     <label for="tipo_vehiculo" class="form-label">Tipo de vehículo <code>*</code>
                     </label>
                     <input type="number" value="{{ old('tipo_vehiculo') }}" class="form-control  @error('tipo_vehiculo') is-invalid @enderror" name="tipo_vehiculo" id="tipo_vehiculo" required>
                  
                     @error('tipo_vehiculo')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  
                  <div class="col-md-4 form-group">
                     <label for="placa_vehiculo" class="form-label">Placas del vehículo <code>*</code>
                     </label>
                     <input type="number" value="{{ old('placa_vehiculo') }}" class="form-control  @error('placa_vehiculo') is-invalid @enderror" name="placa_vehiculo" id="placa_vehiculo" required>
                  
                     @error('placa_vehiculo')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               `;
               vehiculos.innerHTML = scriptVehiculos;
               break;
            default:
               break;
         }
      }else{
         console.log('no pasa');
      }
	});

   $('#numero_elementos').change(function() {
      let modalidad=document.getElementById('modalidad');
      modalidad=modalidad.options[modalidad.selectedIndex].dataset.mod;

      if(numero_elementos.value!=0 || numero_elementos.value!="")
      {
         switch (modalidad) {
            case 'movil':
               
            
               break;
            default:
               break;
         }
      }else{
         console.log(numero_elementos);
      }
   });
   
 
  

   // parqueadero modal 1
	$('#btnDireccionAviso').click(function() {
		var direccion = $('#DD000').val();
		$('#ModalDireccionesAviso').modal('hide');
		$('#ubicacion_aviso').val('');
		$('#ubicacion_aviso').val(direccion);
	});


	// SCRITPS ESPECTACULOS

	 // ESPECTACULOS Publicos
    $("#tipo_persona_espec").change(function () {
        var tipo = $(this).val();
        if (tipo == "N") {
            $(".caja_razon").addClass("d-none");
            $(".caja_nombres").removeClass("d-none");
            $("#nom_solicitante").attr("required", true);
            $("#ape_solicitante").attr("required", true);
            $("#razon_social").attr("required", false);
            $("#razon_social").val("");
            $('#tipo_identificacion option[value="C.C."]').attr(
                "selected",
                true
            );
        } else {
            $(".caja_razon").removeClass("d-none");
            $(".caja_nombres").addClass("d-none");
            $("#nom_solicitante").attr("required", false);
            $("#ape_solicitante").attr("required", false);
            $("#nom_solicitante").val("");
            $("#ape_solicitante").val("");
            $("#razon_social").attr("required", true);
            $('#tipo_identificacion option[value="NIT"]').attr(
                "selected",
                true
            );
        }
    });

    $("#id_evento").change(function () {
        var tipo_evento = $(this).val();
        console.log(tipo_evento);
        if (tipo_evento == 2) {
            $(".caja-fecha-fin").removeClass("d-none");
            $("#fecha_fin_evento").attr("required", true);
        } else {
            $(".caja-fecha-fin").addClass("d-none");
            $("#fecha_fin_evento").attr("required", false);
        }
    });

    $(".form-ciudadano-espectaculos").submit(function (e) {
        e.preventDefault();
        var response = grecaptcha.getResponse();
        if (response.length == 0) {
            Swal.fire("Captcha no verificado");
            return;
        }

        form = new FormData($(".form-ciudadano-espectaculos")[0]);

        let direccion_notificacion = document.getElementById("direccion_solicitante").value;
        let lugar_evento = document.getElementById("direccion_empresa").value;
        var archivo_rut = $("#archivo_rut")[0].files;
        var archivo_camara = $("#archivo_camara")[0].files;
        var archivo_boleteria = $("#archivo_boleteria")[0].files;
        var archivo_copia_cedula = $("#archivo_copia_cedula")[0].files;
        var archivo_solicitud = $("#archivo_solicitud")[0].files;
        var arch_otros = $("#arch_otros")[0].files;
        if(arch_otros.length > 0){
        	arch_otros = $("#arch_otros")[0].files;
        }else{
        	arch_otros = null;
        }

        var table = document
            .getElementById("tablaBoleteria")
            .getElementsByTagName("tbody")[0]; // devuelve el tbody
        var rowLength = table.rows.length; // retorna el numero de rows

        let arr = [];
        if (rowLength == 0) {
            Swal.fire(
                "No ha agregado ningun tipo de boleteria a la tabla de boleteria."
            );
            return;
        }

        if (direccion_notificacion.length == 0) {
            Swal.fire("Debes completar el campo direccion de notificación");
            return;
        }

        if (lugar_evento.length == 0) {
            Swal.fire("Debes completar el campo ubicación del evento");
            return;
        }

        for (var i = 0; i < rowLength; i += 1) {
            var row = table.rows[i];
            arr[i] = {
                clase_boleta: row.cells[0].dataset.tb,
                valor: row.cells[1].dataset.vb,
                numero_boletas_emitidas: row.cells[2].dataset.cantidad,
            };
        }

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        form.append("archivo_rut", archivo_rut);
        form.append("archivo_camara", archivo_camara);
        form.append("archivo_boleteria", archivo_boleteria);
        form.append("archivo_copia_cedula", archivo_copia_cedula);
        form.append("archivo_solicitud", archivo_solicitud);
        form.append("arch_otros", arch_otros);
        form.append("boletas", JSON.stringify(arr));

        $.ajax({
            type: "POST",
            url: "/espectaculos-publicos/store",
            data: form,
            contentType: false,
            cache: false,
            processData: false,

            beforeSend: function () {
                $("#loadMe").modal({
                    backdrop: "static", //remove ability to close modal with click
                    keyboard: false, //remove option to close with keyboard
                    show: true, //Display loader!
                });
            },

            success: function (response) {
                if (response.success) {
                    $('#loadMe').modal('hide');
                    $(".form-ciudadano-espectaculos")[0].reset();
                    window.location.href = '/espectaculos-publicos/confirmacion'
                    
                } else if (response.validaciones) {
                    $('#loadMe').modal('hide');
                    Swal.fire({
                        icon: "error",
                        title: "Atencion!",
                        text: response.validaciones,
                        timer: 5000,
                    });
                    $(".form-ciudadano-espectaculos")[0].reset();
                } else {
                    $('#loadMe').modal('hide');
                    printErrorMsg(response.error);
                }
            },
            error: function () {
                alert("error al realizar la solicitud, por favor vuelva intentarlo mas tarde");
                // window.location.href = '/';
            },
        }).done(function(){
            $('#loadMe').modal('hide');
        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html("");
            $(".print-error-msg").css("display", "block");
            $.each(msg, function (key, value) {
                $(".print-error-msg")
                    .find("ul")
                    .append("<li>" + value + "</li>");
            });
            var href = $("#a-top").attr("href");
            window.location.href = href;
        }
    });

    $("#fecha_inicio_evento").ready(function () {
        var today = moment(new Date()).format("YYYY-MM-DD");
        $("#fecha_inicio_evento").attr("min", today);
        $("#fecha_fin_evento").attr("min", today);
    });

    $("#fecha_fin_evento").change(function () {
        var fecha_inicio = $("#fecha_inicio_evento").val();
        var fecha_final = $("#fecha_fin_evento").val();

        if (fecha_final < fecha_inicio) {
            Swal.fire(
                "La fecha final no puede ser menor a la fecha inicial del evento"
            );
            $("#fecha_fin_evento").val("");
        }
    });

    $('.valor_boleteria').ready(function (){
        $('.valor_boleteria').each(function () {
            var input = $(this).text();
           var valor_convertido =  new Intl.NumberFormat("es-CO").format(input);          
           $(this).text('$'+valor_convertido);              
     
        });      
    });

    $('#valor_poliza').change(function (){        
        var valor = $(this).val();
        if(isNaN(valor)){
            $(this).val('');
            $('#valor_poliza_cheque').val('');
            $(this).focus();
        }else{
        var valor_convertido =  new Intl.NumberFormat("es-CO").format(valor);
        $('#valor_poliza_cheque').val(valor);
        $(this).val('$'+valor_convertido); 
        }          
    });

     $(".form-espectaculos").ready(function () {
        var estado_actual = $("#estado_espectaculos_hidden").val();
        

        if (estado_actual == "ENVIADA") {
            $("#estado_espectaculos option[value='EVENTO_REALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_APROBADO']").hide();
            // $("#estado_espectaculos option[value='EVENTO_FINALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_NO_REALIZADO']").hide();
            $("#estado_espectaculos option[value='ACTO_REVOCADO']").hide();
            $("#estado_espectaculos option[value='DEVOLUCION_GARANTIA']").hide();
             $("#estado_espectaculos option[value='EVENTO_CANCELADO']").hide();
            $("#estado_espectaculos option[value='RECHAZADA']").hide();
             $("#estado_espectaculos option[value='PAGO_REALIZADO']").hide();
        }else if(estado_actual == "DOCUMENTOS_ACTUALIZADOS" || estado_actual == "PENDIENTE"){

            $("#estado_espectaculos option[value='EVENTO_REALIZADO']").hide();
            // $("#estado_espectaculos option[value='EVENTO_APROBADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_FINALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_NO_REALIZADO']").hide();
            $("#estado_espectaculos option[value='ACTO_REVOCADO']").hide();
            $("#estado_espectaculos option[value='PAGO_REALIZADO']").hide();
               $("#estado_espectaculos option[value='RECHAZADA']").hide();
               $("#estado_espectaculos option[value='DEVOLUCION_GARANTIA']").hide();

        }else if (estado_actual == "ENTREGA_GARANTIA"){
            $("#estado_espectaculos option[value='ENTREGA_GARANTIA']").hide();
            $("#estado_espectaculos option[value='EVENTO_REALIZADO']").hide();
            // $("#estado_espectaculos option[value='EVENTO_APROBADO']").hide();
            // $("#estado_espectaculos option[value='EVENTO_FINALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_NO_REALIZADO']").hide();
            $("#estado_espectaculos option[value='ACTO_REVOCADO']").hide();
            $("#estado_espectaculos option[value='PENDIENTE']").hide();
            $("#estado_espectaculos option[value='DEVOLUCION_GARANTIA']").hide();
             $("#estado_espectaculos option[value='PAGO_REALIZADO']").hide();
              $("#estado_espectaculos option[value='RECHAZADA']").hide();

        }else if(estado_actual == "EVENTO_APROBADO"){

            $("#estado_espectaculos option[value='ENTREGA_GARANTIA']").hide();
            // $("#estado_espectaculos option[value='EVENTO_REALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_APROBADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_FINALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_NO_REALIZADO']").hide();
            $("#estado_espectaculos option[value='ACTO_REVOCADO']").hide();
            $("#estado_espectaculos option[value='PENDIENTE']").hide();
            $("#estado_espectaculos option[value='RECHAZADA']").hide();
            $("#estado_espectaculos option[value='DEVOLUCION_GARANTIA']").hide();
            $("#estado_espectaculos option[value='PAGO_REALIZADO']").hide();
             $("#estado_espectaculos option[value='EVENTO_REALIZADO']").hide();



        }else if(estado_actual == 'EVENTO_CANCELADO'){

            $("#estado_espectaculos option[value='ENTREGA_GARANTIA']").hide();
            $("#estado_espectaculos option[value='EVENTO_REALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_APROBADO']").hide();
            // $("#estado_espectaculos option[value='EVENTO_FINALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_NO_REALIZADO']").hide();
            // $("#estado_espectaculos option[value='ACTO_REVOCADO']").hide();
            $("#estado_espectaculos option[value='PENDIENTE']").hide();
            $("#estado_espectaculos option[value='RECHAZADA']").hide();
            $("#estado_espectaculos option[value='EVENTO_CANCELADO']").hide();
             $("#estado_espectaculos option[value='PAGO_REALIZADO']").hide();

        }else if(estado_actual== 'ACTO_REVOCADO'){

            $("#estado_espectaculos option[value='ENTREGA_GARANTIA']").hide();
            $("#estado_espectaculos option[value='EVENTO_REALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_APROBADO']").hide();
            // $("#estado_espectaculos option[value='EVENTO_FINALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_NO_REALIZADO']").hide();
            $("#estado_espectaculos option[value='ACTO_REVOCADO']").hide();
            $("#estado_espectaculos option[value='PENDIENTE']").hide();
            $("#estado_espectaculos option[value='RECHAZADA']").hide();
            $("#estado_espectaculos option[value='EVENTO_CANCELADO']").hide();
            // $("#estado_espectaculos option[value='DEVOLUCION_GARANTIA']").hide();
             $("#estado_espectaculos option[value='PAGO_REALIZADO']").hide();


        }else if(estado_actual== 'DEVOLUCION_GARANTIA'){

            $("#estado_espectaculos option[value='ENTREGA_GARANTIA']").hide();
            $("#estado_espectaculos option[value='EVENTO_REALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_APROBADO']").hide();
            // $("#estado_espectaculos option[value='EVENTO_FINALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_NO_REALIZADO']").hide();
            $("#estado_espectaculos option[value='ACTO_REVOCADO']").hide();
            $("#estado_espectaculos option[value='PENDIENTE']").hide();
            $("#estado_espectaculos option[value='RECHAZADA']").hide();
            $("#estado_espectaculos option[value='EVENTO_CANCELADO']").hide();
             $("#estado_espectaculos option[value='DEVOLUCION_GARANTIA']").hide();
             $("#estado_espectaculos option[value='PAGO_REALIZADO']").hide();


        }else if(estado_actual == 'EVENTO_FINALIZADO' ){

            $('#observaciones_espectaculos').attr('disabled', true);
            $('#estado_espectaculos').attr('disabled', true);
            $('#myBtnEspectaculos').attr('disabled', true);



        }else if(estado_actual== 'EVENTO_REALIZADO'){

            $("#estado_espectaculos option[value='ENTREGA_GARANTIA']").hide();
            $("#estado_espectaculos option[value='EVENTO_REALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_APROBADO']").hide();
            // $("#estado_espectaculos option[value='EVENTO_FINALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_NO_REALIZADO']").hide();
            $("#estado_espectaculos option[value='ACTO_REVOCADO']").hide();
            $("#estado_espectaculos option[value='PENDIENTE']").hide();
            $("#estado_espectaculos option[value='RECHAZADA']").hide();
            $("#estado_espectaculos option[value='EVENTO_CANCELADO']").hide();
             // $("#estado_espectaculos option[value='PAGO_REALIZADO']").hide();
             // $("#estado_espectaculos option[value='DEVOLUCION_GARANTIA']").hide();


        }else if(estado_actual== 'PAGO_REALIZADO'){

            $("#estado_espectaculos option[value='ENTREGA_GARANTIA']").hide();
            $("#estado_espectaculos option[value='EVENTO_REALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_APROBADO']").hide();
            // $("#estado_espectaculos option[value='EVENTO_FINALIZADO']").hide();
            $("#estado_espectaculos option[value='EVENTO_NO_REALIZADO']").hide();
            $("#estado_espectaculos option[value='ACTO_REVOCADO']").hide();
            $("#estado_espectaculos option[value='PENDIENTE']").hide();
            $("#estado_espectaculos option[value='RECHAZADA']").hide();
            $("#estado_espectaculos option[value='EVENTO_CANCELADO']").hide();
            $("#estado_espectaculos option[value='PAGO_REALIZADO']").hide();
             // $("#estado_espectaculos option[value='DEVOLUCION_GARANTIA']").hide();


        }
            
        
    });

    $('#estado_espectaculos').change(function(){
        var estado = $(this).val();
        if(estado =='ENTREGA_GARANTIA'){
            $('.caja-garantia').removeClass('d-none');
            $('.garantia').attr('required', true);


        }else if(estado =='EVENTO_APROBADO'){
            $('.caja-acto').removeClass('d-none');
            $('#arch_acto_administrativo').attr('required', true);


        }else if(estado =='ACTO_REVOCADO'){

            $('.caja-acto-revoca').removeClass('d-none');
            $('#arch_acto_revocatorio').attr('required', true);


        }else if(estado == 'DEVOLUCION_GARANTIA'){

            $('.caja-acta-reunion').removeClass('d-none');
            $('#arch_actReu_revocatorio').attr('required', true);

        }else{
            $('.caja-acto ').addClass('d-none');
            $('#arch_acto_administrativo').attr('required', false);
            $('.caja-garantia').addClass('d-none');
            $('.garantia').attr('required', false);
            $('.caja-acto-revoca').addClass('d-none');
            $('#arch_acto_revocatorio').attr('required', false);
            $('.caja-acta-reunion').addClass('d-none');
            $('#arch_actReu_revocatorio').attr('required', false);
        }



    });

    $('.form-espectaculos').submit(function(e) {		
			// e.preventDefault();
		// 	return;
		
		$('.btn_enviar_solicitud').addClass('d-none');
		$('.btn_carga').removeClass('d-none');
	});


    $(".tablas-espectaculos").DataTable({
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix: "",
            sSearch: "Buscar:",
            sUrl: "",
            sInfoThousands: ",",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },

            oAria: {
                sSortAscending:
                    ": Activar para ordenar la columna de manera ascendente",
                sSortDescending:
                    ": Activar para ordenar la columna de manera descendente",
            },
        },
        responsive: true,
        // scrollX: 200,
        scrollCollapse: true,
        pageLength: 3
    });

    // validacion cargue de documentos

    $('.size_documents').change(function(){

    	$(this).each(function() {
             
             var fileSize = this.files[0].size;
             //console.log(fileSize);

             if(fileSize > 5000000){

              Swal.fire("El tamaño de este archivo supera el limite permitido de 5MB");
              $(this).focus();
              $(this).val('');                          

             }  
            })                  
      });

    /// POT

    $('#barrio_pot').change(function() {

        var codigo = $(this).val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: "/planeacion/encuesta-pot/barrios",
            dataType: "json",
            data: {
                codigo: codigo,
            },
            success: function (response) {
                if (response.success) {
                    $('#comuna').val(response.respuesta.nombre);                   
                } else {
                    alert("Ha ocurrido un error al cargar las comunas");
                }
            },
            // error: function () {
            //     alert("error de petición ajax");
            // },
        });
        

    });

    $('#vereda').change(function() {

        var codigo = $(this).val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: "/planeacion/encuesta-pot/veredas",
            dataType: "json",
            data: {
                codigo: codigo,
            },
            success: function (response) {
                if (response.success) {
                    $('#corregimiento').val(response.respuesta.nombre);                   
                } else {
                    alert("Ha ocurrido un error al cargar las comunas");
                }
            },
            // error: function () {
            //     alert("error de petición ajax");
            // },
        });
        

    });

    $("#observacion_pot").keyup(function(){
        var input8 = document.getElementById("observacion_pot").value;

        const palabras = [
            "HPTA",
            "HPTS",
            "HP",
            "MIERDA",
            "IJUEPUTAS",
            "HIJOS DE PUTA",
            "HIJUEPUTAS",
            "GONORREA",
            "MALPARIOS",
            "SU PUTA",
            "MP",
            "FUCK",
            "HUEVON",
            "WEBON",
            "WEBA",
            "GARBIMBA",
            "SAPO",
            "PERRO",
            "LICHIGO",
            "VICHIRO",
            "TOCHE",
            "PINGO",
            "ZUNGA",
            "SUNGA",
            "PEGUELAGARTO",
            "BABOSO",
            "ARRASTRADO",
            "BOBO",
            "BOBALICON",
            "BAZOFIA",
            "CARE CHIMBA",
            "CARECHIMBA",
            "CAREMONDA",
            "CARE E MONDA",
            "CULIPRONTA",
            "COSCORRIA",
            "FUFA",
            "FUFURUFA",
            "FUFA",
            "SARNA",
            "GARNUPIA",
            "GONORRIENTO",
            "IDIOTA",
            "IMBECIL",
            "HUEVA",
            "WEBA",
            "GUEBA",
            "LAMBON",
            "JETON",
            "LOCA",
            "MALPARIDOS",
            "MORRONGA",
            "MARICON",
            "ÑERO",
            "MUERGANO",
            "PENDEJO",
            "PICHURRIA",
            "PIROBO",
            "PREPAGO",
            "PUTA",
            "TONTO",
            "TONTARRON",
            "ZORRA",
            "ZURIPANTA",
            "CULO",
            "TORTOLO",
            "CATRE",
            "DOBLE",
            "PEDORREO",
            "HIJO DE SU GRANDISIMA MADRE",
        ];
        var groseria;

        for (groseria of palabras) {
            var ValInput8 = input8.indexOf(groseria);
            console.log(ValInput8);
            if (ValInput8 > -1) {
                alert("Este lenguaje NO es adecuado para escribir opiniones");
                window.location.href = "https://www.bucaramanga.gov.co/pot-bga/";
                $(this).val('');
                $('.form-control').val('');
            }
        }
        
    $("#count").text("Caracateres restantes:" + (300 - $(this).val().length));
      });

     $('#tema').change(function(){
        var tema = $(this).val();
        var subtext = $('option:selected', this).attr('subtext');
        
        if(tema == ''){
            $('.caja-observacion').addClass('d-none');           
            $('#observacion_label').text('');
            $('#subtext').text('');
            $('#observacion_pot').attr('required', false);
    
        }else{

        $('.caja-observacion').removeClass('d-none');
        $('.caja-observacion').addClass('animate__backInDown');
        $('#observacion_label').text($(this).val());
        $('#subtext').text(subtext);
        $('#observacion_pot').attr('required', true);
        }




     });

     $('#documento_usuario').change(function(){
        var codigo = $(this).val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: "/planeacion/encuesta-pot/validacionDocumento",
            dataType: "json",
            data: {
                codigo: codigo,
            },
            success: function (response) {
                if (response.success) {
                    if(response.respuesta>0) {
                        Swal.fire('El numero de documento:' +codigo+ ' ya realizo una opinion del POT');
                        window.location.href = 'https://www.bucaramanga.gov.co/pot-bga/';

                    }            
                } else {
                    alert("Ha ocurrido un error al cargar las comunas");
                }
            },
            error: function () {
                alert("error de petición ajax");
            },
        });


     });

     $('.radio_bv').click(function() {
		if (this.checked) {
			if($(this).val() == 'barrio'){

				$('.caja-barrios').removeClass('d-none');
				$('#barrio_pot').attr('required', true);
				$('#vereda').attr('required', false);
				$('.caja-veredas').addClass('d-none');				
				$('#corregimiento').val('');
				$('#vereda').attr('required', true);				
				$('#vereda').val('').trigger('change');
			}else{

				$('.caja-barrios').addClass('d-none');
				$('#barrio_pot').attr('required', false);
				$('#vereda').attr('required', true);
				$('.caja-veredas').removeClass('d-none');
				$('#comuna').val('');
				$('#barrio_pot').val('').trigger('change');

			}
		} 
	});

	//AUTORIZACION DE LA CERTIFICACION DE DISCAPACIDAD

	$("#estado_solicitud_discapacidad").change(function () {
		var estado = document.getElementById("estado_solicitud_discapacidad").value;
	
		if (estado == "PENDIENTE") {
			$("#documento_respuesta").attr("disabled", true);
			$("#documento_respuesta").attr("required", false);
		} else if (estado == "APROBADA") {
			$("#documento_respuesta").attr("disabled", false);
			$("#documento_respuesta").attr("required", true);
		} else if (estado == "RECHAZADA") {
			$("#documento_respuesta").attr("disabled", true);
			$("#documento_respuesta").attr("required", false);
		} else {
			$("#documento_respuesta").attr("disabled", true);
			$("#documento_respuesta").attr("required", false);
		}
		$("#observaciones").focus();
	});
	
	// autorizacion de la certificacion de la discapacidad
	$(".myFormDefaultDiscapacidad").ready(function () {
	   
		var estado_actual = $(".estado_actual").val();
	   
	
		if (estado_actual == "ENVIADA") {
			$("#estado_solicitud_discapacidad option[value='APROBADA']").hide();
			// $("#estado_solicitud_parqueaderos option[value='RECHAZADA']").hide();
		} else if(estado_actual == "PENDIENTE") {
			$("#estado_solicitud_discapacidad option[value='APROBADA']").hide(); 
			$("#estado_solicitud_discapacidad option[value='PENDIENTE']").hide();    
			$("#estado_solicitud_discapacidad option[value='RADICADA']").hide();           
			// $("#estado_solicitud_parqueaderos option[value='RECHAZADA']").hide();
		} else if (estado_actual == "ACTUALIZADA") {        
			$("#estado_solicitud_discapacidad option[value='APROBADA']").hide();        
		} else if (estado_actual == "RADICADA") {
			$("#estado_solicitud_discapacidad option[value='PENDIENTE']").hide();
			$("#estado_solicitud_discapacidad option[value='RADICADA']").hide();  
			
		} else {
		   
			$("#btn_discapacidad").attr("disabled", true);
			$("#estado_solicitud_discapacidad").attr("disabled", true);
			$("#observaciones_discapacidad").attr("disabled", true);
		}
	});

	//validacion en tiempo real form inhumaciones
    $('.formInhuma').ready(function(){

	$.validator.addMethod("valueNotEquals", function(value, element, arg){
			return arg !== value;
		   }, "Value must not equal arg.");
	
	$("#formInhuma").validate({
		
		rules: {
		nom_solicitante : {
			required: true,			
		},
		ape_solicitante :{
			required: true,
		},
		identificacion_solicitante:{
			required: true,
		},
		email_solicitante:{
		  required: true,
		  email: true			
		},
		tipo_consulta:{
			valueNotEquals: "default",
		},
		numero_busqueda:{
			required: true,
		},		
		
		},
		highlight: function(element) {
			$(element).removeClass('is-valid').addClass('is-invalid');
		  },
		  unhighlight: function(element) {
			$(element).removeClass('is-invalid').addClass('is-valid');
		},
		messages : {
			tipo_consulta: { valueNotEquals: "Por favor selecciona un item!" },
			nom_solicitante: { required:"Campo obligatorio"},
			ape_solicitante: { required:"Campo obligatorio"},
			identificacion_solicitante: { required:"Campo obligatorio"},
			email_solicitante: { required:"Campo obligatorio"},			
			numero_busqueda: { required:"Campo obligatorio"},
		}
		  
		
	  });

	});

	$('.formInhuma').submit(function(e) {	   
        
	if($('.formInhuma').valid()){
		var response = grecaptcha.getResponse();

		if (response.length == 0) {
			alert('Captcha no verificado');
			e.preventDefault();
			return;
		}
		$('.btn_enviar_solicitud').addClass('d-none');
		$('.btn_carga').removeClass('d-none');
	}
		
	});

     function animateValue(id, start, end, duration) {

        if (start == end) return;
        var range = end - start;
        var current = start;
        var increment = end > start? 1 : -1;
        var stepTime = Math.abs(Math.floor(duration / range));
        var obj = document.getElementById(id);       
        var timer = setInterval(function() {
            current += increment;
            obj.innerHTML = current;
            if (current == end) {
                clearInterval(timer);
            }
        }, stepTime);
    }
    var final = document.getElementById('conteo').innerText; 
    animateValue("conteo", 0, final, 5000);


    

   
}); // FIN DOCUMENT READY