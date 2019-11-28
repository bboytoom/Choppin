@extends('admin.template')

@section('content')

    <section class="row">
        <div class="col-md-12">
            <h1>
                <i class="fa fa-user"></i> USUARIOS 
                <small>[ Agregar usuario ]</small>
            </h1>
        </div>

        <div class="col-md-12 mt-5">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::open(['route'=>'admin.user.store']) !!}

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    {!! Form::text('name', null, array( 'class'=>'form-control', 'placeholder' => 'Nombre', 'required' => 'required')) !!}
                </div>

                <div class="form-group">
                    <label for="father_surname">Apellidos paterno</label>
                    {!! Form::text('father_surname', null, array('class'=>'form-control', 'placeholder' => 'Ingresa el apellido paterno', 'required' => 'required')) !!}
                </div>

                <div class="form-group">
                    <label for="mother_surname">Apellido materno</label>
                    {!! Form::text( 'mother_surname', null, array( 'class'=>'form-control', 'placeholder' => 'Ingresa el apellido materno')) !!}
                </div>

                <div class="form-group">
                    <label for="email">Correo:</label>
                    {!! Form::text('email', null, array('class'=>'form-control', 'placeholder' => 'Correo electronico', 'required' => 'required')) !!}
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    {!! Form::password('password', array('class'=>'form-control', 'required' => 'required', 'placeholder' => 'Contraseña')) !!}
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirmar Password:</label>
                    {!! Form::password('password_confirmation', array('class'=>'form-control', 'required' => 'required', 'placeholder' => 'Contraseña')) !!}
                </div>

                <div class="form-group">
                    <label for="type">Tipo:</label>
                    {!! Form::radio('type', 'user', true) !!} User
                    {!! Form::radio('type', 'admin') !!} Admin
                </div>

                <div class="form-group">
                    <label for="address">Dirección:</label>
                    {!! Form::textarea('address', null, array( 'class'=>'form-control', 'placeholder' => 'Direccion')) !!}
                </div>

                <div class="form-group">
                    <label for="active">Active:</label>
                    {!! Form::checkbox('active', null, true) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Guardar', array('class'=>'btn btn-primary')) !!}
                    <a href="{{ route('admin.user.index') }}" class="btn btn-warning">Cancelar</a>
                </div>

            {!! Form::close() !!}
        </div>
    </section>

@endsection
