@extends('layouts.app')

@section('content')
	@php /** @var \App\Models\Product $item */ @endphp
	
	@if($item->exists)
		<form action="{{ route('shop.admin.products.update', $item->id) }}" method="POST">
			@method('PATCH')
	@else
		<form action="{{ route('shop.admin.products.store') }}" method="POST">
	@endif

		@csrf
			<div class="container">
				
				@if($errors->any())
					<div class="row justify-content-center">
						<div class="col-md-11">
							<div class="alert alert-danger" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">x</span>
								</button>
									{{ $errors->first() }}
							</div>
						</div>
					</div>
				@endif

				@if(session('success'))
					<div class="row justify-content-center">
						<div class="col-md-11">
							<div class="alert alert-success" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">x</span>
								</button>
									{{ session()->get('success') }}
							</div>
						</div>
					</div>
				@endif

				<div class="row justify-content-center">
					<div class="col-md-8">
						@include('shop.admin.products.includes.item_edit_main_col')
					</div>
					<div class="col-md-3">
						@include('shop.admin.products.includes.item_edit_add_col')
					</div>
				</div>

			</div>
		</form>
@endsection