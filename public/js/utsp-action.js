const dt = new DataTransfer(); // Le permite manipular los archivos del archivo de entrada
let sizeFile = 0;


    $(document).ready(function(){
     
        
     

         
    
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

let $formUTSPAction = document.getElementById('formUTSPAction');
$formUTSPAction.addEventListener('submit', (e)=>{
    e.preventDefault();
    let datos = new FormData($("#formUTSPAction")[0]);
    let files = document.getElementById("attachment").files;
    
    for (var index = 0; index < files.length; index++) {
     datos.append("files"+index, document.getElementById('attachment').files[index]);
   }
    datos.append("countFiles",files.length);
   for (var pair of datos.entries()) {
    console.log(pair[0]+ ', ' + pair[1]); 
   }
   let data =Object.fromEntries(datos);
    if(data.countFiles > 0){
    sendData(datos)
  }else{
    Swal.fire({
        title: '¿Esta seguro de responder sin documentos adjuntos?',
        text: "Si no adjunta documentos en esta accion tendra que realizar otra accion para adjuntar documentos",
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
            url: "/tramites/UTSP/actionStore",
            data: datos,
            contentType: false,
            cache: false,
            processData: false,  
            beforeSend: function () {
               
            },  
            success: function (response) {
                if (response.success) {  
                  $("#formUTSPAction")[0].reset();
                  notification(response.titulo, response.message,response.icono)
                  setTimeout(()=>{
                      window.location.href = '/tramites/UTSP/loadData'
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


