@extends('layouts.app')

@section('stylesheet')
	<script src="/js/registerformat.js" type="text/javascript"></script>
    <link href="/css/carousel.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="panel panel-default">

			@if(Auth::user()->id_cat == 3)
				<div class="panel-heading">@lang('app.cooperativepanel')</div>
			@else
				<div class="panel-heading">@lang('app.home')</div>
			@endif
			<div class="panel-body">
			
			@include('layouts.messages')

			<!--<p>Bem vindo {{ Auth::user()->email }}!</p> -->

			<!-- 
				COMECO DA HOME RELACIONADO AO USUARIO (FISICO, COLETIVOS e JURIDICOS)
			 -->
            @if(Auth::user()->id_cat == 1 || Auth::user()->id_cat == 2) 	
            	
            	<!-- 
					COLETAS PENDENTES
			 	-->

            	<a href="#req_pen" class="btn btn-default btn-block" data-toggle="collapse">Coletas pendentes</a>
					 
				<div id="req_pen" class="collapse">
					@if(!empty($user_pend))
						<div class="list-group request-item">
							@foreach($user_pend as $req)
								@if($req->status_req == "PEND")
									<div class="list-group-item">
										<div class="row">
											@if($req->desc_req)
												<div class="col-md-8">Resíduo: {{$req->desc_req}}</div>
											@else
												<div class="col-md-8">Resíduo: {{$req->nm_garbage}}</div>
											@endif
											<div class="col-md-2 text-right">Token: {{$req->conf_token}}</div>
											<div class="col-md-2 text-right">Pendente</div>
										</div>
										<div class="row">
											<div class="col-md-4">Quantidade: {{$req->quantity}}</div>
											<div class="col-md-4 col-md-offset-4 text-right">{{$req->dt_req}}</div>
										</div>

										<div class="row">
											<div class="col-md-6">Endereço: {{$req->str_address}}</div>
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
													<button  data-toggle="modal" data-id="{{$req->id_req}}" data-target="#cancelrequest" class="open-cancelrequest btn btn-danger btn-block">Excluir</button>
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
						@if(!empty($user_acpt))
							@foreach($user_acpt as $req)
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
											<div class="col-md-6">Endereço: {{$req->str_address}}</div>
										</div>
										<div class="row">
											<div class="col-md-8">Observação: {{$req->observation}} 
											</div>
											<div class="col-md-4">
												 
												<div class="col-md-4 col-md-offset-4"><button class="btn btn-default btn-block">Adiar</button></div>
												<div class="col-md-4"><button  data-toggle="modal" data-id="{{$req->id_req}}" data-target="#cancelrequest" class="open-cancelrequest btn btn-danger btn-block">Excluir</button></div>
											</div>
										</div>
									</div>
								@endif
							@endforeach
						@else
							<p class="text-center">Você não possui nenhuma coleta agendada! Espere alguma cooperativa aceitar o seu pedido.</p>	
						@endif
					</div>
				</div>
			@endif

			<!-- 
				FINAL DA HOME RELACIONADO AO USUARIO (FISICO, COLETIVOS e JURIDICOS)
			 -->


			 <!-- 
			 ################################################
				COMEÇO DA HOME RELACIONADO A COOPERATIVA
			 ################################################
			 -->
			@if(Auth::user()->id_cat == 3)
				<a href="#reg_req" class="btn btn-default btn-block" data-toggle="collapse">Doações cadastradas no sistema</a>
				
				<div id="reg_req" class="collapse">
					<div class="list-group request-item">
						@forelse($request as $req)
							<div class="list-group-item">
								<div class="row">
									@if($req->desc_req)
										<div class="col-md-8">Resíduo: {{$req->desc_req}}</div>
									@else
										<div class="col-md-8">Resíduo: Não está retornando no método</div>
									@endif
									<div class="col-md-2 col-md-offset-2 text-right">{{$req->status_req}}</div>
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
										<div class="col-md-4 col-md-offset-8"><button  data-toggle="modal" data-id="{{$req->id_req}}" data-target="#acceptrequest" class="open-acceptrequest btn btn-success btn-block">Aceitar</button></div>
									</div>
								</div>
							</div>
						@empty
							<p class="text-center">Não existem doações cadastrada no sistema.</p>	
						@endforelse
					</div>
				</div>

				<a href="#acpt_req" class="btn btn-default btn-block" data-toggle="collapse">Doações aceitas</a>
				
				<div id="acpt_req" class="collapse">
					<div class="list-group request-item">
						@forelse($request_acpt as $req)
							<div class="list-group-item">
								<div class="row">
									@if($req->desc_req)
										<div class="col-md-6">Resíduo: {{$req->desc_req}}</div>
									@else
										<div class="col-md-6">Resíduo: Não está retornando no método</div>
									@endif
									<div class="col-md-4 text-right">Agendamento: {{$req->dt_predicted}}</div>
									<div class="col-md-2 text-right">{{$req->status_req}}</div>
								</div>
								<div class="row">
									<div class="col-md-4">Quantidade: {{$req->quantity}}</div>
								</div>

								<div class="row">
									<div class="col-md-6">Endereço:</div>
								</div>
								<div class="row">
									<div class="col-md-8">Observação: {{$req->observation}} 
									</div>
									<div class="col-md-4">
										<div class="col-md-4"><button class="btn btn-default btn-block">Adiar</button></div>
										<div class="col-md-4"><button data-toggle="modal" data-id="{{$req->id_req}}" data-target="#confirmrequest" class="open-confirmrequest btn btn-primary">Confirmar</button></div>
										<div class="col-md-4">
											<form role="form" method="POST" action="{{ url('/request/cancel') }}">
												{{ csrf_field() }}
												<input type="hidden" name="id_req" value="{{$req->id_req}}" />
												<button class="btn btn-danger"">Cancelar</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						@empty
							<p class="text-center">Não possui nenhuma doação aceita até o momento.</p>	
						@endforelse
					</div>
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
					
					<h4>Seu pedido de coleta será deletado do sistema, caso não queira exclui-lo, recomendamos que clique no botão cancelar. Deseja continuar com esta ação?</h4>
					
					<div class="row">
						<div class="col-md-6">
							<button class="btn btn-danger btn-block">Continuar</button>
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</form>
			</div>
		</div>                
	</div>
</div>

	<div id="acceptrequest" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header text-center"><h1>Aceitar doação</h1></div>
				<div class="modal-body" style=" text-align: justify;text-justify: inter-word;">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/home') }}">
						{{ csrf_field() }}
	            		<input type="hidden" name="id_req"  id="id_req" value="" />
						
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

						<div class="row">
							<div class="col-md-6 col-md-offset-4">
								<button class="btn btn-success btn-block">Confirmar</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-md-offset-4" style="padding-top: 5px">
								<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
							</div>
						</div>
					</form>
				</div>
			</div>                
		</div>
	</div>

	<div id="confirmrequest" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header text-center"><h1>Confirmar Coleta</h1></div>
				<div class="modal-body" style=" text-align: justify;text-justify: inter-word;">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/request/confirm') }}">
						{{ csrf_field() }}
	            		<input type="hidden" name="id_req" id="id_req" value=""/>
						
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
	                        <label for="dt_collected" class="col-md-4 control-label">Data da Coleta</label>

	                        <div class="col-md-6">
	                            <input id="dt_collected" type="text" class="form-control" name="dt_collected" value="{{ old('dt_collected') }}" required>

	                            @if ($errors->has('dt_collected'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('dt_collected') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>					

	                    <div class="row">
	                        <div class="col-md-6 col-md-offset-4">
								<button class="btn btn-primary btn-block pull-right">Confirmar</button>
	                        </div>
	                	</div>

						<div class="row">
							<div class="col-md-6 col-md-offset-4" style="padding-top: 5px;">
								<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
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
	});

	$(document).on("click", ".open-acceptrequest", function () {
	     var id_req = $(this).data('id');
	     $(".modal-body #id_req").val( id_req );
	});

	$(document).on("click", ".open-confirmrequest", function () {
	     var id_req = $(this).data('id');
	     $(".modal-body #id_req").val( id_req );
	});
</script>

@endsection
