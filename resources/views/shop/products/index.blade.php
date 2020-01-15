@extends('layouts.app')

@section('content')

<table>
	@foreach($items as $item)
		<tr>
			<td>{{ $item->id }}</td>
			<td>{{ $item->product_name }}</td>
			<td>{{ $item->price }}</td>
		</tr>
	@endforeach
</table>

@endsection