@extends('layouts.app')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<h1>HOLA PRUEBAS</h1>


<form method="post" action="" role="form" id="myformEspec">
  
    <input type="text" name="name" id="name" class="form-control" placeholder="nombre" required>
    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="apellido" required>
    <input type="number" name="number" id="number" class="form-control" placeholder="numero "required>
    <button style="font-size:15px;" id="btn-espec" type="submit" class="btn btn-primary" onclick="return confirm('¿Esta seguro de realizar esta solicitud ?')">Enviar Solicitud</button>



</form>




@endsection