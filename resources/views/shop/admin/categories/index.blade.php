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
					<a href="{{ route('shop.admin.categories.create') }}" class="btn btn-primary">
						Добавить новую категорию
					</a>
				</nav>
				<div class="card">
					<div class="card-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Категория</th>
									<th>Родитель</th>
								</tr>
							</thead>
							<tbody>
								@foreach($paginator as $item)
									@php /** @var \App\Models\Category $item */ @endphp
									<tr>
										<td>{{ $item->id }}</td>
										<td>
											<a href="{{ route('shop.admin.categories.edit', $item->id) }}">{{ $item->title }}</a>
										</td>
										<td @if(in_array($item->parent_id, [0])) style="color: grey;" @endif>
											{{ $item->parent_id }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		@if($paginator->total() > $paginator->count())
			<br />
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							{{ $paginator->links() }}
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
@endsection