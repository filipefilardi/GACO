@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<!-- <div class="col-md-8 col-md-offset-2"> -->
			<div class="panel panel-default">
				
				<div class="panel-heading">@lang('app.ewaste')</div>
				<div class="panel-body text-justify">
				 	

				<p>@lang('app.ewastetext')</p>

				<div class="text-header">@lang('app.whydonate')</div>
				<p>@lang('app.whydonatetext')</p>			

				<img src="{{URL::asset('/img/picojaragua.jpg')}}" class="img-responsive" alt="Pico do Jaraguá">
				<p class="text-center" style="color: black; margin-top: 5px;">@lang('app.jaraguapicture')</p>

				<div class="text-header">@lang('app.health')</div>
				@lang('app.healthtext')

				<div class="text-header">@lang('app.responsabilitylaw')</div>
				@lang('app.responsabilitylawtext')

				<a href="{{ url('/home') }}" class="btn btn-primary btn-block"  style="margin-bottom: 15px">@lang('app.wannacontribute')</a>

				<div class="text-header">@lang('app.discoveryallresidues')</div>
				<ul class="list-group">
					@foreach ($garbage as $garbage)
						<a class="list-group-item text-center">{{$garbage->nm_garbage}}</a>
					@endforeach
				</ul>

					<a href="{{ url('/home') }}" class="btn btn-primary btn-block">@lang('app.wannacontribute')</a>
				</div>
			
			</div>
		<!-- </div> -->
	</div>
</div>
@endsection
