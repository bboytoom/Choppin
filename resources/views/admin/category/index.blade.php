@extends('admin.template')

@section('content')

	<h1 class="h3 mb-2 text-gray-800 mb-4">Categorias</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-right">
			<a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-white-50">
                  <i class="fa fa-plus-circle"></i>
                </span>
                <span class="text">Agregar</span>
            </a>
        </div>

        <div class="card-body">
			@if ($categories->count() === 0)
				<h4 class="text-center">No cuentas con categorias</h4> 
			@else
				<div class="table-responsive">
					<table id="caracteristicas" class="table table-bordered table-hover" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Descripción</th>
								<th class="text-center">Editar</th>
								<th class="text-center">Eliminar</th>
							</tr>
						</thead>
						<tbody>
							@foreach($categories as $category)
								<tr>
									<td>{{ $category->name }}</td>
									<td>{{ $category->description }}</td>
									<td class="text-center">
										<a href="{{ route('admin.category.edit', $category) }}" class="btn btn-warning btn-circle">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
									</td>
									<td class="text-center">
										{!! Form::open(['route' => ['admin.category.destroy', $category]]) !!}
											<input type="hidden" name="_method" value="DELETE">
											<button type="submit" onClick="return confirm('Eliminar registro?')" class="btn btn-danger btn-circle">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@endif
        </div>
    </div>

@endsection