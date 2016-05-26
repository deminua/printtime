@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			@if(count($products))
				@foreach($products as $product)
		            <div class="panel panel-default">
		                	<div class="panel-heading">{{ $product->name }}</div>
							<div class="panel-body">
								@if(count($product->imgs))
									<a href="{!! route('product.show', $product->id) !!}"><img src="{{ $product->imgs[0]['path'] }}"></a>
								@endif
		                	</div>
		            </div>
				@endforeach
			@endif
        </div>
    </div>
</div>
@endsection