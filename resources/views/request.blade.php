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

			 	<form class="form-horizontal" role="form" method="POST" action="{{ url('/home') }}">
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email">
                    </div>
                </form>

			</div>

			</div>
		</div>
	</div>
</div>
@endsection
