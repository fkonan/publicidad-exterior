
<style>
 .clockpicker-button {
		background-color: #3366CC !important;
		color: white !important;
	}
	table{
		border-collapse: collapse;
		width:100%;
		margin-bottom:24px;
	}
	td{
		
	
	}
	
</style>

    
   
       <p> <strong>Estimado {{$Cs->PerNombre}}</strong>,</p>
     
		  <p> 
		  Notificamos que se ha registrado una novedad, para el proceso de area de cesion del predio ubicado en <strong>{{$Cs->PredioDir}} </strong>,
		  radicado con el numero<strong> {{$Cs->Radicado}}</strong>.<br>
		  Tipo de novedad: <strong>{{$Cs->NovedadTipo}}</strong><br>
		  Comentarios:<strong>{{$Cs->Comentario}}</strong><br>
		  Estado: <strong>{{$Cs->NovedadEstado}}</strong>
		  </p>
	
