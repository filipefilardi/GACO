@extends('layouts.app')

@section('stylesheet')
    <link href="/css/carousel.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			
			<div class="panel-heading">Configurações</div>
				
			<div class="panel-body">
				<a href="#form_coop" class="btn btn-default btn-block" data-toggle="collapse">Adicionar Endereço</a>
                
                <div id="form_coop" class="main-container collapse">
                  <form class="form-horizontal" role="form" method="POST" action="/register/address">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('nm_country') ? ' has-error' : '' }}">
                                <label for="nm_country" class="col-md-4 control-label">País</label>

                                <div class="col-md-6">
                                    <input id="nm_country" type="text" class="form-control" name="nm_country" value="{{ old('nm_country') }}" required>

                                    @if ($errors->has('nm_country'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nm_country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group{{ $errors->has('nm_city') ? ' has-error' : '' }}">
                                <label for="nm_city" class="col-md-4 control-label">Cidade</label>

                                <div class="col-md-6">
                                    <input id="nm_city" type="text" class="form-control" name="nm_city" value="{{ old('nm_city') }}" required>

                                    @if ($errors->has('nm_city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nm_city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nm_st') ? ' has-error' : '' }}">
                                <label for="nm_st" class="col-md-4 control-label">Logradouro</label>

                                <div class="col-md-6">
                                    <input id="nm_st" type="text" class="form-control" name="nm_st" value="{{ old('nm_st') }}" required>

                                    @if ($errors->has('nm_st'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nm_st') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('id_st_numb') ? ' has-error' : '' }}">
                                <label for="id_st_numb" class="col-md-4 control-label">Número</label>

                                <div class="col-md-6">
                                    <input id="id_st_numb" type="text" class="form-control" name="id_st_numb" value="{{ old('id_st_numb') }}" required>

                                    @if ($errors->has('id_st_numb'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_st_numb') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('id_comp') ? ' has-error' : '' }}">
                                <label for="id_comp" class="col-md-4 control-label">Complemento</label>

                                <div class="col-md-6">
                                    <input id="id_comp" type="text" class="form-control" name="id_comp" value="{{ old('id_comp') }}">

                                    @if ($errors->has('id_comp'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_comp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('id_cep') ? ' has-error' : '' }}">
                                <label for="id_cep" class="col-md-4 control-label">CEP</label>

                                <div class="col-md-6">
                                    <input id="id_cep" type="text" class="form-control" name="id_cep" value="{{ old('id_cep') }}" required>

                                    @if ($errors->has('id_cep'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_cep') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group{{ $errors->has('main_address') ? ' has-error' : '' }}">
                            <label for="main_address" class="col-md-4 control-label">Endereço Principal</label>

                            <div class="col-md-6">
                                <label class="radio-inline"><input type="radio" name="main_address" value="1" required>Sim</label>
                                <label class="radio-inline"><input type="radio" name="main_address" value="0">Não</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                <a href="#outro" class="btn btn-default btn-block" data-toggle="collapse">Meus Endereços</a>

                <div id="outro" class="main-container collapse">
                	@forelse($addresses as $a)
					    <p>{{$a->nm_st}} {{$a->id_st_numb}}, {{$a->id_comp}}</p>
					@empty
					    <p>Adicione um endereço, pl0x</p>
					@endforelse
                	
                	
                </div>
			</div>
			
			</div>
		</div>
	</div>
</div>
@endsection
