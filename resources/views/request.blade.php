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

                        <div style="display:none" id="status_tv" class="form-group{{ $errors->has('status_garbage') ? ' has-error' : '' }}">
                            <label for="status_garbage" class="col-md-3 control-label">Condição</label>

                            <div class="col-md-7">
                                <select class="form-control" name="status_garbage" id="status_garbage">
                                    <option>Aberta</option>
                                    <option>Fechada</option>
                                </select>
                                @if ($errors->has('status_garbage'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status_garbage') }}</strong>
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
                                <input id="observation" type="text" class="form-control" name="observation" placeholder="Alguma observação sobre o equipamento" value="{{ old('observation') }}" required>

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
    	                    	<button type="submit" class="btn btn-primary btn-block">
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

        }
        else if ($('#id_garbage').find(":selected").attr('value')=="17") {
            $('#others').show();
            $('#status_tv').hide(); 
        }
        else {
            $('#status_tv').hide();   
            $('#others').hide();
        }        
    };

    document.getElementById("id_add").onchange = function() {
        if ($('#id_add').find(":selected").attr('id')=="new_address") {
            window.location.href = this.value;
        }        
    };
</script>
@endsection
