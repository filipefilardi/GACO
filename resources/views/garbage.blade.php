@extends('layouts.app')

@section('stylesheet')
    <link href="/css/carousel.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				
				<div class="panel-heading">Dashboard</div>
				<div class="panel-body">
				 	

					 <p>Voce sabe por que é importante reciclar seu lixo eletrônico?</p>
					 <p> -- TEXTO SOBRE LIXO ELETRONICO  LINKADO ABAIXO DA LISTA DE LIXOS POR JS -- </p>

					 <p>Descubra todos os lixos que você pode doar!</p>
					 
					 <ul class="list-group">
					  @foreach ($garbage as $garbage)
					  	<li class="list-group-item">{{$garbage->nm_garbage}}</li>
					  @endforeach
					</ul>
				</div>
			
			</div>
		</div>
	</div>
</div>
@endsection
