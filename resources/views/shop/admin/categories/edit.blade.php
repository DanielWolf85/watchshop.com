@extends('layouts.app')

@section('content')
	@php
		/** @var \App\Models\Category $item */
	@endphp
	<form action="{{ route('shop.admin.categories.update', $item->id) }}" method="POST">
		@method('PATCH')
		@csrf
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					@include('shop.admin.categories.includes.item_edit_main_col')
				</div>
				<div class="col-md-3">
					@include('shop.admin.categories.includes.item_edit_add_col')
				</div>
			</div>
		</div>
	</form>
@endsection