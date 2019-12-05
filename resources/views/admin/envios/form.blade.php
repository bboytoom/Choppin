<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="calle_uno">Calle uno:</label>
            {!! Form::text('calle_uno', null, array('class'=>'form-control', 'placeholder' => 'Calle uno')) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="calle_dos">Calle uno:</label>
            {!! Form::text('calle_dos', null, array('class'=>'form-control', 'placeholder' => 'Calle dos')) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <label for="direccion">Direccion:</label>
    {!! Form::text('direccion', null, array('class'=>'form-control', 'placeholder' => 'Direccion')) !!}
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="colonia">Colonia:</label>
            {!! Form::text('colonia', null, array('class'=>'form-control', 'placeholder' => 'Colonia')) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="municipio">Municipio:</label>
            {!! Form::text('municipio', null, array('class'=>'form-control', 'placeholder' => 'Municipio')) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="estado">Estado:</label>
            {!! Form::text('estado', null, array('class'=>'form-control', 'placeholder' => 'Estado')) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="pais">Pais:</label>
            {!! Form::text('pais', null, array('class'=>'form-control', 'placeholder' => 'Pais')) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="codigo_postal">Codigo postal:</label>
            {!! Form::text('codigo_postal', null, array('class'=>'form-control', 'placeholder' => 'Codigo postal')) !!}
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