const dt = new DataTransfer(); // Le permite manipular los archivos del archivo de entrada
let sizeFile = 0;


    $('.formUTSP').ready(function(){

        $("select").on("select2:close", function (e) {  
            $(this).valid(); 
        });

        $('#empresa_publica').change(function(e){
          if($(this).val()=='Otra'){
          $('#divOtherCompany').removeClass('d-none');
          $('#otra_empresa').prop('required',true);
        }else{
            $('#otra_empresa').prop('required',false);
            $('#divOtherCompany').addClass('d-none');

          }
        });
    
        $(".custom-file-input ").on('change',function(e){
          $(this).each(function(){
           if($(this).val() != ''){
            $(this).valid(); 
           }
           $(this).removeClass('is-valid');
          });
        });       
                      
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
                return arg !== value;
               }, "Value must not equal arg.");
        
        $("#formUTSP").validate({
            
            rules: {
                
            compartir_informacion : {required: true},                
            
            },
            errorPlacement: function(error, element) {
                if (element.attr("type") == "radio") {
                    error.insertBefore(element);
                }else if(element.attr("type") == "file"){
                    error.insertAfter(element.parent('.custom-file').parent('.form-group'));                    
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element) {
                $(element).removeClass('is-valid').addClass('is-invalid');
              },
              unhighlight: function(element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            messages : {
                radicado: {required:"Campo Obligatorio"}, 
                funcionario: {required:"Campo Obligatorio"}, 
                fecha: {required:"Campo Obligatorio"}, 
                nombre_usuario: {required:"Campo Obligatorio"}, 
                apellido_usuario:{required: "Campo Obligatorio"},
                tipo_documento: {required:"Campo Obligatorio"}, 
                numero_documento: {required:"Campo Obligatorio"}, 
                email_responsable: {required:"Campo Obligatorio"}, 
                email_confirmado: {required:"Campo Obligatorio"}, 
                telefono: {required:"Campo Obligatorio"}, 
                correo_solicitante: {required:"Campo Obligatorio"}, 
                tel_solicitante: {required:"Campo Obligatorio"}, 
                direccion_solicitante: {required:"Campo Obligatorio"}, 
                ciudad: {required:"Campo Obligatorio"},            
                comuna: {required:"Campo Obligatorio"},            
                tipo_atencion: {required:"Campo Obligatorio"},            
                tipo_servicio: {required:"Campo Obligatorio"},            
                asunto: {required:"Campo Obligatorio"},            
                
                                            
                
                
    
            }
              
            
          });

          $('.barrioUtsp').change(function(e){
           
            let codigo = $(this).val();

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
    
            $.ajax({
                type: "POST",
                url: "/tramites/UTSP/searchComuna",
                dataType: "json",
                data: {
                    codigo: codigo,
                },
                success: function (response) {
                    if (response.success) {
                        $('#comuna').val(response.comuna);

                                    
                    } else {
                        Swal.fire({
                            title: "atencion!",
                            text: "ocurrio un error al cargar las comunas!",
                            icon: "error"
                          })  
                    }
                },
                error: function () {
                    Swal.fire({
                        title: "atencion!",
                        text: "ocurrio un error al realizar esta solicitud!",
                        icon: "error"
                      })                },
            });

          });
    
        });
 $("#attachment").on('change', function(e){ 
            let size = Math.round(this.files[0].size / 1024 / 1024 *100)/100;
           if(size > 10){
            Swal.fire({
              icon: 'error',
              iconColor: 'white',
              position: 'top-right',
              title: 'Oops...',
              text: 'Excede el tamaño maximo permitido de 10MB',
              toast:true,
              timer: 3500,
              customClass: {
                popup: 'colored-toast'
              },
              showConfirmButton: false,
              timerProgressBar: true
             
            });
            this.value = '';
            return;
           }
          
           if((size+sizeFile)>10){
            Swal.fire({
              icon: 'error',
              iconColor: 'white',
              position: 'top-right',
              title: 'Oops...',
              text: 'Excede el tamaño maximo permitido de 10MB',
              toast:true,
              timer: 3500,
              customClass: {
                popup: 'colored-toast'
              },
              showConfirmButton: false,
              timerProgressBar: true
             
            });
            this.value = '';
            return;
          
           }
          
             
              for(var i = 0; i < this.files.length; i++){
                  let fileBloc = $('<span/>', {class: 'file-block'}),
                       fileName = $('<span/>', {class: 'name', text: this.files.item(i).name+'('+ Math.round(this.files.item(i).size /1024 /1024 *100)/100+') MB'});
                     fileBloc.append(`<span class="file-delete govco-icon govco-icon-x-cn" data-size="${Math.round(this.files.item(i).size /1024 /1024 *100)/100}"><span></span></span>`)
                      .append(fileName);
                  $("#filesList > #files-names").append(fileBloc);
              //sumar
              sizeFile += Math.round(this.files.item(i).size /1024 /1024 *100)/100;
              };
          
          //   console.log('despues de la suma:' +sizeFile);
            
              //Agregar archivos al objeto DataTransfer
              for (let file of this.files) {
                  dt.items.add(file);
              }
              // Actualización de los archivos del archivo de entrada después de la adición
              this.files = dt.files;
            
              // EventListener para la eliminacion
          
                $('span.file-delete').click(function(e){
              sizeDelete = $(this).data("size");
              // console.log(sizeDelete);
                  let name = $(this).next('span.name').text();
             
              //Suprimir la visualización del nombre del archivo
                  $(this).parent().remove();
                  for(let i = 0; i < dt.items.length; i++){
                        //Coincidencia de archivo y nombre
                     
                if(name == dt.items[i].getAsFile().name+'('+ Math.round(dt.items[i].getAsFile().size /1024 /1024 *100)/100+') MB'){   
                  sizeFile -= Math.round(dt.items[i].getAsFile().size /1024 /1024 *100)/100;
                  //Eliminar archivo en el objeto DataTransfer
                          dt.items.remove(i);        
                          continue;
                      }
                  }
              
             
                  document.getElementById('attachment').files = dt.files;
              });
             
           
    });

