@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="panel panel-default">

			<div class="panel-heading">@lang('app.request')</div>
			
			<div class="panel-body">
				 	<form class="form-horizontal" role="form" method="POST" action="{{ url('/request') }}" onkeypress="return event.keyCode != 13;">
						{{ csrf_field() }}

                        @include('layouts.messages')
                        <div class="parent">
                            <div class="repeatable">
            					<div class="form-group{{ $errors->has('id_garbage_1') ? ' has-error' : '' }}">
            							<label class="col-md-3 control-label">@lang('app.residue')</label>
            	                    <div class="col-md-7">
            							<select class="form-control" id="id_garbage_1" name="id_garbage_1">
            					 		@foreach ($garbage as $garbage)
            		                    	<option value={{$garbage->id_garbage}}>{{$garbage->nm_garbage}}</option>
            		                    @endforeach
            							</select>
            						</div>                   
                                </div>

                                <div style="display:none" id="status_tv_1" class="form-group{{ $errors->has('status_tv_1') ? ' has-error' : '' }}">
                                    <label for="status_tv_1" class="col-md-3 control-label">@lang('app.condition')</label>

                                    <div class="col-md-7">
                                        <select class="form-control" name="status_tv_1" id="status_tv_1">
                                            <option>@lang('app.open')</option>
                                            <option>@lang('app.closed')</option>
                                        </select>
                                        @if ($errors->has('status_tv_1'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status_tv_1') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div style="display:none" id="status_cpu_1" class="form-group{{ $errors->has('status_cpu_1') ? ' has-error' : '' }}">
                                    <label for="status_cpu_1" class="col-md-3 control-label">@lang('app.condition')</label>

                                    <div class="col-md-7">
                                        <select class="form-control" name="status_cpu_1" id="status_cpu_1">
                                            <option>@lang('app.complete')</option>
                                            <option>@lang('app.incomplete')</option>
                                        </select>
                                        @if ($errors->has('status_cpu_1'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status_cpu_1') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div id="others_cpu_1" name="others_cpu_1" style="display:none" class="form-group{{ $errors->has('others_cpu_1') ? ' has-error' : '' }}">
                                    <div class="col-md-7 col-md-offset-3">
                                        <p class="danger-box-request ">@lang('app.cpudescription')</p>
                                    </div>

                                    <label for="others_cpu_1" class="col-md-3 control-label">@lang('app.description')</label>

                                    <div class="col-md-7">
                                        <input id="others_cpu_1" type="text" class="form-control" name="others_cpu_1" placeholder="Descrição dos componentes que faltam" value="{{ old('others_cpu_1') }}">

                                        @if ($errors->has('others_cpu_1'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('others_cpu_1') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div id="other_1" style="display:none" class="form-group{{ $errors->has('other_1') ? ' has-error' : '' }}">
                                    <div class="col-md-7 col-md-offset-3">
                                        <p class="danger-box-request ">@lang('app.equipamentstext')</p>
                                    </div>

                                    <label for="other_1" class="col-md-3 control-label">@lang('app.equipament')</label>

                                    <div class="col-md-7">
                                        <input id="other_1" type="text" class="form-control" name="other_1" placeholder="Descreva qual resíduo quer doar" value="{{ old('other_1') }}">

                                        @if ($errors->has('other_1'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('other_1') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('quantity_1') ? ' has-error' : '' }}">
            					    <label for="quantity_1" class="col-md-3 control-label">@lang('app.quantity')</label>

                                    <div class="col-md-7">
                                        <input id="quantity_1" type="text" class="form-control" name="quantity_1" placeholder="Escreva um número" value="1" required>

                                        @if ($errors->has('quantity_1'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('quantity_1') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('observation_1') ? ' has-error' : '' }}">
                                    <label for="observation_1" class="col-md-3 control-label">@lang('app.observation')</label>

                                    <div class="col-md-7">
                                        <input id="observation_1" type="text" maxlength="140" class="form-control" name="observation_1" placeholder="Alguma observação sobre o equipamento" value="{{ old('observation_1') }}">

                                        @if ($errors->has('observation_1'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('observation_1') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <p class="col-md-7 col-md-offset-3 text-center division-line">----------------------</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                            <a input="button" id="btn-repeat" class="btn btn-default btn-block">@lang('app.addanotherresidue')</a>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address" class="col-md-3 control-label">@lang('app.requestaddress')</label>

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
                                                <option value="{{ url('/settings')}}" id="new_address"> @lang('app.addanotheraddress')</option>
                                            @endif
                                        </select>
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3 text-center">@lang('app.choosedays')</div>
                        </div>

                        <div class="form-group{{ $errors->has('weekdays') ? ' has-error' : '' }}">
                            <label for="weekdays" class="col-md-3 control-label">@lang('app.days')</label>
                            <div class="col-md-7">
                                <div class="btn-group btn-group-justified" id="weekcheckbox" data-toggle="buttons">
                                    <label class="btn btn-default hidden"><input type="checkbox" name="domingo" value="1" required>@lang('app.sunday')</label>
                                    <label class="btn btn-default"><input type="checkbox" name="segunda" value="1" required>@lang('app.monday')</label>
                                    <label class="btn btn-default"><input type="checkbox" name="terça" value="1" required>@lang('app.tuesday')</label>
                                    <label class="btn btn-default"><input type="checkbox" name="quarta" value="1" required>@lang('app.wednesday')</label>
                                    <label class="btn btn-default"><input type="checkbox" name="quinta" value="1" required>@lang('app.thursday')</label>
                                    <label class="btn btn-default"><input type="checkbox" name="sexta" value="1" required>@lang('app.friday')</label>
                                    <label class="btn btn-default hidden"><input type="checkbox" name="sabado" value="1" required>@lang('app.saturday')</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('period') ? ' has-error' : '' }}">
                            <label for="period" class="col-md-3 control-label">@lang('app.period')</label>
                            <div class="col-md-7">
                                <div class="btn-group btn-group-justified" id="periodcheckbox" data-toggle="buttons">
                                    <label class="btn btn-default"><input type="checkbox" name="manha" value="1" id="checkbox_manha" required>@lang('app.morning')</label>
                                    <label class="btn btn-default"><input type="checkbox" name="tarde" value="1" id="checkbox_tarde"required>@lang('app.noon')</label>
                                    <label class="btn btn-default hidden"><input type="checkbox" name="noite" value="1" required>@lang('app.night')</label>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="counter" id="counter" value="1">

                        <div class="row">
                            <div class="col-md-7 col-md-offset-3">
    	                    	<a input="button" id="checkBtn" data-toggle="modal" data-target="#confirmdonation" class="open-confirmdonation btn btn-primary btn-block">
    	                        	@lang('app.register')
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
                                            <li>Eu entendo que as cooperativas tem custo para coletar o meu resíduo, portanto me comprometo a cumprir a minha parte como doador;</li>
                                            <li>Devido a atenção especial dada ao setor, é <strong>taxado em R$ 4,50 cada KM</strong> que a cooperativa se deslocará até o endereço escolhida para a coleta;</li>
                                            <li>A taxação será calculada e cobrada pela própria cooperativa no ato da coleta e em dinheiro. De maneira que nenhuma transação será feita através da plataforma GACO</li>
                                            <li>A taxação resultará em uma certificação e termo de recolhimento do resíduo que foi coletado, entregue pela cooperativa após a coleta do resíduos;</li>
                                            <li>Ao confirmar seu pedido e coleta, você diz que entende, aceita e cumprirá com essa cobrança;</li>
                                        </ol>
                                        <p><strong>Ao confirmar seu pedido e coleta, você diz que entende, aceita e cumprirá com essa cobrança;</strong></p>
                                    @else
                                        <!-- COLETIVOS E PESSOAS FISICAS -->
                                        <p>Ao fazer a coleta, eu entendo que:</p>
                                        <ol>
                                            <li>Eu entendo que as cooperativas tem custo para coletar o meu resíduo, portanto me comprometo a cumprir a minha parte como doador;</li>
                                            <li>Estou doando de forma voluntária o meu resíduo sem receber qualquer remuneração e favor em troca;</li>
                                            <li>Não será cobrado nenhum tipo de taxa, ou seja, o serviço prestado por essa forma é totalmente gratuito;</li>
                                            <li>Entendo que posso cancelar ou adiar os meus pedidos, e o farei mediante justificativa e com requisição com pelo menos um dia de antecedência da coleta pré-agendada.</li>
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
    $(document).on('change', '[id^="id_garbage"]', function() {
        var tmp = $(this).prop('id').split('_');
        var num = tmp[tmp.length-1];

        if ($(document).find('#id_garbage_'+num).find(":selected").attr('value')=="15") {
            $('#status_tv_'+num).show();
            $('#other_'+num).hide();
            $('#status_cpu_'+num).hide();
            $('#others_cpu_'+num).hide();
            $("#others_cpu_"+num).find("input").prop('required',false);

        }
        else if ($(document).find('#id_garbage_'+num).find(":selected").attr('value')=="3") {
            $('#status_cpu_'+num).show();
            $('#other_'+num).hide();
            $('#status_tv_'+num).hide();
            $('#others_cpu_'+num).hide();
            $("#others_cpu_"+num).find("input").prop('required',false);

        }
        else if ($(document).find('#id_garbage_'+num).find(":selected").attr('value')=="17") {
            $('#other_'+num).show();
            $('#status_tv_'+num).hide(); 
            $('#status_cpu_'+num).hide();
            $('#others_cpu_'+num).hide();
            $("#others_cpu_"+num).find("input").prop('required',false);
        }
        else {
            $('#status_tv_'+num).hide();   
            $('#other_'+num).hide();
            $('#status_cpu_'+num).hide();
            $('#others_cpu_'+num).hide();
            $("#others_cpu_"+num).find("input").prop('required',false);
        }        

    });

    document.querySelector('[id^="status_cpu"]').onclick = function() {
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

    $(document).ready(function () {
        $('#checkBtn').click(function() {
            checked = $("input[type=checkbox]:checked").length;
            
            count = 0;
            if(document.getElementById('checkbox_manha').checked){
                count = count + 1
            }
            if(document.getElementById('checkbox_tarde').checked){
                count = count + 1
            }


            if(checked > 0 + count && count != 0) {
                $("input[type=checkbox]").removeAttr('required');
            }
            else {
                //alert("You must check at least one checkbox.");
                $('#weekcheckbox').attr('style', "border-radius: 5px; border:#B63131 1px solid;");
                $('#periodcheckbox').attr('style', "border-radius: 5px; border:#B63131 1px solid;");
                return false;
            }

        });
    });

    $(document).on('click', '#btn-repeat', function (e) {
        e.preventDefault();
        var target = $('.parent').children('div:first').clone();

        var counter = parseInt($(document).find('#counter').prop('value'), 10);
        $(document).find('#counter').prop('value',counter + 1);

        var num = counter + 1;

        

        target.find("[name^=id_garbage]").prop('name', 'id_garbage_'+num );
        target.find("[name^=quantity]").prop('name', 'quantity_'+num );
        target.find("[name^=observation]").prop('name', 'observation_'+num );
        target.find("[name^=status_tv]").prop('name', 'status_tv_'+num );
        target.find("[name^=status_cpu]").prop('name', 'status_cpu_'+num );
        target.find("[name^=others_cpu]").prop('name', 'others_cpu_'+num );
        target.find("[name^=other_]").prop('name', 'other_'+num );

        target.find("[id^=id_garbage]").prop('id', 'id_garbage_'+num );
        target.find("[id^=quantity]").prop('id', 'quantity_'+num );
        target.find("[id^=observation]").prop('id', 'observation_'+num );
        target.find("[id^=status_tv]").prop('id', 'status_tv_'+num );
        target.find("[id^=status_cpu]").prop('id', 'status_cpu_'+num );
        target.find("[id^=others_cpu]").prop('id', 'others_cpu_'+num );
        target.find("[id^=other_]").prop('id', 'other_'+num );


        $('.repeatable').parent('div.parent').append( target );

        $('#status_tv_'+num).hide();   
        $('#other_'+num).hide();
        $('#status_cpu_'+num).hide();
        $('#others_cpu_'+num).hide();
        $("#others_cpu_"+num).find("input").prop('required',false);
    });

    $(document).on('keydown', '[id^="quantity"]', function(e){
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                 // Allow: Ctrl/cmd+A
                (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                 // Allow: Ctrl/cmd+C
                (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                 // Allow: Ctrl/cmd+X
                (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                 // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
</script>
@endsection
