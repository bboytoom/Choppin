<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="calle_uno">Calle uno:</label>
            <input type="text" id="calle_uno" class="form-control" name="calle_uno" placeholder="Calle uno" value="{{ isset($envios->calle_uno) ? $envios->calle_uno : old('calle_uno') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="calle_dos">Calle uno:</label>
            <input type="text" id="calle_dos" class="form-control" name="calle_dos" placeholder="Calle dos" value="{{ isset($envios->calle_dos) ? $envios->calle_dos : old('calle_dos') }}">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="direccion">Direccion:</label>
    <input type="text" id="direccion" class="form-control" name="direccion" placeholder="Direccion" value="{{ isset($envios->direccion) ? $envios->direccion : old('direccion') }}">
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="colonia">Colonia:</label>
            <input type="text" id="colonia" class="form-control" name="colonia" placeholder="Colonia" value="{{ isset($envios->colonia) ? $envios->colonia : old('colonia') }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="municipio">Municipio:</label>
            <input type="text" id="municipio" class="form-control" name="municipio" placeholder="Municipio" value="{{ isset($envios->municipio) ? $envios->municipio : old('municipio') }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="estado">Estado:</label>
            <input type="text" id="estado" class="form-control" name="estado" placeholder="Estado" value="{{ isset($envios->estado) ? $envios->estado : old('estado') }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="pais">Pais:</label>
            <input type="text" id="pais" class="form-control" name="pais" placeholder="Pais" value="{{ isset($envios->pais) ? $envios->pais : old('pais') }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="codigo_postal">Codigo postal:</label>
            <input type="text" id="codigo_postal" class="form-control" name="codigo_postal" placeholder="Codigo postal" value="{{ isset($envios->codigo_postal) ? $envios->codigo_postal : old('codigo_postal') }}">
        </div>
    </div>

    <div class="col-md-4 mt-3">
        <div class="custom-control custom-switch text-right">
            @if (isset($envios))
                <input id="status" type="checkbox" class="custom-control-input" name="status" {{ $envios->status == 1 ? "checked='checked'" : '' }}>
            @else
                <input id="status" type="checkbox" class="custom-control-input" name="status" checked>
            @endif
            <label class="custom-control-label" for="status">Estatus</label>
        </div>
    </div>
</div>

<div class="form-group text-right mt-5">
    @if (isset($envios))
        <a href="{{ route('admin.envios.show', $envios->user_id) }}" class="btn btn-info btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Cancelar</span>
        </a>
    @else
        <a href="{{ route('admin.envios.show', $user_id) }}" class="btn btn-info btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Cancelar</span>
        </a>
    @endif

    <button type="submit" class="btn btn-danger btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-exclamation-triangle"></i>
        </span>
        <span class="text">Guardar</span>
    </button>
</div>