<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" id="name" class="form-control" name="name" placeholder="Nombre" value="{{ isset($user->name) ? $user->name : old('name') }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="father_surname">Apellido paterno</label>
            <input type="text" id="father_surname" class="form-control" name="father_surname" placeholder="Ingresa el apellido paterno" value="{{ isset($user->father_surname) ? $user->father_surname : old('father_surname') }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="mother_surname">Apellido materno</label>
            <input type="text" id="mother_surname" class="form-control" name="mother_surname" placeholder="Ingresa el apellido materno" value="{{ isset($user->mother_surname) ? $user->mother_surname : old('mother_surname') }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="email">Correo electronico:</label>
            <input type="email" id="email" class="form-control" name="email" placeholder="Correo electronico" value="{{ isset($user->email) ? $user->email : old('email') }}">
        </div>
    </div>

    <div class="col-md-4 text-center">
        <label>Tipo del usuario:</label>
        <br>

        @if (isset($user))
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="user" name="type" class="custom-control-input" value="user" {{ ($user->type == 'user') ? 'checked' : '' }}>
                <label class="custom-control-label" for="user">Usuario</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="admin" name="type" class="custom-control-input" value="admin" {{ ($user->type == 'admin') ? 'checked' : '' }}>
                <label class="custom-control-label" for="admin">Administrador</label>
            </div>
        @else
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="user" name="type" class="custom-control-input" value="user" checked>
                <label class="custom-control-label" for="user">Usuario</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="admin" name="type" class="custom-control-input" value="admin">
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
        <span class="text">Guardar</span>
    </button>
</div>