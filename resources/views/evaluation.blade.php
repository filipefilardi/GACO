@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="panel panel-default">			
			<div class="panel-heading">@lang('app.completedrequest')</div>
			<div class="panel-body">

				<div class="list-group">
					
					<div class="list-group-item">
						<div class="row">
							<div class="col-md-8"> Alguma info de identificação do request, talvez data e alguma outra coisa </div>
							<div class="col-md-4">
								<div class="col-md-4 col-md-offset-8">
									<button  data-toggle="modal" data-id="" data-target="#evaluationmodal" class="open-evaluationmodal btn btn-primary btn-block">Avaliar</button>
								</div>
							</div>
						</div>
					</div>

				</div>

			<div id="evaluationmodal" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header text-center"><h1>Avalie o Serviço</h1></div>
						<div class="modal-body" style=" text-align: justify;text-justify: inter-word;">
							
						<form class="form-horizontal" role="form" method="POST" action="">
	                        {{ csrf_field() }}

	                        <div class="form-group{{ $errors->has('ponctuality') ? ' has-error' : '' }}">
	                            <label for="ponctuality" class="col-md-4 control-label">Pontualidade</label>

	                            <div class="col-md-6">
	                                <select class="form-control" name="main_address">
	                                    <option value="1">1</option>
	                                    <option value="2">2</option>
	                                    <option value="3">3</option>
	                                    <option value="4">4</option>
	                                    <option value="5">5</option>
	                                </select>
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('comunication') ? ' has-error' : '' }}">
	                            <label for="comunication" class="col-md-4 control-label">Comunicação</label>

	                            <div class="col-md-6">
	                                <select class="form-control" name="main_address">
	                                    <option value="1">1</option>
	                                    <option value="2">2</option>
	                                    <option value="3">3</option>
	                                    <option value="4">4</option>
	                                    <option value="5">5</option>
	                                </select>
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('coment') ? ' has-error' : '' }}">
	                            <label for="coment" class="col-md-4 control-label">Comentário</label>

	                            <div class="col-md-6">
	                                <textarea id="coment" type="coment" class="form-control" name="coment" value="{{ old('coment') }}" required></textarea>
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
@endsection
