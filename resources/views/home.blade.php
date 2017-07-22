@extends('layouts.app')

@section('stylesheet')
	<script src="/js/registerformat.js" type="text/javascript"></script>
    <link href="/css/carousel.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="flash-message">
	                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
	                          @if(Session::has('alert-' . $msg))

	                          <p class="alert alert-{{ $msg }}"> <strong>EITA, você deveria completar seu cadastro antes</strong> </a></p>
	                          @endif
	                        @endforeach
	                    </div>

			<div class="panel-heading">Dashboard</div>
			
			<div class="panel-body">
			Bem vindo {{ Auth::user()->email }}!
            @if(Auth::user()->id_cat != 3) 	
	            
	            <a href="{{ url('/request') }}">
	                link pessoa física
	            </a>

				 @if (!$request->isEmpty())
					 <div class="list-group">
						  @foreach ($request as $request)
							  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
							    <div class="d-flex w-100 justify-content-between">
							      <h5 class="mb-1">{{ $request->desc_req}} | {{$request->mod_req}}
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
							  </a>
		             	  @endforeach
					</div>
				@endif			 
			@endif

			@if(Auth::user()->id_cat == 3)
				<div class="list-group">
					<!-- MOSTRA TODAS AS REQUISIÇÕES NO SISTEMA -->
					@if (!$request->isEmpty())
						<h4>Lista de doações, aceite alguma clicando no item</h4>
						@foreach ($request as $request)
						  <a href="#" data-toggle="modal" data-target="#Modal" class="list-group-item list-group-item-action flex-column align-items-start">
						    <div class="d-flex w-100 justify-content-between">
						      <h5 class="mb-1">{{ $request->desc_req}} | {{$request->mod_req}}	
						      </h5>                   
						    </div>
						    <p class="mb-1">{{ $request->status_garbage }}</p>
						  </a>
		         	    @endforeach

		         	     <!-- Modal -->
                        <div id="Modal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header text-center"><h1>Aceitar pedido</h1></div>
                                    <div class="modal-body" style=" text-align: justify;text-justify: inter-word;">
                                        <ol>
                                        <p>O uso de todas as páginas desse website estão sujeitas a esse termos e condiçoes.</p>
                                            <li>Cada usuário cadastrado entende que ele está de acordo com tudo que está descrito nos termos e condições, caso ele não concorde, ele não deverá se cadastrar na plataforma.</li>
                                        </ol>
                                         <form class="form-horizontal" role="form" method="POST" action="{{ url('/home') }}">
                        				{{ csrf_field() }}
				                        
                        				<input type="hidden" name="id_req" value="{{$request->id_req}}" />

				                        <div class="form-group{{ $errors->has('dt_predicted') ? ' has-error' : '' }}">
			                                <label for="dt_predicted" class="col-md-4 control-label">Data de Recolhimento</label>

			                                <div class="col-md-6">
			                                    <input id="dt_predicted" type="text" class="form-control" name="date" value="{{ old('dt_predicted') }}" required>

			                                    @if ($errors->has('dt_predicted'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('dt_predicted') }}</strong>
			                                        </span>
			                                    @endif
			                                </div>
			                            </div>
									
                                            <div class="form-group">
					                            <div class="col-md-6 col-md-offset-4">
					                                <button type="submit" class="btn btn-primary">
					                                    Aceitar
					                                </button>
					                            </div>
					                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
		         	@endif
				</div>

				<h4>Lista de pedidos aceitos</h4>
				<!-- MOSTRAR TODAS AS REQUISIÇÕES FEITAS PELA COOP -->
				 @foreach ($request_acpt as $request)
					  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
					    <div class="d-flex w-100 justify-content-between">
					      <h5 class="mb-1">{{ $request->desc_req}} | {{$request->mod_req}}
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
					  </a>
             	  @endforeach
			@endif
			</div>
			
			</div>
		</div>
	</div>
</div>
@endsection
