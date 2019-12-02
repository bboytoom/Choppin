@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Editar usuarios</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::model($user, array('route' => array('admin.user.update', $user))) !!}

                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    {!!Form::text('name', null, array('class'=>'form-control', 'placeholder' => 'Nombre', 'required' => 'required')) !!}
                </div>

                <div class="form-group">
                    <label for="father_surname">Apellido paterno</label>
                    {!! Form::text('father_surname', null, array('class'=>'form-control', 'placeholder' => 'Ingresa el apellido paterno', 'required' => 'required')) !!}
                </div>

                <div class="form-group">
                    <label for="mother_surname">Apellido materno</label>
                    {!! Form::text('mother_surname', null, array( 'class'=>'form-control', 'placeholder' => 'Ingresa el apellido materno')) !!}
                </div>

                <div class="form-group">
                    <label for="email">Correo electronico:</label>

                    {!! Form::text('email', null, array( 'class'=>'form-control', 'placeholder' => 'Correo electronico', 'required' => 'required')) !!}
                </div>

                <div class="form-group">
                    <label for="type">Tipo:</label>
                    {!! Form::radio('type', 'user', $user->type=='user' ? true : false) !!} User
                    {!! Form::radio('type', 'admin', $user->type=='admin' ? true : false) !!} Admin
                </div>

                <div class="form-group">
                    <label for="address">Dirección:</label>
                    {!! Form::textarea( 'address', null, array('class'=>'form-control', 'placeholder' => 'Direccion del usuario')) !!}
                </div>

                <div class="form-group">
                    <label for="active">Active:</label>
                    {!! Form::checkbox('active', null, $user->active == 1 ? true : false) !!}
                </div>
                
                <hr>

                <fieldset>
                    <legend>Cambiar password:</legend>
                    <div class="form-group">
                        <label for="password">Nuevo Password:</label>
                        {!! Form::password( 'password', array('class'=>'form-control', 'placeholder' => 'Nueva contraseña')) !!}
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirmar Nuevo Password:</label>
                        {!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder' => 'Nueva contraseña')) !!}
                    </div>
                </fieldset>

                <div class="form-group">
                    {!! Form::submit('Actualizar', array('class'=>'btn btn-primary')) !!}
                    <a href="{{ route('admin.user.index') }}" class="btn btn-warning">
                        Cancelar
                    </a>
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection