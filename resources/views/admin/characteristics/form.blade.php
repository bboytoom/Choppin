<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="caracteristica">Caracteristica:</label>
            {!! Form::text('caracteristica', null, array('class'=>'form-control', 'placeholder' => 'Color')) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="descripcion">Descripcion:</label>
            {!! Form::text('descripcion', null, array('class'=>'form-control', 'placeholder' => 'Azul')) !!}
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