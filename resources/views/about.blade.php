@extends('layouts.app')

@section('stylesheet')
    <link href="/css/carousel.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

		<div class="panel-heading">@lang('app.about')</div>
		<div class="panel panel-default">
				<div class="panel-body center-block text-center">			
					<div class="about-page">
					    <p>@lang('app.sourcecoderepository')</a>.
					    </p>

					    <h3 style="margin-left: 25px;">@lang('app.cofounders')</h3>
					    <ul>
					        <li>Filipe Filardi de Jesus</li>
					        <li>Sabrina Gonçalves Raimundo</li>
					        <li>Thiago Nobayashi</li>
					        <li>Victor Edoardo Garcia Ribeiro Valeriano</li>
					    </ul>

<!-- 					    <h3>@lang('app.developers')</h3>
					    <ul>
					        <li>Filipe Filardi de Jesus</li>
					        <li>Thiago Nobayashi</li>
					        <li>Victor Edoardo Garcia Ribeiro Valeriano</li>
							<li>Novos desenvolvedores</li>
					        <li>Novos desenvolvedores</li>
					        <li>Novos desenvolvedores</li>
					        <li>Novos desenvolvedores</li>
							
					    </ul> -->
		
						<div class="coops">
					    	<h3>@lang('app.partners')</h3>
					    	<div class="row">
					    		<div class="col-md-6">
									<a href="http://www.lassu.usp.br"><img src="/img/lassu_logo.png" class="img-responsive img-center"></a>
								</div>
					    		<div class="col-md-6">
									<a href="https://www.recifavela.com.br/"><img src="/img/recifavela_logo.png" class="img-responsive img-center"></a>
								</div>
							</div>
							<div class="row">
					    		<div class="col-md-6">
									<a href="http://www.institutogea.org.br/"><img src="/img/igea_logo.png" class="img-responsive img-center"></a>
								</div>
					    		<div class="col-md-6">
									<a href="https://www.coopernovacotiarecicla.com/"><img src="/img/coopernova_logo.png" class="img-responsive img-center"></a>
					    		</div>
					    	</div>
					    </div>
					
					</div>
				</div>
	
			</div>
			</div>
		</div>
	</div>
</div>
@endsection
