@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
		            <div class="panel panel-default">
		                	<div class="panel-heading">{{ $product->name }}</div>
							<div class="panel-body">

		<form action="/img/{{ $product->id }}/upload" class="dropzone" d="my-awesome-dropzone">
			{{ csrf_field() }}
		</form>

								@foreach($product->imgs as $img)
									<h3>{!! $img->name !!}</h3>
									<img src="/files/images/thumbnail/{{ $img->filename }}">
								@endforeach
		                	</div>
		            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
@endsection