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
                                    <p>Ao se cadastrar e fazer uso da plataforma GACO, o usuário concorda em:</p>
                                    <ol>
                                        <!-- <li><strong>MODELO PARA O TERMOS E CONDICOES, É PRECISO ALTERA-LO</strong></li> -->
                                        <li>As cooperativas parceiras são responsáveis pela coleta, pela triagem e pela
                                        comercialização e destinação dos resíduos doados registrados na plataforma, a equipe GACO
                                        fica responsável apenas pelo desenvolvimento do canal de comunicação;</li>
                                        <li>O usuário se responsabiliza pela veracidade dos dados de cadastro na
                                        plataformaweb, bem como responsáveis também pelos dados dos itens registrados no
                                        sistema para doação;</li>
                                        <li>A doação será realizada através do contato com as cooperativas parceiras
                                        associadas à plataforma GACO, não haverá encargos no caso de pessoas físicas e
                                        coletivos (condomínios, entidades sem fins lucrativos, grupos organizados e etc), no
                                        caso de entidades com fins lucrativos será encargado o valor de R$4,50 por quilômetro
                                        (diferença de ida e volta do local de coleta e cooperativa que fará a coleta);</li>
                                        <li>Os resíduos sólidos recicláveis serão coletados, transportados, triados,
                                        transportados e comercializados diretamente pelas cooperativas parceiras da
                                        plataformaweb GACO. Não tendo o doador direitos sobre sua doação a posteriori;</li>
                                        <li>Está excluído do presente termo os resíduos não recicláveis ou que se sujeitem, nos
                                        termos de legislação vigente, a um tratamento específico fora do eixo de especialidade
                                        das cooperativas;</li>
                                        <p></p>
                                        <p><strong>Constitui obrigação da Associação/Cooperativa:</strong></p>
                                        <li>Cumprir a legislação federal, estadual e municipal aplicável à sua atividade, bem
                                        como, todas as determinações e resoluções dos órgãos da Administração Pública
                                        competentes e demais entidades de fiscalização, responsabilizando-se por todo e
                                        qualquer ônus decorrente da sua não observância:
                                            <ol type="a">
                                                <li>dar a correta destinação aos resíduos sólidos recicláveis que lhe estão sendo
                                                entregues através da demanda gerada pelo usuário da plataforma web GACO;</li>
                                                <li>emitir comprovante de destinação dos resíduos doados, caso o doador faça
                                                requisição deste documento;</li>

                                                <li>exigir que seus associados/cooperados utilizem equipamentos adequados ao
                                                desenvolvimento se sua atividade e que estejam devidamente identificados
                                                durante o período que permanecerem na GACO;
                                                <li>observar os regimentos e normas internas do contrato de parceria entre GACO;</li>
                                                <li>aplicar o montante financeiro oriundo da reciclagem dos resíduos em prol da
                                                coletividade dos catadores de acordo com regimento interno da cooperativa e
                                                legislação pertinente</li>
                                                <li>permitir a fiscalização, a qualquer tempo, pela GACO no que concerne ao objeto
                                                do presente termo de parceria das atividades pertinentes à
                                                Associação/Cooperativa;</li>
                                                <li>não transferir a outrem, no todo ou em parte, o objeto doado, respeitando a
                                                destinação correta dos objetos recebidos.</li>
                                            </ol>
                                        </li>
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
