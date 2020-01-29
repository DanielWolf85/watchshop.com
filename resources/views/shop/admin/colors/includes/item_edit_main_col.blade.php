@php
	/** @var \App\Models\Product $item */
@endphp

<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="card-title"></div>
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">
							Основные данные
						</a>
					</li>
				</ul>
				<br />
				<div class="tab-content">
					<div class="tab-pane active" id="maindata" role="tabpanel">
						<div class="form-group">
							<label for="name">Имя цвета</label>
							<input type="text" name="name" value="{{ $item->name }}"
								id="name"
								class="form-control"
								minlength="3"
								required="required" 
							>
						</div>

						{{-- <div class="form-group">
							<label for="slug">Идентификатор</label>
							<input type="text" name="slug" value="{{ $item->slug }}"
								id="slug"
								class="form-control" 
							>
						</div>

						<div class="form-group">
							<label for="parent_id">Родитель</label>
							<select name="parent_id" 
								id="parent_id"
								class="form-control"
								placeholder="Выберите категорию"
								required="required" 
							>
								@foreach($categoriesList as $categoriesOption)
									<option value="{{ $categoriesOption->id }}"
										@if($categoriesOption->id == $item->parent_id) selected="selected" @endif>
										{{ $categoriesOption->id }}. {{ $categoriesOption->title }}		
									</option>
								@endforeach
							</select>
						</div> --}}

						{{-- <div class="form-group">
							<label for="description">Описание</label>
							<textarea name="description"
								id="description"
								class="form-control"
								cols="5" 
								rows="3"
							>
								{{ $item->description }}
							</textarea>
						</div> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
