@extends('layouts.app')

@section('content')
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
			<div class="col-md-12">
				<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
					<a href="{{ route('shop.admin.sizes.create') }}" class="btn btn-primary">
						Добавить новый размер
					</a>
				</nav>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Размер</th>
						</tr>
					</thead>
					<tbody>
						@foreach($paginator as $item)
							@php /** @var \App\Models\Size $item */ @endphp
							<tr>
								<td>{{ $item->id }}</td>
								<td>
									<a href="{{ route('shop.admin.sizes.edit', $item->id) }}">
										{{ $item->name }}
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div>
@endsection