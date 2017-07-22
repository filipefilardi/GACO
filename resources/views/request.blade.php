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

                  <p class="alert alert-{{ $msg }}"> <strong>Sucesso seu predido foi registrado com sucesso.</strong> Contribua mais!<a href="#" data-dismiss="alert"></a></p>
                  @endif
                @endforeach
            </div>

			<div class="panel-heading">Dashboard</div>
			
			<div class="panel-body">
			 	<div class="container">
				 	<form class="form-horizontal" role="form" method="POST" action="{{ url('/request') }}">
						{{ csrf_field() }}

						<div class="form-group">
								<label class="col-md-2 control-label">Categoria</label>
		                    <div class="col-md-5">
								<select class="form-control" name="id_garbage">
						 		@foreach ($garbage as $garbage)
			                    	<option value={{$garbage->id_garbage}}>{{$garbage->nm_garbage}}</option>
			                    @endforeach
								</select>
							</div>                   
	                    </div>

	                    <div class="form-group{{ $errors->has('desc_req') ? ' has-error' : '' }}">
						    <label for="desc_req" class="col-md-2 control-label">Equipamento</label>

                            <div class="col-md-5">
                                <input id="desc_req" type="text" class="form-control" name="desc_req" placeholder="Descreva seu equipamento" value="{{ old('desc_req') }}" required>

                                @if ($errors->has('desc_req'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('desc_req') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

	                    <div class="form-group{{ $errors->has('mod_req') ? ' has-error' : '' }}">
						    <label for="mod_req" class="col-md-2 control-label">Modelo</label>

                            <div class="col-md-5">
                                <input id="mod_req" type="text" class="form-control" name="mod_req" placeholder="Modelo do seu equipamento" value="{{ old('mod_req') }}" required>

                                @if ($errors->has('mod_req'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mod_req') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
	                    <div class="form-group{{ $errors->has('status_garbage') ? ' has-error' : '' }}">
						    <label for="status_garbage" class="col-md-2 control-label">Condição</label>

                            <div class="col-md-5">
                                <select class="form-control" name="status_garbage">
	                    			<option>Completo</option>
	                    			<option>Incompleto</option>
	                    		</select>
                                @if ($errors->has('status_garbage'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status_garbage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-2 control-label">Endereço</label>

                            <div class="col-md-5">
                                <select class="form-control" autofocus name="id_add">
                                    @if(is_null($addresses))
                                    @else 
                                        @foreach ($addresses as $address)
                                            @if($address->main_address === 1)
                                                <option selected style="display:none" value={{$address->id_add}}>{{$address->id_add}}</option>
                                            @else
                                                <option value={{$address->id_add}}>{{$address->id_add}}</option>
                                            @endif
                                            
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


	                    <div class="row">
                            <div class="col-md-6 col-md-offset-4">
		                    	<button type="submit" class="btn btn-primary">
		                        	Registrar
		                    	</button>
		                    </div>
		                 </div>

		                 <!-- 
 						<div class="form-group{{ $errors->has('desc_req') ? ' has-error' : '' }}">
						    <label for="desc_req" class="col-md-2 control-label">Equipamento</label>

                            <div class="col-md-5">
                                <input id="desc_req" type="text" class="form-control" name="desc_req" placeholder="Descreva seu equipamento" value="{{ old('desc_req') }}" required>

                                @if ($errors->has('desc_req'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('desc_req') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mod_req') ? ' has-error' : '' }}">
						    <label for="mod_req" class="col-md-2 control-label">Modelo</label>

                            <div class="col-md-5">
                                <input id="mod_req" type="text" class="form-control" name="mod_req" placeholder="Modelo do seu equipamento" value="{{ old('mod_req') }}" required>

                                @if ($errors->has('mod_req'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mod_req') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status_garbage') ? ' has-error' : '' }}">
						    <label for="status_garbage" class="col-md-2 control-label">Condição</label>

                            <div class="col-md-5">
                                <select class="form-control" name="status_garbage">
	                    			<option>Completo</option>
	                    			<option>Incompleto</option>
	                    		</select>
                                @if ($errors->has('status_garbage'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status_garbage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
 -->

	                       </form>
        	            </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