let $formUTSP = document.getElementById('formUTSP');
$formUTSP.addEventListener('submit', (e)=>{
    e.preventDefault();
    if($('.formUTSP').valid()){
    let datos = new FormData($("#formUTSP")[0]);
    let files = document.getElementById("attachment").files;
    
    for (var index = 0; index < files.length; index++) {
     datos.append("files"+index, document.getElementById('attachment').files[index]);
   }
    datos.append("countFiles",files.length);
   for (var pair of datos.entries()) {
    //  console.log(pair[0]+ ', ' + pair[1]); 
   }
   let data =Object.fromEntries(datos);
    if(data.countFiles > 0){
    sendData(datos)
  }else{
    Swal.fire({
        title: '¿Esta seguro de responder sin documentos adjuntos?',
        text: "Si no adjunta documentos en esta accion tendra que realizar otra accion para adjuntrar documentos",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, confirmar!',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
           sendData(datos)
           
        }
    })
  }
 }
})

    function sendData(datos){ 
        // console.log(datos)
        $(document).on({
            ajaxStart: function() { 
                $("#loadMe").modal({
                    backdrop: "static", 
                    keyboard: false, 
                    show: true,
                });
                },
             ajaxStop: function() { $('#loadMe').modal('hide');  }    
        });
        $.ajax({
            type: "POST",
            url: "/tramites/UTSP/store",
            data: datos,
            contentType: false,
            cache: false,
            processData: false,  
            beforeSend: function () {
               
            },  
            success: function (response) {
                if (response.success) {  
                  $("#formUTSP")[0].reset();
                  notification(response.titulo, response.message,response.icono)
                  setTimeout(()=>{
                      window.location.href = '/tramites/UTSP/index'
                  },3000)                                     
                    
                } else {
                    $('#loadMe').modal('hide');
                    printErrorMsg(response.error);
                }
            },
            error: function () {
                alert("error de petición ajax");
            },
        }).done(function(){
            $('#loadMe').modal('hide');        
        })
    
    }

    function notification(titulo,texto,icono){
        return Swal.fire({
           title: titulo,          
           text: texto,          
           icon: icono,          
           toast:true,          
           timer: 3000,                       
           showConfirmButton: false,          
           timerProgressBar: true,          
           position: 'top-right',
     
        }); 
   }

   function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html("");
    $(".print-error-msg").css("display", "block");
    $.each(msg, function (key, value) {
        $(".print-error-msg")
            .find("ul")
            .append("<li>" + value + "</li>");
    });  
    window.scrollTo(0, 0)
   
}


