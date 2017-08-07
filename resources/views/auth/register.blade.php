@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Registro</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('id_cat') ? ' has-error' : '' }}">
                        <label for="id_cat" class="col-md-4 control-label">Categoria</label>

                        <div class="col-md-6">
                            <label class="radio-inline"><input type="radio" name="id_cat" value="1">Pessoa Física</label>
                            <label class="radio-inline"><input type="radio" name="id_cat" value="2">Pessoa Jurídica</label>
                            <label class="radio-inline"><input type="radio" name="id_cat" value="1">Coletivos/Condomínios</label>
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Endereço de e-mail</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Senha</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirmação de senha</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4" style="text-align: justify;text-justify: inter-word;">
                            Clicando em registar você afirma que leu e concorda com os <a href="#" data-toggle="modal" data-target="#termsModal">Termos e Condições</a> do GACO.
                        </div>
                    </div>

                     <!-- Modal -->
                    <div id="termsModal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header text-center"><h1>Termos e Condições</h1></div>
                                <div class="modal-body" style=" text-align: justify;text-justify: inter-word;">
                                    <p>O uso de todas as páginas desse website estão sujeitas a esse termos e condiçoes.</p>
                                    <ol>
                                        <li><strong>MODELO PARA O TERMOS E CONDICOES, É PRECISO ALTERA-LO</strong></li>
                                        <li>Qualquer pessoa envolvida com o desenvolvimento da plataforma JubilaNao, não tem nenhum envolvimento com as publicações e avaliações feitas e disponibilizadas;</li>
                                        <li>O JubilaNão não se responsabiliza pelo conteúdo divulgado aqui, cabe a cada autor de cada publicação se responsabilizar pelo conteudo divulgado;</li>
                                        <li>A presente versão do JubilaNão foi criado para uso de estudantes e professores da USP. Qualquer usúario não USPiano precisa enter que a platoforma pode não ser de seu interesse;</li>
                                        <li>Você não pode usar esse site:
                                            <ol type="a">
                                                <li>para postar qualquer matérial ou comentário que infrija os direitos legais de qualaquer pessoa;</li>
                                                <li>para postar qualquer propaganda não autorizada ou spam;</li>
                                                <li>para transmitir ou re-circular qualquer material obtido pelo site para qualquer terceiro;</li>
                                            </ol>
                                        </li>
                                        <li>Cada usuário cadastrado entende que ele está de acordo com tudo que está descrito nos termos e condições, caso ele não concorde, ele não deverá se cadastrar na plataforma.</li>
                                    </ol>
                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" data-dismiss="modal">Concordar</button>
                                            <a href="/" class="btn btn-default">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Registrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/js/register.js"></script>
@endsection
