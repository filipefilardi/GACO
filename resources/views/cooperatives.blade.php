@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="panel panel-default">
			
			<div class="panel-heading">@lang('app.cooperatives')</div>
			<div class="panel-body">
			
				<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="cooperative">
						<p>@lang('app.cooptextintro')</p>


			            <div id="coopernova">
			            	<div class="panel-heading">Coopernova</div>
			            	<div class="panel-body">
					            <img src="img/coopernova.jpg" class="img-responsive" style="margin: 0 auto">
								<div class="text-center grey-box">
					            	<p>R. Nova Pátria, 120 - Jardim Nova Cotia, Cotia - SP, 06700-538</p>
					            	<p>(11) 4243-1810</p>
					            	<p><a href="https://www.coopernovacotiarecicla.com" target="_blank">https://www.coopernovacotiarecicla.com</a></p>
			            		</div>
			            		<p>@lang('app.coopernovadescription')</p>
				            </div>
			            </div>


			            <div id="recifavela">
			           		<div class="panel-heading">Recifavela</div>
			           		<div class="panel-body">
					            <img src="img/recifavela.jpg" class="img-responsive" style="margin: 0 auto">
				           		<div class="text-center grey-box">
					            	<p>Rua Capitão Pacheco e Chaves, 108, Vila Prudente, São Paulo</p>
					            	<p>(11) 4243-1810</p>
					            	<p><a href="https://www.recifavela.com.br/" target="_blank">https://www.recifavela.com.br/</a></p>
				            	</div>
			            		<p>@lang('app.recifaveladescription')</p>
				            </div>
			            </div>

			            <h2 class="text-center" style="margin-top: 30px;">Faça parte</h2>

			            <p class="text-center">@lang('app.letscontribute')</p>
			            <a href="/request" class="btn btn-primary btn-block" >@lang('app.wannacontribute')</a>

		            </div>
		        </div>
	            </div>
			</div>
		</div>
	</div>
</div>
@endsection
