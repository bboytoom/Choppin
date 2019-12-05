<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">Nombre:</label>
            {!!Form::text('name', null, array('class'=>'form-control', 'placeholder' => 'Nombre', 'required' =>
            'required')) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="father_surname">Apellido paterno</label>
            {!! Form::text('father_surname', null, array('class'=>'form-control', 'placeholder' => 'Ingresa el apellido
            paterno', 'required' => 'required')) !!}
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
    <div class="col-md-4">
        <div class="form-group">
            <label for="email">Correo electronico:</label>
            {!! Form::text('email', null, array( 'class'=>'form-control', 'placeholder' => 'Correo electronico', 'required' => 'required')) !!}
        </div>
    </div>

    <div class="col-md-4 text-center">
        <label>Tipo del usuario:</label>
        <br>

        @if (isset($user))
            <div class="custom-control custom-radio custom-control-inline">
                {!! Form::radio('type', 'user', $user->type=='user' ? true : false, array('class'=>'custom-control-input')) !!}
                <label class="custom-control-label" for="user">Usuario</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                {!! Form::radio('type', 'admin', $user->type=='admin' ? true : false, array('class'=>'custom-control-input')) !!}
                <label class="custom-control-label" for="admin">Administrador</label>
            </div>
        @else
            <div class="custom-control custom-radio custom-control-inline">
                {!! Form::radio('type', 'user', true, array('class'=>'custom-control-input')) !!}
                <label class="custom-control-label" for="user">Usuario</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                {!! Form::radio('type', 'admin', false, array('class'=>'custom-control-input')) !!}
                <label class="custom-control-label" for="admin">Administrador</label>
            </div>
        @endif
    </div>

    <div class="col-md-4 text-center">
        <div class="custom-control custom-switch mt-4 mb-5 ">
            @if (isset($user))
                <input id="active" type="checkbox" class="custom-control-input" name="active" {{ $user->active == 1 ? "checked='checked'" : '' }}>
            @else
                <input id="active" type="checkbox" class="custom-control-input" name="active" checked>
            @endif
            
            <label class="custom-control-label" for="active">Estatus</label>
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