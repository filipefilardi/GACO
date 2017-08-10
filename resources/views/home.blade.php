@extends('layouts.app')

@section('stylesheet')
	<script src="/js/registerformat.js" type="text/javascript"></script>
    <link href="/css/carousel.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="panel panel-default">


			<div class="panel-heading">@lang('app.home')</div>
			
			<div class="panel-body">
			
			@include('layouts.messages')

			<!--<p>Bem vindo {{ Auth::user()->email }}!</p> -->

			<!-- 
				COMECO DA HOME RELACIONADO AO USUARIO (FISICO, COLETIVOS e JURIDICOS)
			 -->
            @if(Auth::user()->id_cat != 3) 	
            	
            	<!-- 
					COLETAS PENDENTES
			 	-->

            	<a href="#req_pen" class="btn btn-default btn-block" data-toggle="collapse">Coletas pendentes</a>
					 
				<div id="req_pen" class="collapse">
					@if(!$request->isEmpty())
						<div class="list-group request-item">
							@foreach($request as $req)
								@if($req->status_req == "PEND")
									<div class="list-group-item">
										<div class="row">
											@if($req->desc_req)
												<div class="col-md-8">Resíduo: {{$req->desc_req}}</div>
											@else
												<div class="col-md-8">Resíduo: {{$req->nm_garbage}} {{$req->desc_req}}</div>
											@endif
											<div class="col-md-2 text-right">Token: {{$req->conf_token}}</div>
											<div class="col-md-2 text-right">Pendente</div>
										</div>
										<div class="row">
											<div class="col-md-4">Quantidade: {{$req->quantity}}</div>
											<div class="col-md-4 col-md-offset-4 text-right">{{$req->dt_req}}</div>
										</div>

										<div class="row">
											<div class="col-md-6">Endereço:</div>
										</div>
										<div class="row">
											<div class="col-md-8">Observação: {{$req->observation}} 
											</div>
											<div class="col-md-4">
												<!-- 
												<div class="col-md-4"><button class="btn btn-primary btn-block">Adiar</button></div>
												<div class="col-md-4"><button class="btn btn-success btn-block">Confirmar</button></div>
												 -->
												<div class="col-md-4 col-md-offset-8">
													<button  data-toggle="modal" data-id="{{$req->id_req}}" data-target="#cancelrequest" class="open-cancelrequest btn btn-danger btn-block">Cancelar</button>
												</div>
											</div>
										</div>
									</div>
								@endif
							@endforeach
						</div>
					@else
					<p class="text-center">Você não possui nenhuma coleta pendente! Que tal <a href="{{ url('/request')}}">agendar uma doação</a>?</p>
						@if(!Auth::user()->isComplete())
                            <p class="text-center">Complete <a href="{{ url('/complete_registration')}}"> aqui </a> seu cadastro para descartar gratuitamente seu eletrônico.</p>
                        @endif
					@endif 	
				</div> 


				<!-- 
					COLETAS AGENDADAS
			 	-->

				<a href="#req_acpt" class="btn btn-default btn-block" data-toggle="collapse">Coletas agendadas</a>
				
				<div id="req_acpt" class="collapse">
					<div class="list-group request-item">
						@forelse($request as $req)
							@if($req->status_req == "ACPT")
								<div class="list-group-item">
									<div class="row">
										@if($req->desc_req)
											<div class="col-md-8">Resíduo: {{$req->desc_req}}</div>
										@else
											<div class="col-md-8">Resíduo: {{$req->nm_garbage}} {{$req->desc_req}}</div>
										@endif
										<div class="col-md-2 text-right">Token: {{$req->conf_token}}</div>
										<div class="col-md-2 text-right">{{$req->status_req}}</div>
									</div>
									<div class="row">
										<div class="col-md-4">Quantidade: {{$req->quantity}}</div>
										<div class="col-md-4 col-md-offset-4 text-right">{{$req->dt_req}}</div>
									</div>

									<div class="row">
										<div class="col-md-6">Endereço:</div>
									</div>
									<div class="row">
										<div class="col-md-8">Observação: {{$req->observation}} 
										</div>
										<div class="col-md-4">
											 
											<div class="col-md-4"><button class="btn btn-primary btn-block">Adiar</button></div>
											<div class="col-md-4"><button class="btn btn-primary btn-block">Confirmar</button></div>
											<div class="col-md-4"><button class="btn btn-danger btn-block">Cancelar</button></div>
										</div>
									</div>
								</div>
							@endif
						@empty
							<p class="text-center">Você não possui nenhuma coleta agendada! Espere alguma cooperativa aceitar o seu pedido.</p>	
						@endforelse
					</div>
				</div>
			@endif

			<!-- 
				FINAL DA HOME RELACIONADO AO USUARIO (FISICO, COLETIVOS e JURIDICOS)
			 -->


			 <!-- 
				FINAL DA HOME RELACIONADO A COOPERATIVA
			 -->
			@if(Auth::user()->id_cat == 3)
				<a href="#list-group" class="btn btn-default btn-block" data-toggle="collapse">Doações cadastradas no sistema</a>
				
				<div class="list-group collapse" id="list-group" >
					<!-- MOSTRA TODAS AS REQUISIÇÕES NO SISTEMA -->
					@if (!$request->isEmpty())
						<h4>Lista de doações</h4>
						@foreach ($request as $request)
						  <div class="list-group-item list-group-item-action flex-column align-items-start">
						    <div class="d-flex w-100 justify-content-between">
							      <small class="text-right">
							      	@if($request->status_req == "PEND")
							      		PENDENTE
							      	@else
							      		{{$request->status_req}}
							      	@endif
							      </small>
							      </h5>

								  <button data-toggle="modal" data-target="#Modal" class="btn btn-success pull-right">Aceitar Coleta</button>

							    </div>
								<p class="mb-1">Data do pedido de coleta: {{$request->dt_req}}</p>
						  </div>
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
					                                <button type="submit" class="btn btn-primary btn-block">
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
							  <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
							    <div class="d-flex w-100 justify-content-between">
							      <small class="text-right">
							      	@if($request->status_req == "ACPT")
							      		ACEITO
							      	@else
							      		{{$request->status_req}}
							      	@endif
							      </small>
							      </h5>

							      	<form role="form" method="POST" action="{{ url('/request/cancel') }}">
								    	{{ csrf_field() }}
								    	<input type="hidden" name="id_req" value="{{$request->id_req}}" />
								    	<button class="btn btn-danger pull-right" style="margin-left: 10px;">Cancelar Coleta</button>
								    </form>

								    <button data-toggle="modal" data-target="#modaltoken" class="btn btn-primary pull-right">Confirmar Coleta</button>

							    </div>
								<p class="mb-1">Data do pedido de coleta: {{$request->dt_req}}</p>
							  </div>

							  <!-- Modal -->
                        <div id="modaltoken" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header text-center"><h1>Confirmar Pedido</h1></div>
                                    <div class="modal-body" style=" text-align: justify;text-justify: inter-word;">
                                        
                                         <form class="form-horizontal" role="form" method="POST" action="{{ url('/request/confirm') }}">
                        				{{ csrf_field() }}
				                        
                        				<input type="hidden" name="id_req" value="{{$request->id_req}}" />

				                        <div class="form-group{{ $errors->has('conf_token') ? ' has-error' : '' }}">
			                                <label for="conf_token" class="col-md-4 control-label">Token de segurança</label>

			                                <div class="col-md-6">
			                                    <input id="conf_token" type="text" class="form-control" name="conf_token" value="{{ old('conf_token') }}" required>

			                                    @if ($errors->has('conf_token'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('conf_token') }}</strong>
			                                        </span>
			                                    @endif
			                                </div>
			                            </div>

			                            <div class="form-group{{ $errors->has('dt_collected') ? ' has-error' : '' }}">
			                                <label for="dt_collected" class="col-md-4 control-label">Data de Coleta</label>

			                                <div class="col-md-6">
			                                    <input id="dt_collected" type="text" class="form-control" name="dt_collected" value="{{ old('dt_collected') }}" required>

			                                    @if ($errors->has('dt_collected'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('dt_collected') }}</strong>
			                                        </span>
			                                    @endif
			                                </div>
			                            </div>
									

			                            <div class="form-group">
					                        <div class="col-md-6 col-md-offset-4">
												<button class="btn btn-primary btn-block pull-right">Confirmar Coleta</button>
					                        </div>
					                    </div>
										    
                                    </div>
                                </div>
                            </div>
                        </div>
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

<!-- 
	ALL MODAL
 -->

<!-- MODAL CANCEL REQUEST -->
<div id="cancelrequest" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header text-center"><h1>Confirmação</h1></div>
			<div class="modal-body" style=" text-align: justify;text-justify: inter-word;">
				<form role="form" method="POST" action="{{ url('/request/cancel') }}">
					{{ csrf_field() }}
            		<input type="hidden" name="id_req"  id="id_req" value="" />
					
					<h4>Antes de deletar, tenha certeza que não quer descartar seu resíduo. Deseja continuar com esta ação?</h4>
					
					<div class="row">
						<div class="col-md-6">
							<button class="btn btn-danger btn-block">Sim</button>
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Não</button>
						</div>
					</div>
				</form>
			</div>
		</div>                
	</div>
</div>

<script type="text/javascript">
	$(document).on("click", ".open-cancelrequest", function () {
	     var id_req = $(this).data('id');
	     $(".modal-body #id_req").val( id_req );
	     // As pointed out in comments, 
	     // it is superfluous to have to manually call the modal.
	     // $('#addBookDialog').modal('show');
	});
</script>

@endsection
