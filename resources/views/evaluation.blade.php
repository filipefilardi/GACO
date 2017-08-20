@extends('layouts.app')

@section('content')
@if(Auth::user()->id_cat == 3)
	<!-- COOP VIEW -->
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">			
					<div class="panel-heading">@lang('app.evaluations')</div>
					<div class="panel-body">
						
						@if(!$request->isEmpty())

						<div class="panel panel-default">
							<div class="evaluation">
								<div class="panel-heading">
									<div class="row">
										<strong>Média</strong>
									</div>
									<div class="row">
										<div class="col-md-6">
											<strong>Pontualidade:</strong> {{$avg_ponctuality}}
										</div>
										<div class="col-md-6">
											<strong>Satisfação:</strong> {{$avg_satisfaction}}
										</div>
									</div>
								</div>
								
								@foreach($request as $review)
									<div class="panel-body text-justify list-group-item">
										{{$review}}
									</div>
								@endforeach
							
							</div>
						</div>
						@else
							<p class="text-center">Nenhuma avaliação feita até o momento.</p>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@else
	<!-- USER VIEW -->
	<div class="container">
		<div class="row">
			<div class="panel panel-default">			
				<div class="panel-heading">@lang('app.completedrequest')</div>
				<div class="panel-body">

					<div class="list-group">
						
						@forelse($request as $req)
						<div class="list-group-item">
							<div class="row">
								<div class="col-md-8"> Alguma info de identificação do request, talvez data e alguma outra coisa ({{$req->dt_req}}, {{$req->conf_token}})</div>
								<div class="col-md-4">
									<div class="col-md-4 col-md-offset-8">
										<button  data-toggle="modal" data-id="{{$req->id_req}}" data-target="#evaluationmodal" class="open-evaluationmodal btn btn-primary btn-block">Avaliar</button>
									</div>
								</div>
							</div>
						</div>
						@empty
							<p class="text-center">Nenhuma coleta realizada até o momento. Que tal <a href="{{ url('/request')}}">agendar uma doação</a>?</p></p>
						@endforelse

					</div>

					<div class="text-center">
						{{ $request->links() }}
					</div>

				<div id="evaluationmodal" class="modal fade" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header text-center"><h1>Avalie o Serviço</h1></div>
							<div class="modal-body" style=" text-align: justify;text-justify: inter-word;">
								
							<form class="form-horizontal" role="form" method="POST" action="{{ url('/evaluation') }}">
		                        {{ csrf_field() }}
		                        <input type="hidden" name="id_req" id="id_req" value=""/>

		                        <div class="form-group{{ $errors->has('punctual') ? ' has-error' : '' }}">
		                            <label for="punctual" class="col-md-4 control-label">Pontualidade</label>

		                            <div class="col-md-6">
		                                <select class="form-control" name="punctual">
		                                    <option value="1">1</option>
		                                    <option value="2">2</option>
		                                    <option value="3">3</option>
		                                    <option value="4">4</option>
		                                    <option value="5">5</option>
		                                </select>
		                            </div>
		                        </div>

		                        <div class="form-group{{ $errors->has('satisfac') ? ' has-error' : '' }}">
		                            <label for="satisfac" class="col-md-4 control-label">Satisfação</label>

		                            <div class="col-md-6">
		                                <select class="form-control" name="satisfac">
		                                    <option value="1">1</option>
		                                    <option value="2">2</option>
		                                    <option value="3">3</option>
		                                    <option value="4">4</option>
		                                    <option value="5">5</option>
		                                </select>
		                            </div>
		                        </div>

		                        <div class="form-group{{ $errors->has('obs') ? ' has-error' : '' }}">
		                            <label for="obs" class="col-md-4 control-label">Comentário</label>

		                            <div class="col-md-6">
		                                <textarea type="obs" rows="3" class="form-control" name="obs" value="{{ old('obs') }}" required></textarea>
		                            </div>
		                        </div>

		                        <div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button class="btn btn-primary btn-block">Avaliar</button>
									</div>
		                        </div>

		                        <div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
									</div>
		                        </div>

	                        </form>


							</div>
						</div>                
					</div>
				</div>

				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(document).on("click", ".open-evaluationmodal", function () {
	     var id_req = $(this).data('id');
	     $(".modal-body #id_req").val( id_req );
	});
</script>
@endif
@endsection
