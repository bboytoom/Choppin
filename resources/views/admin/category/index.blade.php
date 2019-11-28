@extends('admin.template')

@section('content')

	<section class="row">
		<div class="col-md-12">
			<h1>
				<i class="fa fa-shopping-cart"></i> CATEGORÍAS 
				<a href="{{ route('admin.category.create') }}" class="btn btn-warning">
				<i class="fa fa-plus-circle"></i> Categoría</a>
			</h1>
		</div>

		<div class="col-md-12 mt-5">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Editar</th>
						<th>Eliminar</th>
						<th>Nombre</th>
						<th>Descripción</th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $category)
					<tr>
						<td>
							<a href="{{ route('admin.category.edit', $category) }}" class="btn btn-primary">
								<i class="fas fa-edit"></i>
							</a>
						</td>
						<td>
							{!! Form::open(['route' => ['admin.category.destroy', $category]]) !!}
								<input type="hidden" name="_method" value="DELETE">
								<button onClick="return confirm('Eliminar registro?')" class="btn btn-danger">
									<i class="fas fa-trash-alt"></i>
								</button>
							{!! Form::close() !!}
						</td>
						<td>{{ $category->name }}</td>
						<td>{{ $category->description }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</section>

@endsection