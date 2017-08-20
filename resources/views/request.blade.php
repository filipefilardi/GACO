@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="panel panel-default">

			<div class="panel-heading">@lang('app.request')</div>
			
			<div class="panel-body">
				 	<form class="form-horizontal" role="form" method="POST" action="{{ url('/request') }}">
						{{ csrf_field() }}

                        @include('layouts.messages')

    					<div class="form-group{{ $errors->has('id_garbage') ? ' has-error' : '' }}">
    							<label class="col-md-3 control-label">Resíduo</label>
    	                    <div class="col-md-7">
    							<select class="form-control" id="id_garbage" name="id_garbage">
    					 		@foreach ($garbage as $garbage)
    		                    	<option value={{$garbage->id_garbage}}>{{$garbage->nm_garbage}}</option>
    		                    @endforeach
    							</select>
    						</div>                   
                        </div>

                        <div style="display:none" id="status_tv" class="form-group{{ $errors->has('status_tv') ? ' has-error' : '' }}">
                            <label for="status_tv" class="col-md-3 control-label">Condição</label>

                            <div class="col-md-7">
                                <select class="form-control" name="status_tv" id="status_tv">
                                    <option>Aberta</option>
                                    <option>Fechada</option>
                                </select>
                                @if ($errors->has('status_tv'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status_tv') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div style="display:none" id="status_cpu" class="form-group{{ $errors->has('status_cpu') ? ' has-error' : '' }}">
                            <label for="status_cpu" class="col-md-3 control-label">Condição</label>

                            <div class="col-md-7">
                                <select class="form-control" name="status_cpu" id="status_cpu">
                                    <option>Completa</option>
                                    <option>Incompleta</option>
                                </select>
                                @if ($errors->has('status_cpu'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status_cpu') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div id="others_cpu" name="others_cpu" style="display:none" class="form-group{{ $errors->has('others_cpu') ? ' has-error' : '' }}">
                            <div class="col-md-7 col-md-offset-3">
                                <p class="danger-box-request "> Pela CPU estar incompleta, por favor, nos informe os componentes que faltam. </p>
                            </div>

                            <label for="others_cpu" class="col-md-3 control-label">Descrição</label>

                            <div class="col-md-7">
                                <input id="others_cpu" type="text" class="form-control" name="others_cpu" placeholder="Descrição dos componentes que faltam" value="{{ old('others_cpu') }}">

                                @if ($errors->has('others_cpu'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('others_cpu') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div id="others" style="display:none" class="form-group{{ $errors->has('others') ? ' has-error' : '' }}">
                            <div class="col-md-7 col-md-offset-3">
                                <p class="danger-box-request ">Alguns equipamentos, como lâmpadas, baterias, cartuchos e toners de impressora, podem não ser recolhidos, porém incentivamos o cadastro dos mesmos.</p>
                            </div>

                            <label for="others" class="col-md-3 control-label">Equipamento</label>

                            <div class="col-md-7">
                                <input id="others" type="text" class="form-control" name="others" placeholder="Descreva qual resíduo quer doar" value="{{ old('others') }}">

                                @if ($errors->has('others'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('others') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
    					    <label for="quantity" class="col-md-3 control-label">Quantidade</label>

                            <div class="col-md-7">
                                <input id="quantity" type="text" class="form-control" name="quantity" placeholder="Escreva um número" value="1" required>

                                @if ($errors->has('quantity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('observation') ? ' has-error' : '' }}">
                            <label for="observation" class="col-md-3 control-label">Observação</label>

                            <div class="col-md-7">
                                <input id="observation" type="text" maxlength="50" class="form-control" name="observation" placeholder="Alguma observação sobre o equipamento" value="{{ old('observation') }}">

                                @if ($errors->has('observation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('observation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-3 control-label">Endereço de coleta</label>

                            <div class="col-md-7">
                                <select class="form-control" autofocus name="id_add" id="id_add" onchange="myFunction()">
                                    @if(is_null($addresses))
                                    @else 
                                        @foreach ($addresses as $address)
                                            @if($address->main_address === 1)
                                                <option selected value={{$address->id_add}}>{{$address->str_address}}</option>
                                            @else
                                                <option value={{$address->id_add}}>{{$address->str_address}}</option>
                                            @endif
                                            
                                        @endforeach
                                        <option value="{{ url('/settings')}}" id="new_address"> Adicionar outro endereço para ser feita a coleta </option>
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
                            <div class="col-md-7 col-md-offset-3">
    	                    	<a data-toggle="modal" data-target="#confirmdonation" class="open-confirmdonation btn btn-primary btn-block">
    	                        	Registrar
    	                    	</a>
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
                            <div class="col-md-7 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
    -->

                        <!-- MODAL -->
                       <div id="confirmdonation" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header text-center"><h1>Termos de Coleta</h1></div>
                                    <div class="modal-body" style=" text-align: justify;text-justify: inter-word; font-size: 17px;">
                                    @if(Auth::user()->id_cat == 2)
                                        <!-- PESSOAS JURIDICAS -->
                                        <p>Apenas para pessoas jurídicas, as seguintes condições são necessárias para efetuar uma doação:</p>
                                        <ol>
                                            <li>Devido a atenção especial a doação, é necessario <strong>taxar R$ 4,50 cada KM</strong> que a cooperativa se deslocará até o endereço escolhido da pessoa júridica;</li>
                                            <li>A taxação será cobrada no ato da coleta pela própria cooperativa. De maneira que nenhuma transação seja feita pela plataforma GACO;</li>
                                            <li>A taxação resultará em uma certicação de que seu resíduo foi coletado, também entregue na coleta;</li>
                                        </ol>
                                        <p><strong>Ao confirmar seu pedido e coleta, você diz que entende, aceita e cumprirá com essa cobrança;</strong></p>
                                    @else
                                        <!-- COLETIVOS E PESSOAS FISICAS -->
                                        <p>Ao fazer a coleta, eu entendo que:</p>
                                        <ol>
                                            <li>Estou doando de forma voluntária o meu eletrônico sem receber qualquer remuneração em troca;</li>
                                            <li>Não será cobrado nenhum tipo de taxa, ou seja, o serviço prestado por essa forma é totalmente gratuito;</li>
                                            <li>Eu entendo que as cooperativas tem um custo para coletar o meu resíduo, portanto me comprometo a cumprir a minha parte como doador;</li>
                                            <li>Entendo que posso cancelar ou adiar os meus pedidos, e o farei mediante a justificativa e com pelo menos um dia de antecedência a coleta.</li>
                                        </ol>
                                    @endif
                                        <button class="btn btn-primary btn-block">Confirmar Coleta</button>
                                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar Coleta</button>

                                    </div>
                                </div>                
                            </div>
                        </div>
                   </form>
			</div>
		</div>
	</div>
</div>

<script>
    document.getElementById("id_garbage").onchange = function() {
        if ($('#id_garbage').find(":selected").attr('value')=="15") {
            $('#status_tv').show();
            $('#others').hide();
            $('#status_cpu').hide();
            $('#others_cpu').hide();
            $("#others_cpu").find("input").prop('required',false);

        }
        else if ($('#id_garbage').find(":selected").attr('value')=="3") {
            $('#status_cpu').show();
            $('#others').hide();
            $('#status_tv').hide();
            $('#others_cpu').hide();
            $("#others_cpu").find("input").prop('required',false);

        }
        else if ($('#id_garbage').find(":selected").attr('value')=="17") {
            $('#others').show();
            $('#status_tv').hide(); 
            $('#status_cpu').hide();
            $('#others_cpu').hide();
            $("#others_cpu").find("input").prop('required',false);
        }
        else {
            $('#status_tv').hide();   
            $('#others').hide();
            $('#status_cpu').hide();
            $('#others_cpu').hide();
            $("#others_cpu").find("input").prop('required',false);
        }        
    };

    document.getElementById("status_cpu").onchange = function() {
        if($('#status_cpu').find(":selected").text() == "Incompleta"){
            $("#others_cpu").show();
            $("#others_cpu").find("input").prop('required',true);
        }else{
            $('#others_cpu').hide();
            $("#others_cpu").find("input").prop('required',false);
        }
    };

    document.getElementById("id_add").onchange = function() {
        if ($('#id_add').find(":selected").attr('id')=="new_address") {
            window.location.href = this.value;
        }        
    };
</script>
@endsection
