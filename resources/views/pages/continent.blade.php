@extends('layouts.main_template')

@section('content')
	
	
	<section>
		<div class="container">
			<div class="row">
				@if(!empty($arResult))
					@foreach($arResult as $value)
					<div> 
						<a href="/{{ $value['name'] }}">{{ json_decode($value['content'])->ru->title }}</a>
					</div>
					@endforeach
				@endif
			</div>
		</div>
	</section>


@endsection  
