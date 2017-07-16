@extends('layouts.app')

@section('stylesheet')
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
				</div>

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
				                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
			                                <label for="date" class="col-md-4 control-label">Data de Recolhimento</label>

			                                <div class="col-md-6">
			                                    <input id="date" type="text" class="form-control" name="date" value="{{ old('date') }}" required>

			                                    @if ($errors->has('date'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('date') }}</strong>
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
			
			</div>
		</div>
	</div>
</div>
@endsection
