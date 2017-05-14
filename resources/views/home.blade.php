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
			 Bem vindo {{ Auth::user()->email }}!
             	
            <a href="{{ url('/request') }}">
                link pessoa física
            </a>

			 @if (!$request->isEmpty())
				 <div class="list-group">
					  @foreach ($request as $request)
						  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
						    <div class="d-flex w-100 justify-content-between">
						      <h5 class="mb-1">{{ $request->nm_garbage}} | {{$request->mod_req}}
						      <small class="text-right">
						      	@if($request->status_req == "PEND")
						      		PENDENTE
						      	@else
						      		{{$request->status_req}}
						      	@endif
						      </small>
						      </h5>
						    </div>
						    <p class="mb-1">{{ $request->desc_req }}</p>
						    <small>Previsao de Coleta{{$request->dt_predicted}}</small>
						  </a>
	             	  @endforeach
				</div>
			@endif			 
			</div>
			
			</div>
		</div>
	</div>
</div>
@endsection
