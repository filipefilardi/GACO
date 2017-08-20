@extends('layouts.app')

@section('stylesheet')
    <link href="/css/carousel.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
          <div class="panel panel-default">
              
              <div class="panel-heading">@lang('app.adminpanel')</div>
              
              <div class="panel-body">
                
                @include('layouts.messages')

               <a href="#form_coop" class="btn btn-default btn-block" data-toggle="collapse">Cadastrar uma Cooperativa</a>
                
                <div id="form_coop" class="main-container collapse">
                  <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin') }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Nome da Cooperativa</label>

                                <div class="col-md-7">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3 control-label">Endereço de e-mail</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                         <div class="form-group{{ $errors->has('cnpj') ? ' has-error' : '' }}">
                                <label for="cnpj" class="col-md-3 control-label">CNPJ</label>

                                <div class="col-md-7">
                                    <input id="cnpj" type="text" class="form-control" name="cnpj" value="{{ old('cnpj') }}" required>

                                    @if ($errors->has('cnpj'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cnpj') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-3 control-label">Telefone</label>

                                <div class="col-md-7">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
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

                         <div class="form-group{{ $errors->has('radius') ? ' has-error' : '' }}">
                                <label for="radius" class="col-md-3 control-label">Raio de Alcance</label>

                                <div class="col-md-7">
                                    <input id="radius" type="text" class="form-control" name="radius" value="{{ old('radius') }}" required>

                                    @if ($errors->has('radius'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('radius') }}</strong>
                                        </span>
                                    @endif
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


                <a href="#confereCoops" class="btn btn-default btn-block" data-toggle="collapse">Cooperativas cadastradas</a>

                <div id="confereCoops" class="main-container collapse">
                    <ul class="list-group">
                      @forelse($coops as $coop)
                            <li class="list-group-item text-center">{{$coop->nm_user}}</li>
                      @empty
                            <p>Nenhuma cooperativa cadastrada</p>
                      @endforelse
                    </ul>              
                </div>

              </div>
              
          </div>
    </div>
</div>
@endsection
