@extends('admin.template')

@section('content')

	<h1 class="h3 mb-2 text-gray-800 mb-4">Categorias</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary text-right">
                <a href="{{ route('admin.category.create') }}">
                    <i class="fa fa-plus-circle"></i> Agregar categorias
                </a>
          </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
							<tr>
								<td>{{ $category->name }}</td>
								<td>{{ $category->description }}</td>
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
							</tr>
						@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection