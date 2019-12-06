<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="caracteristica">Caracteristica:</label>
            <input type="text" id="caracteristica" class="form-control" name="caracteristica" placeholder="Color" value="{{ isset($caracteristica->caracteristica) ? $caracteristica->caracteristica : old('caracteristica') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="descripcion">Descripcion:</label>
            <input type="text" id="descripcion" class="form-control" name="descripcion" placeholder="Azul" value="{{ isset($caracteristica->descripcion) ? $caracteristica->descripcion : old('descripcion') }}">
        </div>
    </div>
</div>

<div class="form-group text-right mt-5">
    @if (isset($caracteristica))
         <a href="{{ route('admin.characteristics.show', $caracteristica->producto_id) }}" class="btn btn-info btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Cancelar</span>
        </a>
    @else
        <a href="{{ route('admin.characteristics.show', $producto_id) }}" class="btn btn-info btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Cancelar</span>
        </a>              
    @endif
    
    <button type="submit" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-exclamation-triangle"></i>
        </span>
        <span class="text">Guardar</span>
    </button>
</div>