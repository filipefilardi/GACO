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

               <a href="#form_coop" class="btn btn-default btn-block" data-toggle="collapse">@lang('app.registercoop')</a>
                
                <div id="form_coop" class="main-container collapse">
                  <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin') }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">@lang('app.coopname')</label>

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
                            <label for="email" class="col-md-3 control-label">@lang('app.emailaddress')</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<!-- 
                            <div class="col-md-3"></div>
                            <div class="col-md-7">
                                <div class="alert alert-warning" role="alert">
                                  Preencha o campo CNPJ apenas com números. Não uitlize pontos, barras e hifém
                                </div>
                            </div>
 -->
                         <div class="form-group{{ $errors->has('cnpj') ? ' has-error' : '' }}">
                                <label for="cnpj" class="col-md-3 control-label">@lang('app.juridicperson')</label>

                                <div class="col-md-7">
                                    <input id="cnpj" type="text" class="form-control" name="cnpj" value="{{ old('cnpj') }}" placeholder="Preencha apenas com números" required>

                                    @if ($errors->has('cnpj'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cnpj') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-3 control-label">@lang('app.telephone')</label>

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
                            <label for="password" class="col-md-3 control-label">@lang('app.password')</label>

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
                            <label for="password-confirm" class="col-md-3 control-label">@lang('app.confirmpassword')</label>

                            <div class="col-md-7">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                                             <div class="form-group{{ $errors->has('nm_country') ? ' has-error' : '' }}">
                        <label for="nm_country" class="col-md-3 control-label">@lang('app.country')</label>

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
                    <label for="nm_state" class="col-md-3 control-label">@lang('app.state')</label>

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
                        <label for="nm_city" class="col-md-3 control-label">@lang('app.city')</label>

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
                        <label for="nm_st" class="col-md-3 control-label">@lang('app.address')</label>

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
                        <label for="id_st_numb" class="col-md-3 control-label">@lang('app.addressnumber')</label>

                        <div class="col-md-7">
                            <input id="id_st_numb" type="text" class="form-control" name="id_st_numb" value="{{ old('id_st_numb') }}" required>

                            @if ($errors->has('id_st_numb'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_st_numb') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('id_cep') ? ' has-error' : '' }}">
                        <label for="id_cep" class="col-md-3 control-label">@lang('app.postalcode')</label>

                        <div class="col-md-7">
                            <input id="id_cep" type="text" class="form-control" name="id_cep" value="{{ old('id_cep') }}" required>

                            @if ($errors->has('id_cep'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_cep') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                         <div class="form-group{{ $errors->has('radius') ? ' has-error' : '' }}">
                                <label for="radius" class="col-md-3 control-label">@lang('app.radius')</label>

                                <div class="col-md-7">
                                    <input id="radius" type="text" class="form-control" name="radius" value="{{ old('radius') }}"  placeholder="Preencha o raio de alcance de sua cooperativa" required>

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
                                    @lang('app.register')
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="main_address" value="1">
                        <input type="hidden" name="id_comp" value="">
                    </form>
                </div>


                <a href="#confereCoops" class="btn btn-default btn-block" data-toggle="collapse">@lang('app.coopsregistered')</a>

                <div id="confereCoops" class="main-container collapse">
                    <ul class="list-group">
                      @forelse($coops as $coop)
                            <li class="list-group-item text-center">{{$coop->nm_user}}</li>
                      @empty
                            <p>@lang('app.nocoopsregister')</p>
                      @endforelse
                    </ul>              
                </div>

              </div>
              
          </div>
    </div>
</div>
@endsection
