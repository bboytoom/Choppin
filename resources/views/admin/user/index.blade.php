@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Usuarios</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-right">
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-white-50">
                  <i class="fa fa-plus-circle"></i>
                </span>
                <span class="text">Agregar</span>
            </a>
        </div>

        <div class="card-body">
            @if ($users->count() === 0)
                <h4 class="text-center">No cuentas con usuarios</h4> 
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido paterno</th>
                                <th>Apellido materno</th>
                                <th>Correo</th>
                                <th>Tipo</th>
                                <th>Activo</th>
                                <th class="text-center">Editar</th>
                                <th class="text-center">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->father_surname }}</td>
                                    <td>{{ $user->mother_surname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->type }}</td>
                                    <td>
                                        @if ( $user->active  == 1)
                                            <a href="#" class="btn btn-success btn-circle btn-sm">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-danger btn-circle btn-sm">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-warning btn-circle">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open(['route' => ['admin.user.destroy', $user]]) !!}
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