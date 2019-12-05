@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Cambiar password</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::model($password, array('route' => array('admin.password.update', $password->id), 'autocomplete' => 'off')) !!}

                <input type="hidden" name="_method" value="PUT">

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