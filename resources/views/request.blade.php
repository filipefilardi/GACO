@extends('layouts.app')

@section('stylesheet')
    <link href="/css/carousel.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			
			<div class="panel-heading">Dashboard</div>
			
			<div class="panel-body">
			 	<form class="form-horizontal" role="form" method="POST" action="{{ url('/request') }}">
					{{ csrf_field() }}

					<div class="row">
	                    <div class="col-md-6">
							<label>Escolha uma categoria</label>
							<select class="form-control" name="garbage">
					 		@foreach ($garbage as $garbage)
		                    	<option value={{$garbage->id_garbage}}>{{$garbage->nm_garbage}}</option>
		                    @endforeach
							</select>
						</div>                   
                    </div>
                    <div class="row">
	                    <div class="col-md-6">
	                    	<button type="submit" class="btn btn-primary">
	                        	Registrar
	                    	</button>
	                    </div>
	                 </div>
                </form>

			</div>

			</div>
		</div>
	</div>
</div>
@endsection
