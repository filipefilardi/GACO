@extends('layouts.app')

@section('stylesheet')
	<script src="/js/registerformat.js" type="text/javascript"></script>
    <link href="/css/carousel.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="panel panel-default">


			<div class="panel-heading">Home</div>
			
			<div class="panel-body">
			
			@include('layouts.messages')

			<!--<p>Bem vindo {{ Auth::user()->email }}!</p> -->
            @if(Auth::user()->id_cat != 3) 	
            	<a href="#myreq" class="btn btn-default btn-block" data-toggle="collapse">Coletas requisitadas</a>
					 
					 <div class="list-group collapse" id="myreq">
						  	@forelse($request as $req)
							  @if($req->status_req == "PEND")
								  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
								    <div class="d-flex w-100 justify-content-between">
								      <h5 class="mb-1">Descrição: {{ $req->desc_req}}
								      <small class="text-right">
								      	@if($req->status_req == "PEND")
								      		PENDENTE
								      	@endif
								      </small>
								      </h5>
								      <h5 class="mb-1">Modelo: {{$req->mod_req}} </h5>
								    </div>
								    <p class="mb-1">Código de confirmação: {{$req->conf_token}}</p>
								    <p class="mb-1">Data do pedido de coleta: {{$req->dt_req}}</p>

								  </a>
							  @endif
							@empty
							<p>Você não possui nenhuma coleta pendente!</p>
								@if(!Auth::user()->isComplete())
	                                Complete <a href="{{ url('/complete_registration')}}"> aqui </a> seu cadastro para descartar gratuitamente seu eletrônico.
	                            @endif
		             	  	@endforelse
					</div>

				<a href="#req_acpt" class="btn btn-default btn-block" data-toggle="collapse">Coletas aceitas</a>
				
				<div class="list-group collapse" id="req_acpt">
					@forelse($request as $request)
						@if($request->status_req == "ACPT")
							<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
								    <div class="d-flex w-100 justify-content-between">
								      <h5 class="mb-1">Descrição: {{ $req->desc_req}}
								      <small class="text-right">
								      	@if($req->status_req == "ACPT")
								      		ACEITO
								      	@endif
								      </small>
								      </h5>
								      <h5 class="mb-1">Modelo: {{$req->mod_req}} </h5>
								    </div>
								    <p class="mb-1">Código de confirmação: {{$req->conf_token}}</p>
								    <p class="mb-1">Data do pedido de coleta: {{$req->dt_req}}</p>

								  </a>
						@endif
					@empty
					<p>Você não possui nenhuma coleta aceita!</p>
					
             	  	@endforelse
				</div>
			@endif

			@if(Auth::user()->id_cat == 3)
				<a href="#list-group" class="btn btn-default btn-block" data-toggle="collapse">Doações cadastradas no sistema</a>
				
				<div class="list-group collapse" id="list-group" >
					<!-- MOSTRA TODAS AS REQUISIÇÕES NO SISTEMA -->
					@if (!$request->isEmpty())
						<h4>Lista de doações, aceite alguma clicando no item</h4>
						@foreach ($request as $request)
						  <a href="#" data-toggle="modal" data-target="#Modal" class="list-group-item list-group-item-action flex-column align-items-start">
						    <div class="d-flex w-100 justify-content-between">
							      <h5 class="mb-1">Descrição: {{ $request->desc_req}} 
							      <small class="text-right">
							      	@if($request->status_req == "PEND")
							      		PENDENTE
							      	@else
							      		{{$request->status_req}}
							      	@endif
							      </small>
							      </h5>
							      <h5 class="mb-1">Modelo: {{$request->mod_req}} </h5>
							    </div>
							    <p class="mb-1">Estado: {{ $request->status_garbage }} </p>
								<p class="mb-1">Data do pedido de coleta: {{$request->dt_req}}</p>
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
		         	@else
		         		<p>Não existem doações cadastrada no sistema</p>
		         	@endif
				</div>

				<a href="#acpt_req" class="btn btn-default btn-block" data-toggle="collapse">Doações aceitas</a>
				<div id="acpt_req" class="main-container collapse">
					@if (!$request_acpt->isEmpty())
						<h4>Lista de pedidos aceitos</h4>
						<!-- MOSTRAR TODAS AS REQUISIÇÕES FEITAS PELA COOP -->
						 @foreach ($request_acpt as $request)
							  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
							    <div class="d-flex w-100 justify-content-between">
							      <h5 class="mb-1">Descrição: {{ $request->desc_req}}
							      <small class="text-right">
							      	@if($request->status_req == "ACPT")
							      		ACEITO
							      	@else
							      		{{$request->status_req}}
							      	@endif
							      </small>
							      </h5>
							      <h5 class="mb-1">Modelo: {{$request->mod_req}} </h5>
							    </div>
							    <p class="mb-1">Estado: {{ $request->status_garbage }} </p>
								<p class="mb-1">Data do pedido de coleta: {{$request->dt_req}}</p>
							  </a>
		             	  @endforeach
		            @else
		            	<p>Você não aceitou nenhuma doação até o momento</p>
		            @endif
		        </div>
			@endif
			</div>
			
			</div>
	</div>
</div>
@endsection
