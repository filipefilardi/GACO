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
			 	<div class="container">
				 	<form class="form-horizontal" role="form" method="POST" action="{{ url('/request') }}">
						{{ csrf_field() }}
						
						<div class="flash-message">
	                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
	                          @if(Session::has('alert-' . $msg))

	                          <p class="alert alert-{{ $msg }}"> <strong>Sucesso seu predido foi registrado com sucesso.</strong> Contribua mais!<a href="#" data-dismiss="alert"></a></p>
	                          @endif
	                        @endforeach
	                    </div>

						<div class="row">
		                    <div class="col-md-6">
								<label>Escolha uma categoria</label>
								<select class="form-control" name="id_garbage">
						 		@foreach ($garbage as $garbage)
			                    	<option value={{$garbage->id_garbage}}>{{$garbage->nm_garbage}}</option>
			                    @endforeach
								</select>
							</div>                   
	                    </div>
	                    <div class="row">
	                    	<div class="col-md-6">
	                    		<textarea name='desc_req' class="form-control" placeholder="Descreva seu equipamento"></textarea>
	                    	</div>
	                    </div>

	                    <div class="row">
	                    	<div class="col-md-6">
	                    		<input name="mod_req" class="form-control" placeholder="Modelo do seu equipamento"></input>
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-md-6">
	                    		<select class="form-control" name="status_garbage">
	                    			<option>Completo</option>
	                    			<option>Incompleto</option>
	                    		</select>
	                    	</div>
	                    </div>
	                    <div class="row">
		                    <div class="col-md-6">
		                    	<button type="submit" class="btn btn-primary">
		                        	Registrar
		                    	</button>
		                    </div>
		                 </div>
	                </form>
	            </div>
			</div>

			</div>
		</div>
	</div>
</div>
@endsection
