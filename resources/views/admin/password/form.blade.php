<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="password">Nuevo Password:</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Nueva contraseña" value="">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="confirm_password">Confirmar Nuevo Password:</label>
            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Nueva contraseña" value="">
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