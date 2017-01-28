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
	                <a href="{{ url('/') }}">
	                    link pessoa física
	                </a>
	            @else
	                <a href="{{ url('/home') }}">
	                    link pessoa jurídica
	                </a>
	            @endif

			</div>
			
			</div>
		</div>
	</div>
</div>
@endsection
