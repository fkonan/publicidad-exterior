 function dropHandler(ev, id) {
            ev.preventDefault();
            var dt = new DataTransfer();      
            var multiple = $("#" + id).attr('multiple');
      
            if (ev.dataTransfer.items) {
              if (!multiple && ev.dataTransfer.items.length > 1) {
                return;
              }
              for (var i = 0; i < ev.dataTransfer.items.length; i++) {
                dt.items.add(ev.dataTransfer.items[i].getAsFile());
              }
            } else {
              if (!multiple && ev.dataTransfer.files.length > 1) {
                return;
              }
              for (var i = 0; i < ev.dataTransfer.files.length; i++) {
                dt.items.add(ev.dataTransfer.files[i]);          
              }
            } 
            $("#" + id)[0].files = dt.files;
            console.log(dt.files);
            loadFile(id, dt.files);
          }

     function dragOverHandler(ev, id){
            ev.preventDefault();
          }

    function uploadHandler (ev, id){         
        
          // ev.preventDefault();
            // var dt = new DataTransfer(); 
            // console.log(dt);
            // var multiple = $("#" + id).attr('multiple');
      
            // if (ev.dataTransfer.items) {
            //   if (!multiple && ev.dataTransfer.items.length > 1) {
            //     return;
            //   }
            //   for (var i = 0; i < ev.dataTransfer.items.length; i++) {
            //     dt.items.add(ev.dataTransfer.items[i].getAsFile());
            //   }
            // } else {
            //   if (!multiple && ev.dataTransfer.files.length > 1) {
            //     return;
            //   }
            //   for (var i = 0; i < ev.dataTransfer.files.length; i++) {
            //     dt.items.add(ev.dataTransfer.files[i]);          
            //   }
            // } 
           var file =  $("#" + id)[0].files;
          loadFile(id, file);

         }
      
    function initInputFile(id) {      
            $("#"+ id).next().append('<span class="govco-icon govco-icon-attached-n color-attach"></span>Arrastre aquí su archivo o haga click para añadir.');
            $("#"+ id).change(id, function (event) {
              event.stopPropagation();
              var files = $(this)[0].files;
              loadFile(id, files);
              
          });
          }
   function loadFile(id, files) {   
            var multiple = $("#" + id).attr('multiple');
      
            var interval = setInterval(() => {
              var len = files.length;
              for(var i = 0; i < len; i ++) {
                var file = files[i];
                var valorKb = 0;
                var sizeInMB = (file.size / (1024*1024)).toFixed(2);
                console.log(file.type)
                if(file.type != 'application/pdf'){
                  Swal.fire({
                    icon: 'error',
                    iconColor: 'white',
                    position: 'top-right',
                    title: 'Oops...',
                    text: 'Solo se permiten archivos .PDF',
                    toast:true,
                    timer: 2500,
                    customClass: {
                      popup: 'colored-toast'
                    },
                    showConfirmButton: false,
                    timerProgressBar: true
                   
                  });
                  var label ="Arrastre aquí su archivo o haga click para añadir.";                  
                  clearFile(0,id,label);
                  clearInterval(interval) 
                  return;

                }
                
                
                if(parseInt(sizeInMB) > 10){
                  
                  Swal.fire({
                    icon: 'error',
                    iconColor: 'white',
                    position: 'top-right',
                    title: 'Oops...',
                    text: 'El documento supera el peso maximo de 10MB!',
                    toast:true,
                    timer: 2500,
                    customClass: {
                      popup: 'colored-toast'
                    },
                    showConfirmButton: false,
                    timerProgressBar: true
                   
                  });
                  var label ="Arrastre aquí su archivo o haga click para añadir.";                  
                  clearFile(0,id,label);
                  clearInterval(interval) 
                  return;
                  
                }
                if (file) {
                    valorKb = parseInt(file.size / 1024, 10);
                }
                
                file.isValid = true;
                file.url = objectURL = URL.createObjectURL(file);
                file.uuid = uuidv4();
                if (file.name !== '') {
                  if (!multiple) {                
                    $("#" + id)
                        .attr("hidden", true)                        
                        .siblings(".custom-file-label").addClass('hide').removeClass('loaded')
                        .after('<div class="tag-govco tag-negative fileItem-'+file.uuid+'">'+  file.name + ' (' + valorKb + ' kb) </span>' +
                            '<a onclick="clearFile('+ i +',\''+ id + '\'' + ', \'Arrastre aquí su archivo o haga click para añadir.\')" class="clear-files-govco"><span class="govco-icon govco-icon-x-cn"></span></a></div>' + 
                            '<a class="fileItem-'+file.uuid+'" onclick ="window.open(\''+ file.url +'\')" <span class="govco-icon govco-icon-x-cn"></span></a>');
                  } else {
                    $("#" + id).parent().after(
                      '<div class="tag-govco tag-negative fileItem-'+file.uuid+'">'+  file.name + ' (' + valorKb + ' kb) </span>' +
                      '<a onclick="clearFile('+ i +',\''+ id + '\'' + ', \'Arrastre aquí su archivo o haga click para añadir.\')" class="clear-files-govco"><span class="govco-icon govco-icon-x-cn"></span></a></div>' + 
                      '<a class="fileItem-'+file.uuid+'" onclick ="window.open(\''+ file.url +'\')" <span class="govco-icon govco-icon-x-cn"></span></a>'
                    );
                  }
                }
              }
              if (multiple) {
                $("#" + id).siblings(".custom-file-label").removeClass('loaded')
                $("#spinner-loader-file").remove();
                $("#"+ id).next().append('<span class="govco-icon govco-icon-attached-n color-attach"></span>Arrastre aquÃ­ su(s) archivo(s) o haga click para aÃ±adir.');            
              }
              clearInterval(interval)
            }, 2000);
      
            $("#" + id)
              .siblings(".custom-file-label")
              .text('')
              .addClass('loaded')
              .append('<span id="spinner-loader-file"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>Subiendo archivo(s)</span>')
              
          }
     function clearFile(deleteIndex, id, label) {
            var filesDeleted = 0;
            var files = document.getElementById(id);
            var fileToDelete = files.files[deleteIndex];
            fileToDelete.isValid = false;
            for(var i = 0; i < files.files.length; i ++) {
              var file = files.files.item(i);
              if(!file.isValid){
                filesDeleted ++;
                $('div').remove('.fileItem-'+file.uuid);
              }
            }
            if(filesDeleted === files.files.length) {
              files.value = "";
              $('#'+ id)
                  .removeAttr("hidden")
                  .removeAttr("disabled");
              $('#'+ id)
                  .siblings(".custom-file-label")
                  .removeClass("hide")
                  .removeClass('loaded')
                  .html('<span class="govco-icon govco-icon-attached-n color-attach"></span>' + label);
            }

     }

     function clear(id){
     alert('asdasd')
      document.getElementById(id).value = "";
       var label ="Arrastre aquí su archivo o haga click para añadir.";
      $('#'+ id)
      .removeAttr("hidden")
      .removeAttr("disabled");
     $('#'+ id)
      .siblings(".custom-file-label")
      .removeClass("hide")
      .html('<span class="govco-icon govco-icon-attached-n color-attach"></span>' + label);
      return;

     }

     function uuidv4() {
      return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
      });
    }
      