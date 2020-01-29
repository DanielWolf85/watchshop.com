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
					<a href="{{ route('shop.admin.products.create') }}" class="btn btn-primary">
						Добавить продукт
					</a>
				</nav>
				<div class="card">
					<div class="card-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Продукт</th>
									<th>Категория</th>
									<th>Бренд</th>
									<th>Размер</th>
									<th>Цвет</th>
									<th>Цена</th>
									<th>Описание</th>
									<th>Дата добавления</th>
								</tr>
							</thead>
							<tbody>
								@foreach($paginator as $item)
								@php /** @var \App\Models\Product $item */ @endphp
									<tr @if(! $item->is_published) style="background-color: #ccc;" @endif>
										<td>{{ $item->id }}</td>
										<td>
											<a href="{{ route('shop.admin.products.edit', $item->id) }}">
												{{ $item->product_name }}
											</a>
										</td>
										<td>{{ $item->category->title }}</td>
										<td>{{ $item->brand->name }}</td>
										<td>{{ $item->size->name }}</td>
										<td>{{ $item->color->name }}</td>
										<td>{{ $item->price }}</td>
										<td>{{ $item->description }}</td>
										<td>{{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d,M H:i') : '' }}</td>
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