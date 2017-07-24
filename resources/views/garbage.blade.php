@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				
				<div class="panel-heading">@lang('app.ewaste')</div>
				<div class="panel-body">
				 	
					 <p>@lang('app.whydonate')</p>
					 <p class="text-justify">@lang('app.ewastetext')</p>

					
					 <a href="{{ url('/home') }}" class="btn btn-primary btn-block"  style="margin-bottom: 15px">@lang('app.wannacontribute')</a>

					 <p>@lang('app.discoveryallresidues')</p>
					 <ul class="list-group">
					  @foreach ($garbage as $garbage)
					  	<li class="list-group-item">{{$garbage->nm_garbage}}</li>
					  @endforeach
					</ul>

					<a href="{{ url('/home') }}" class="btn btn-primary btn-block">@lang('app.wannacontribute')</a>
				</div>
			
			</div>
		</div>
	</div>
</div>
@endsection
