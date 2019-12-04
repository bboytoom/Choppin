@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Editar usuarios</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 text-right">
            <a href="{{ route('admin.envios.show', $user->id) }}" class="btn btn-primary btn-circle btn-sm">
                <i class="fas fa-map-marked-alt"></i>
            </a>
        </div>
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::model($user, array('route' => array('admin.user.update', $user), 'autocomplete' => 'off')) !!}

                <input type="hidden" name="_method" value="PUT">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            {!!Form::text('name', null, array('class'=>'form-control', 'placeholder' => 'Nombre', 'required' => 'required')) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="father_surname">Apellido paterno</label>
                            {!! Form::text('father_surname', null, array('class'=>'form-control', 'placeholder' => 'Ingresa el apellido paterno', 'required' => 'required')) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mother_surname">Apellido materno</label>
                            {!! Form::text('mother_surname', null, array( 'class'=>'form-control', 'placeholder' => 'Ingresa el apellido materno')) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Correo electronico:</label>
                            {!! Form::text('email', null, array( 'class'=>'form-control', 'placeholder' => 'Correo electronico', 'required' => 'required')) !!}
                        </div>
                    </div>

                    <div class="col-md-6 text-center">
                        <label>Tipo del usuario:</label>
                        <br>
                        <div class="custom-control custom-radio custom-control-inline">
                            {!! Form::radio('type', 'user', $user->type=='user' ? true : false, array('class'=>'custom-control-input')) !!}
                            <label class="custom-control-label" for="user">Usuario</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            {!! Form::radio('type', 'admin', $user->type=='admin' ? true : false, array('class'=>'custom-control-input')) !!}
                            <label class="custom-control-label" for="admin">Administrador</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Dirección:</label>
                    {!! Form::textarea( 'address', null, array('class'=>'form-control', 'rows'=>'4', 'placeholder' => 'Direccion del usuario')) !!}
                </div>

                <div class="custom-control custom-switch mt-4 mb-5 text-right">
                    <input id="active" type="checkbox" class="custom-control-input" name="active" {{ $user->active == 1 ? "checked='checked'" : '' }}>
                    <label class="custom-control-label" for="active">Estatus</label>
                </div>
                
                <hr>

                <fieldset>
                    <legend>Cambiar password:</legend>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Nuevo Password:</label>
                                {!! Form::password( 'password', array('class'=>'form-control', 'placeholder' => 'Nueva contraseña')) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirm_password">Confirmar Nuevo Password:</label>
                                {!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder' => 'Nueva contraseña')) !!}
                            </div>
                        </div>
                    </div>
                </fieldset>

                <div class="form-group text-right mt-5">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Cancelar</span>
                    </a>

                    <button type="submit" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                        <span class="text">Actualizar</span>
                    </button>
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection