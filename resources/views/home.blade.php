@extends('layouts.app')

@section('stylesheet')
	<script src="/js/registerformat.js" type="text/javascript"></script>
	<script src="/js/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="/js/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>

	<link href="/css/bootstrap-datepicker.css" rel="stylesheet">
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
					@if(!$master_user_pend->isEmpty())
						<div class="list-group request-item">
							@foreach($master_user_pend as $req)
								@if($loop->iteration  % 2 != 0)
								<div class="list-group-item">
									<div class="row">
										<div class="col-md-8"><b>Status:</b> Pendente</div>
										<div class="col-md-4 text-right"><b>Token:</b> {{$req->conf_token}}</div>
									</div>
									<div class="row">
										<div class="col-md-6"><b>Endereço:</b> {{$req->str_address}}</div>
										<div class="col-md-6 text-right"><b>Data:</b> {{date('d/m/Y', strtotime($req->dt_req))}}</div>
									</div>
									<div id="more_info_request_{{$req->id_req_master}}" class="collapse" style="margin-bottom: 10px;">
										<div class="row">
											<div class="col-md-12" style="margin-top: 10px;"><b>Equipamentos:</b></div>
										</div>
										<div class="row">
											<div class="col-md-10">
											@foreach($master_user_pend->values()->get($loop->iteration) as $req_info)
													@if($req_info->desc_req)
														<div class="col-md-8">{{$req_info->quantity}} x {{$req_info->desc_req}}</div>
													@else
													<div class="col-md-8">{{$req_info->quantity}} x {{$req_info->nm_garbage}}</div>
													@endif
												@if($req_info->observation)
													<div class="col-md-8"><b>&nbsp&nbsp&nbsp&nbsp obs:</b> {{$req_info->observation}}</div>
												@endif
											@endforeach
											</div>
											<div></div>
											<div class="col-md-2">
												<button  data-toggle="modal" data-id="{{$req->id_req_master}}" data-target="#cancelrequest" class="open-cancelrequest btn btn-danger btn-block">Cancelar</button>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 text-center"><a id="collapse_{{$req->id_req_master}}" href="#more_info_request_{{$req->id_req_master}}" data-toggle="collapse" onclick="changeSeeMore('collapse_{{$req->id_req_master}}')">detalhes da coleta</a></div>
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
						@if(!$master_user_acpt->isEmpty())
							@foreach($master_user_acpt as $req)
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
											<div class="col-md-4 col-md-offset-4 text-right">{{date('d/m/Y', strtotime($req->dt_req))}}</div>
										</div>

										<div class="row">
											<div class="col-md-6">Endereço: {{$req->str_address}}</div>
										</div>
										<div class="row">
											<div class="col-md-8">Observação: {{$req->observation}} 
											</div>
											<div class="col-md-4">
												 
												<div class="col-md-4 col-md-offset-4"><button data-toggle="modal" data-id="{{$req->id_req}}" data-target="#delayrequest" class="open-delayrequest btn btn-default btn-block">Adiar</button></div>
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
					@if(!$master_coop_pend->isEmpty())
						<div class="list-group request-item">
							@foreach($master_coop_pend as $req)
								@if($loop->iteration  % 2 != 0)
								<div class="list-group-item">
									<div class="row">
										<div class="col-md-6"><b>Endereço:</b> {{$req->str_address}}</div>
										<div class="col-md-6 text-right"><b>Data do Pedido:</b> {{date('d/m/Y', strtotime($req->dt_req))}}</div>
									</div>
									<div id="more_info_request_{{$req->id_req_master}}" class="collapse" style="margin-bottom: 10px;">
										<div class="row">
											<div class="col-md-12" style="margin-top: 10px;"><b>Equipamentos:</b></div>
										</div>
										<div class="row">
											<div class="col-md-10">
											@foreach($master_coop_pend->values()->get($loop->iteration) as $req_info)
													@if($req_info->desc_req)
														<div class="col-md-8">{{$req_info->quantity}} x {{$req_info->desc_req}}</div>
													@else
													<div class="col-md-8">{{$req_info->quantity}} x {{$req_info->nm_garbage}}</div>
													@endif
												@if($req_info->observation)
													<div class="col-md-8"><b>&nbsp&nbsp&nbsp&nbsp obs:</b> {{$req_info->observation}}</div>
												@endif
											@endforeach
											</div>
											<div></div>
											<div class="col-md-2">
												<button  data-toggle="modal" data-id="{{$req->id_req_master}}" data-target="#acceptrequest" class="open-acceptrequest btn btn-success btn-block">Aceitar</button>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 text-center"><a id="collapse_{{$req->id_req_master}}" href="#more_info_request_{{$req->id_req_master}}" data-toggle="collapse" onclick="changeSeeMore('collapse_{{$req->id_req_master}}')">detalhes da coleta</a></div>
									</div>
								</div>
							    @endif
							@endforeach
						</div>
					@else
					<p class="text-center">Não existem doações cadastrada no sistema.</p>
					@endif 	
				</div> 	


				<a href="#acpt_req" class="btn btn-default btn-block" data-toggle="collapse">Doações aceitas</a>

				<div id="acpt_req" class="collapse">
					@if(!$master_coop_acpt->isEmpty())
						<div class="list-group request-item">
							@foreach($master_coop_acpt as $req)
								@if($loop->iteration  % 2 != 0)
								<div class="list-group-item">
									<div class="row">
										<div class="col-md-6"><b>Endereço:</b> {{$req->str_address}}</div>
										<div class="col-md-6 text-right"><b>Data do Pedido:</b> {{date('d/m/Y', strtotime($req->dt_req))}}</div>
									</div>
									<div id="more_info_request_{{$req->id_req_master}}" class="collapse" style="margin-bottom: 10px;">
										<div class="row">
											<div class="col-md-12" style="margin-top: 10px;"><b>Equipamentos:</b></div>
										</div>
										<div class="row">
											<div class="col-md-10">
											@foreach($master_coop_acpt->values()->get($loop->iteration) as $req_info)
													@if($req_info->desc_req)
														<div class="col-md-8">{{$req_info->quantity}} x {{$req_info->desc_req}}</div>
													@else
													<div class="col-md-8">{{$req_info->quantity}} x {{$req_info->nm_garbage}}</div>
													@endif
												@if($req_info->observation)
													<div class="col-md-8"><b>&nbsp&nbsp&nbsp&nbsp obs:</b> {{$req_info->observation}}</div>
												@endif
											@endforeach
											</div>
											<div></div>
											<div class="col-md-2">
												<button data-toggle="modal" data-id="{{$req->id_req_master}}" data-target="#delayrequest" class="open-delayrequest btn btn-default btn-block">Adiar</button>
												
												<button data-toggle="modal" data-id="{{$req->id_req_master}}" data-target="#confirmrequest" class="open-confirmrequest btn btn-primary btn-block">Confirmar</button>
												
												<button  data-toggle="modal" data-id="{{$req->id_req_master}}" data-target="#cancelrequest" class="open-cancelrequest btn btn-danger btn-block">Cancelar</button>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 text-center"><a id="collapse_{{$req->id_req_master}}" href="#more_info_request_{{$req->id_req_master}}" data-toggle="collapse" onclick="changeSeeMore('collapse_{{$req->id_req_master}}')">detalhes da coleta</a></div>
									</div>
								</div>
							    @endif
							@endforeach
						</div>
					@else
					<p class="text-center">Não possui nenhuma doação aceita até o momento.</p>
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
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header text-center"><h3>Confirmação</h3></div>
			<div class="modal-body" style=" text-align: justify;text-justify: inter-word;">
				<form role="form" method="POST" action="{{ url('/request/cancel') }}">
					{{ csrf_field() }}
            		<input type="hidden" name="id_req"  id="id_req" value="" />
					
					<h4 style="font-size: 15px; padding-bottom: 15px;">Seu pedido será deletado do sistema, deseja continuar com esta ação?</h4>
					<div class="modal-footer">
						<button class="btn btn-danger">Deletar Pedido</button>
						<button type="button" class="btn btn-default" data-dismiss="modal" style="margin-bottom: 0px;">Cancelar Ação</button>
					</div>
				</form>
			</div>
		</div>                
	</div>
</div>

	<div id="acceptrequest" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header text-center"><h2>Aceitar doação</h2></div>
				<div class="modal-body" style=" text-align: justify;text-justify: inter-word;">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/home') }}">
						{{ csrf_field() }}
	            		<input type="hidden" name="id_req"  id="id_req" value="" />
<!-- 						
						<div class="col-md-6 col-md-offset-4">
							<div class="input-group date">
								<input id="dateaccept" type="text" class="form-control">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-th"></span>
								</div>
							</div>
						</div>
 -->

                        <div class="col-md-6 col-md-offset-4">
                        	<div class="alert alert-success" role="alert">
                        		<p>Antes de confirmar, verifique se a data digitada é a mesma selecionada no calendário.</p>
                        	</div>
                        </div>

						<div class="form-group{{ $errors->has('dt_predicted') ? ' has-error' : '' }}">
	                        <label for="dt_predicted" class="col-md-4 control-label">Data de Recolhimento</label>

	                        <div class="col-md-6">
								<input id="dateaccept" name="dateaccept" type="text" class="form-control">
								<!-- <div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div> -->

	                            @if ($errors->has('dt_predicted'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('dt_predicted') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

                        <div class="form-group{{ $errors->has('period') ? ' has-error' : '' }}">
                            <label for="period" class="col-md-4 control-label">@lang('app.period')</label>
                            
                            <div class="col-md-6">
                                <div class="btn-group btn-group-justified" id="periodcheckbox" data-toggle="buttons">
                                    <label class="btn btn-default"><input type="checkbox" name="manha" value="1">@lang('app.morning')</label>
                                    <label class="btn btn-default"><input type="checkbox" name="tarde" value="1">@lang('app.noon')</label>
                                    <label class="btn btn-default"><input type="checkbox" name="noite" value="1">@lang('app.night')</label>
                                </div>
                            </div>
                        </div>

						<div class="row">
							<div class="col-md-6 col-md-offset-4">
								<button class="btn btn-success btn-block">Confirmar</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-md-offset-4" style="padding-top: 5px">
								<button type="button" class="btn btn-default btn-block" data-dismiss="modal" style="margin-bottom: 0px;">Cancelar</button>
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

	<div id="delayrequest" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header text-center"><h1>Adiar Coleta</h1></div>
				<div class="modal-body" style=" text-align: justify;text-justify: inter-word;">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/home') }}">
						{{ csrf_field() }}
	            		<input type="hidden" name="id_req"  id="id_req" value="" />
						
						<div class="form-group{{ $errors->has('justification') ? ' has-error' : '' }}">
	                        <label for="justification" class="col-md-4 control-label">Justificativa</label>

	                        <div class="col-md-6">
	                            <textarea id="justification" rows="3" type="text" class="form-control" name="justification" value="{{ old('justification') }}" required></textarea>

	                            @if ($errors->has('justification'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('justification') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

						<div class="row">
							<div class="col-md-6 col-md-offset-4">
								<button class="btn btn-primary btn-block">Adiar</button>
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
	
	$(document).on("click", ".open-delayrequest", function () {
	     var id_req = $(this).data('id');
	     $(".modal-body #id_req").val( id_req );
	});

	function changeSeeMore(id_collapse) {
	    if(document.getElementById(id_collapse).innerHTML == 'detalhes da coleta'){
	    	document.getElementById(id_collapse).innerHTML = 'menos detalhes';
	    }
	    else{
	    	document.getElementById(id_collapse).innerHTML = 'detalhes da coleta';	
	    }
	}

	$('#dateaccept').datepicker({
	    format: 'dd/mm/yyyy',
	    startDate: '+0d',
	    language: 'pt-BR',
	});
</script>

@endsection
