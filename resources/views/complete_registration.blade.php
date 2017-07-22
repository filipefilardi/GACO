@extends('layouts.app')

@section('stylesheet')
    <script src="/js/registerformat.js" type="text/javascript"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Completar Registro</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/complete_registration') }}">
                        {{ csrf_field() }}

                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                              @if(Session::has('alert-' . $msg))

                              <p class="alert alert-{{ $msg }}"> <strong>Você precisa completar sua cadastro antes de fazer uma doação.</strong><a href="#" data-dismiss="alert"></a></p>
                              @endif
                            @endforeach
                        </div>

                        @if($id_cat==1)
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nome Completo</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('birth') ? ' has-error' : '' }}">
                                <label for="birth" class="col-md-4 control-label">Data de Nascimento</label>

                                <div class="col-md-6">
                                    <input id="birth" type="text" size=10 maxlength=10 class="form-control" name="date" value="{{ old('birth') }}" required>

                                    @if ($errors->has('birth'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('birth') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('mobile_phone') ? ' has-error' : '' }}">
                                <label for="mobile_phone" class="col-md-4 control-label">Telefone Celular</label>

                                <div class="col-md-6">
                                    <input id="mobile_phone" type="text" class="form-control" name="mobile_phone" value="{{ old('mobile_phone') }}" required>

                                    @if ($errors->has('mobile_phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mobile_phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('home_phone') ? ' has-error' : '' }}">
                                <label for="home_phone" class="col-md-4 control-label">Telefone Residencial</label>

                                <div class="col-md-6">
                                    <input id="home_phone" type="text" class="form-control" name="home_phone" value="{{ old('home_phone') }}" required>

                                    @if ($errors->has('home_phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                                <label for="cpf" class="col-md-4 control-label">CPF</label>

                                <div class="col-md-6">
                                    <input id="cpf" type="text" class="form-control" name="cpf" value="{{ old('cpf') }}" required>

                                    @if ($errors->has('cpf'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cpf') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nome</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('corp_phone') ? ' has-error' : '' }}">
                                <label for="corp_phone" class="col-md-4 control-label">Telefone Corporativo</label>

                                <div class="col-md-6">
                                    <input id="corp_phone" type="text" class="form-control" name="corp_phone" value="{{ old('home_phone') }}" required>

                                    @if ($errors->has('corp_phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('corp_phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('cnpj') ? ' has-error' : '' }}">
                                <label for="cnpj" class="col-md-4 control-label">CNPJ</label>

                                <div class="col-md-6">
                                    <input id="cnpj" type="text" class="form-control" name="cnpj" value="{{ old('cnpj') }}" required>

                                    @if ($errors->has('cnpj'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cnpj') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

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

                        <input type="hidden" name="main_address" value="1">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/register.js"></script>
@endsection
