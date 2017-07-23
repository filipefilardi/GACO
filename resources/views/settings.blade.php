@extends('layouts.app')

@section('stylesheet')
    <script src="/js/registerformat.js" type="text/javascript"></script>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="panel panel-default">
			
			<div class="panel-heading">Configurações</div>
				
			<div class="panel-body">
                
                @include('layouts.messages')

				<a href="#form_coop" class="btn btn-default btn-block" data-toggle="collapse">Adicionar Endereço</a>
                
                <div id="form_coop" class="main-container collapse">
                  <form class="form-horizontal" role="form" method="POST" action="/register/address">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('nm_country') ? ' has-error' : '' }}">
                                <label for="nm_country" class="col-md-3 control-label">País</label>

                                <div class="col-md-7">
                                    <input id="nm_country" type="text" class="form-control" name="nm_country" value="{{ old('nm_country') }}" required>

                                    @if ($errors->has('nm_country'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nm_country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        <div class="form-group{{ $errors->has('nm_state') ? ' has-error' : '' }}">
                            <label for="nm_state" class="col-md-3 control-label">Estado</label>

                            <div class="col-md-7">
                                <input id="nm_state" type="text" class="form-control" name="nm_state" value="{{ old('nm_state') }}" maxlength="2" required>

                                @if ($errors->has('nm_state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nm_state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nm_city') ? ' has-error' : '' }}">
                                <label for="nm_city" class="col-md-3 control-label">Cidade</label>

                                <div class="col-md-7">
                                    <input id="nm_city" type="text" class="form-control" name="nm_city" value="{{ old('nm_city') }}" required>

                                    @if ($errors->has('nm_city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nm_city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nm_st') ? ' has-error' : '' }}">
                                <label for="nm_st" class="col-md-3 control-label">Logradouro</label>

                                <div class="col-md-7">
                                    <input id="nm_st" type="text" class="form-control" name="nm_st" value="{{ old('nm_st') }}" required>

                                    @if ($errors->has('nm_st'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nm_st') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('id_st_numb') ? ' has-error' : '' }}">
                                <label for="id_st_numb" class="col-md-3 control-label">Número</label>

                                <div class="col-md-7">
                                    <input id="id_st_numb" type="text" class="form-control" name="id_st_numb" value="{{ old('id_st_numb') }}" required>

                                    @if ($errors->has('id_st_numb'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_st_numb') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('id_comp') ? ' has-error' : '' }}">
                                <label for="id_comp" class="col-md-3 control-label">Complemento</label>

                                <div class="col-md-7">
                                    <input id="id_comp" type="text" class="form-control" name="id_comp" value="{{ old('id_comp') }}">

                                    @if ($errors->has('id_comp'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_comp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('id_cep') ? ' has-error' : '' }}">
                                <label for="id_cep" class="col-md-3 control-label">CEP</label>

                                <div class="col-md-7">
                                    <input id="id_cep" type="text" class="form-control" name="id_cep" value="{{ old('id_cep') }}" required>

                                    @if ($errors->has('id_cep'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_cep') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group{{ $errors->has('main_address') ? ' has-error' : '' }}">
                            <label for="main_address" class="col-md-3 control-label">Endereço Principal</label>

                            <div class="col-md-7">
                                <label class="radio-inline"><input type="radio" name="main_address" value="1" required>Sim</label>
                                <label class="radio-inline"><input type="radio" name="main_address" value="0">Não</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-block">
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

                <a href="#conta" class="btn btn-default btn-block" data-toggle="collapse">Conta</a>

                <div id="conta" class="main-container collapse">
                    <h3 class="col-md-offset-3">Alterar Senha</h3>
                     <form class="form-horizontal" role="form" method="POST" action="{{ url('/update/password') }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                <label for="old_password" class="col-md-3 control-label">Senha Antiga</label>

                                <div class="col-md-7">
                                    <input id="old_password" type="text" class="form-control" name="old_password" value="{{ old('old_password') }}" required>

                                    @if ($errors->has('old_password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-3 control-label">Senha</label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-3 control-label">Confirmação de senha</label>

                            <div class="col-md-7">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>

                    <h3 class="col-md-offset-3">Deletar Conta</h3>
                    <form class="form-horizontal" role="form" method="POST" action="/delete/account">
                        {{ csrf_field() }}
                     <div class="form-group">
                         <div class="col-md-7 col-md-offset-3">
                            <p>Esteja certo que você quer deletar sua conta. Uma vez deletada, aquele abraço</p>
                         </div>
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-danger btn-block">
                                    Deletar Conta
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
