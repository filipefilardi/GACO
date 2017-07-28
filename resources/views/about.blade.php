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
				<div class="panel-body">			

				    <p>O código fonte pode ser encontrado <a href="https://github.com/filipefilardi/GACO" target="_blank">neste repositório</a>.
				    </p>

				    <h3>Co-Fundadores</h3>
				    <ul>
				        <li>Filipe Filardi de Jesus</li>
				        <li>Sabrina Gonçalves Raimundo</li>
				        <li>Thiago Nobayashi</li>
				        <li>Victor Edoardo Garcia Ribeiro Valeriano</li>
				    </ul>

				    <h3>Desenvolvedores</h3>
				    <ul>
				        <li>Filipe Filardi de Jesus</li>
				        <li>Thiago Nobayashi</li>
				        <li>Victor Edoardo Garcia Ribeiro Valeriano</li>
				    </ul>
	
					<!--
					<h3>Colaboradores</h3>
					<ul>
				        <li>Novos colaboradores</li>
				        <li>Novos colaboradores</li>
				        <li>Novos colaboradores</li>
				        <li>Novos colaboradores</li>
				    </ul>

					-->
				    <h3>Parcerias</h3>
				    <ul style="list-style-type: none;">
				    	<!-- 
				    	<div class="logos">
					    	<li><img src="img/coopernova_logo.png" class="img-responsive"></li>
					    	<li><img src="img/recifavela_logo.jpg" class="img-responsive"></li>
					    	<li><img src="img/gea_logo.png" class="img-responsive"></li>
					    	<li><img src="img/vaitec_logo.jpg" class="img-responsive"></li>
				    	</div>
 						-->
				    </ul>
					    <!--
							listar coops
					    -->

				</div>
	
			</div>
			</div>
		</div>
	</div>
</div>
@endsection
