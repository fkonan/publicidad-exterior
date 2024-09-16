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
                                    Metrolinea
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Metrolinea</h1>
            <div class="row pt-5">
                  
               {{-- INICIO CARD  --}}
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="card govco-card animate__animated animate__fadeInUp">
                    <div class="row">
                      <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="container h-100">
                            <div class="row align-items-cente mt-2 pt-2">
                                <div class="mx-auto my-auto">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 32 32"><path fill="#0ce45f" d="m30 25l-1.414-1.414L26 26.172V18h-2v8.172l-2.586-2.586L20 25l5 5l5-5z"/><path fill="currentColor" d="M18 28H8V4h8v6a2.006 2.006 0 0 0 2 2h6v3h2v-5a.91.91 0 0 0-.3-.7l-7-7A.909.909 0 0 0 18 2H8a2.006 2.006 0 0 0-2 2v24a2.006 2.006 0 0 0 2 2h10Zm0-23.6l5.6 5.6H18Z"/></svg>                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="card-header govco-card-header">
                          <a>Información del total registros del subisidio metrolinea</a>
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
             res = await fetch('/tramites/hacienda/metrolinea/reporte'),
              json = await res.json();
              if (!res.ok) throw { status: res.status, statusText: res.statusText };
              console.log(json)
              filename = `REPORTE-METROLINEA-${fecha.toLocaleDateString()}.xlsx`;
             
               var ws = XLSX.utils.json_to_sheet(json.metrolinea);             
               var wb = XLSX.utils.book_new();
               XLSX.utils.book_append_sheet(wb, ws, "REGISTRO-METROLINEA");            
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