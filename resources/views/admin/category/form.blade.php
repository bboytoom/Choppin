<div class="form-group">
    <label for="name">Nombre:</label>
    {!! Form::text('name', null, array('class'=>'form-control', 'placeholder' => 'Nombre')) !!}
</div>

<div class="form-group">
    <label for="description">Descripción:</label>
    {!! Form::textarea('description', null, array('class'=>'form-control', 'rows'=>'4', 'placeholder' => 'Agrega una descripcion')) !!}
</div>

<div class="form-group text-right mt-5">
    <a href="{{ route('admin.category.index') }}" class="btn btn-info btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-arrow-left"></i>
        </span>
        <span class="text">Cancelar</span>
    </a>

    <button type="submit" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-exclamation-triangle"></i>
        </span>
        <span class="text">Guardar</span>
    </button>
</div>