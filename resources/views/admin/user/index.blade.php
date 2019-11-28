@extends('admin.template')

@section('content')

    <section class="row">
        <div class="col-md-12">
            <h1>
                <i class="fa fa-user"></i> USUARIOS
                <a href="{{ route('admin.user.create') }}" class="btn btn-warning">
                    <i class="fa fa-plus-circle"></i> Usuario
                </a>
            </h1>
        </div>

        <div class="col-md-12 mt-5">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>Nombre</th>
                        <th>Apellido paterno</th>
                        <th>Apellido materno</th>
                        <th>Correo</th>
                        <th>Tipo</th>
                        <th>Activo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            {!! Form::open(['route' => ['admin.user.destroy', $user]]) !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <button onClick="return confirm('Eliminar registro?')" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            {!! Form::close() !!}
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->father_surname }}</td>
                        <td>{{ $user->mother_surname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->type }}</td>
                        <td>{{ $user->active == 1 ? "Si" : "No" }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <?php echo $users->render(); ?>
    </section>

@endsection