@extends('layouts.menu')

@section('dashboard')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card govco-card animate__animated animate__flipInX">
                <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-6">
                    <img class="card-img govco-card-image govco-card-image-left" src="{{asset('img/tramites_linea_1.png')}}" alt="Image Portal" />
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="card-header govco-card-header">
                      <h4>Bienvenidos al portal de tramites</h4>
                    </div>
                    <div class="card-body">
                      <p style="text-align: justify">En este portal se podra gestionar la administracion de todos los tramites de la Alcaldia de Bucaramanga, unificados en un solo sitio.</p>
                    </div>
                  </div>
                </div>
              </div>

        </div>
    </div>

</div>



@endsection