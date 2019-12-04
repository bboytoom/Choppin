@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Caracteristicas</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-right">
            <a href="{{ route('admin.product.index') }}" class="btn btn-info btn-icon-split btn-sm">
                <span class="icon text-white-50">
                  <i class="fa fa-plus-circle"></i>
                </span>
                <span class="text">Regresar</span>
            </a>
            
            <a href="{{ route('admin.characteristics.create', $producto_id ) }}" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-white-50">
                  <i class="fa fa-plus-circle"></i>
                </span>
                <span class="text">Agregar</span>
            </a>
        </div>

        <div class="card-body">
            @if ($caracteristicas->count() === 0)
                <h4 class="text-center">No cuentas con ninguna caracteristica</h4>
            @else
                <div class="table-responsive">
                    <table id="caracteristicas" class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Caracteristica</th>
                                <th>Descripcion</th>
                                <th class="text-center">Editar</th>
                                <th class="text-center">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($caracteristicas as $caracteristica)
                                <tr>
                                    <td>{{ $caracteristica->caracteristica }}</td>
                                    <td>{{ $caracteristica->descripcion }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.characteristics.edit', $caracteristica->id) }}" class="btn btn-warning btn-circle">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open(['route' => ['admin.characteristics.destroy', $caracteristica->id]]) !!}
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