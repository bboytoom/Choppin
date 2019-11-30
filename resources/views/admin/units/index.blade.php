@extends('admin.template')

@section('content')

    <section class="row">
        <div class="col-md-12">
            <h1>
				<i class="fa fa-shopping-cart"></i> UNIDADES 
				<a href="{{ route('admin.units.create') }}" class="btn btn-warning">
				<i class="fa fa-plus-circle"></i> Unidades</a>
			</h1>
        </div>

        <div class="col-md-12">
            <table class="table table-striped table-hover">
				<thead>
					<tr>
                        <th>Editar</th>
						<th>Eliminar</th>
						<th>Unidad</th>
						<th>Contraccion</th>
					</tr>
				</thead>
				<tbody>
					@foreach($unidades as $unidad)
                        <tr>
                            <td>
                                <a href="{{ route('admin.units.edit', $unidad) }}" class="btn btn-primary">
									<i class="fas fa-edit"></i>
								</a>
                            </td>
                            <td>
                                {!! Form::open(['route' => ['admin.units.destroy', $unidad]]) !!}
									<input type="hidden" name="_method" value="DELETE">
									<button onClick="return confirm('Eliminar registro?')" class="btn btn-danger">
										<i class="fas fa-trash-alt"></i>
									</button>
								{!! Form::close() !!}
                            </td>
                            <td>{{ $unidad->unidad }}</td>
                            <td>{{ $unidad->contraccion }}</td>
                        </tr>
					@endforeach
				</tbody>
			</table>
        </div>
    </section>

@endsection