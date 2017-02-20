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
			 Bem vindo {{ Auth::user()->name }}!

		        @if(Auth::user()->category == 0)
		            @if($customers->isEmpty())
		                <p>Não há nenhuma cooperativa cadastrada no momento.</p>
		            @else
		                <p>Cooperativas disponíveis para coleta:</p>
				        <div class="container">
				            @foreach ($customers as $customer)
				            	<form action="make_request" method="post">
	                        		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					                <button type="submit" class="btn btn-primary" name="id_code" value={{ $customer->id_code }}>
					                {{ $customer->name }}
					                </button>
				            	</form>
				        </div>
				            @endforeach
		            @endif
	            @else
		            @if($notifications->isEmpty())
		                <p>Não há nenhuma notificação no momento.</p>
		            @else
		            	<p>Notificações recentes:</p>
				        <div class="container">
				            @foreach ($notifications as $notification)
				            	<form action="" method="post">
	                        		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					                <button type="submit" class="btn btn-primary" name="id_code" value={{ $notification->id_code }}>
					                {{ $notification->name }}
					                </button>
				            	</form>
				        </div>
				            @endforeach
		            @endif
	            @endif

			</div>

			</div>
		</div>
	</div>
</div>
@endsection
