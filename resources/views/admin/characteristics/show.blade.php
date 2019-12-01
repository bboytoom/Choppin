@extends('admin.template')

@section('content')

    <section class="row">
        <div class="col-md-12">
            <h1>
				<i class="fa fa-shopping-cart"></i> CARACTERISTICAS 
				<a href="{{ route('admin.characteristics.create', $producto_id ) }}" class="btn btn-warning">
					<i class="fa fa-plus-circle"></i> Caracteristicas
				</a>
			</h1>
        </div>

        <div class="col-md-12 mt-5">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>Caracteristica</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($caracteristicas as $caracteristica)
                        <tr>
                            <td>
                                <a href="{{ route('admin.characteristics.edit', $caracteristica->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                {!! Form::open(['route' => ['admin.characteristics.destroy', $caracteristica->id, $producto_id ]]) !!}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button onClick="return confirm('Eliminar registro?')" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                {!! Form::close() !!}
                            </td>
                            </td>
                            <td>{{ $caracteristica->caracteristica }}</td>
                            <td>{{ $caracteristica->descripcion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection