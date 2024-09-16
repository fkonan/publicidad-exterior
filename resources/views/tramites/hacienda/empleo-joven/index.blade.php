@extends('layouts.menu')

@section('dashboard')

    <div class="container mt-3 mb-4 m-xs-x-3">

        <div class="row pl-4">
            <div class="px-0 col-md-9">
                <nav aria-label="Miga de pan" style="max-height: 20px;">
                    <ol class="breadcrumb" style="background-color: #FFFFFF;">
                        <li class="breadcrumb-item ml-3 ml-md-0">
                            <a style="color: #004fbf;" class="breadcrumb-text" href="https://www.gov.co/home/">Inicio</a>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">Tramites en Linea</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">
                                        Hacienda</a>                                    
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                    Empleo Joven
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Empleo Joven</h1>
            <div class="row pt-5">
                  
               {{-- INICIO CARD  --}}
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="card govco-card animate__animated animate__fadeInUp">
                    <div class="row">
                      <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="container h-100">
                            <div class="row align-items-cente mt-2 pt-2">
                                <div class="mx-auto my-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 24 24"><path fill="#0ee143" d="m11 10.15l-.9-.875Q9.8 9 9.387 9.012T8.7 9.3q-.275.275-.275.7t.275.7l2.6 2.6q.275.275.7.275t.7-.275l2.625-2.625q.275-.275.263-.688T15.3 9.3q-.275-.275-.7-.288t-.7.288l-.9.85V6.975q0-.425-.288-.7T12 6q-.425 0-.713.288T11 7v3.15ZM8 17h8.025q.425 0 .7-.288T17 16q0-.425-.288-.713T16 15H7.975q-.425 0-.7.288T7 16q0 .425.288.713T8 17Zm4 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Z"/></svg>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="card-header govco-card-header">
                          <a>Informacion de empleados y empresas</a>
                        </div>
                        <div class="card-body">
                          <p>Para descargar la informacion clic <a href="" id="btn-descarga">aqui</a> </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- </ FIN CARD --}}
               {{-- INICIO CARD  --}}
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="row justify-content-center">
                  <div id="div-loader" style="display: none">
                  <img src="{{asset('img/loader.svg')}}" width="150" height="150">
                  <br>
                  <p>Generando Reporte...</p>
                  </div>
                </div>
                </div>
                
                                    
            </div>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.1/xlsx.full.min.js"></script>
         
        <script>
          let fecha = new Date();
          console.log()
              document.addEventListener('click', async e => {
          if (e.target.matches('#btn-descarga')) {
              e.preventDefault();
              
          try {
            showLoader()
             res = await fetch('/tramites/hacienda/empleo-joven/reporte'),
              json = await res.json();
              if (!res.ok) throw { status: res.status, statusText: res.statusText };
              console.log(json)
              filename = `REPORTE-EMPLEO-JOVEN-${fecha.toLocaleDateString()}.xlsx`;
             
               var ws = XLSX.utils.json_to_sheet(json.empresas_empleados);
               var ws2 = XLSX.utils.json_to_sheet(json.data_empresa);
               var wb = XLSX.utils.book_new();
               XLSX.utils.book_append_sheet(wb, ws, "EMPRESAS-EMPLEADOS");
               XLSX.utils.book_append_sheet(wb, ws2, "EMPRESAS");
               XLSX.writeFile(wb, filename);
          } catch (err) {           
            let message = err.statusText || `Ocurrió un error - ${err.status}`;
            document.getElementById('div-loader').innerHTML  = `<p class="text-danger">${message || 'Not FOUND'}</p>`
           
          }finally{
           hideLoader()
          }          
         
          }
        });
        function showLoader(){document.getElementById('div-loader').style.display="block";}
        function hideLoader(){document.getElementById('div-loader').style.display="none";}


          
        </script>



    </div>
@endsection