<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">Nombre:</label>
            {!! Form::text('name', null, array( 'class'=>'form-control', 'placeholder' => 'Nombre de producto')) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="price">Precio:</label>
            {!! Form::text('price', null, array('class'=>'form-control', 'placeholder' => 'Precio del producto')) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label" for="category_id">Categoría</label>
            {!! Form::select('category_id', $categories, null, ['class' => 'custom-select']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <label for="extract">Extracto:</label>
    {!! Form::text( 'extract', null, array('class'=>'form-control', 'placeholder' => 'Resumen del producto')) !!}
</div>

<div class="form-group">
    <label for="description">Descripción:</label>
    {!! Form::textarea('description', null, array('class'=>'form-control', 'rows'=>'4', 'placeholder' => 'Descripcion')) !!}
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="custom-file">
            <input id="image" type="file" class="custom-file-input" name="image">
            <label class="custom-file-label" for="image" data-browse="Cargar">Seleccionar Archivo</label>
        </div>
    </div>

    <div class="col-md-6 text-right">
        <div class="custom-control custom-switch">
            @if (isset($product))
                <input id="visible" type="checkbox" class="custom-control-input" name="visible" {{ $product->visible == 1 ? "checked='checked'" : '' }}>
            @else
                <input id="visible" type="checkbox" class="custom-control-input" name="visible" checked>
            @endif            
            <label class="custom-control-label" for="visible">Estatus</label>
        </div>
    </div>
</div>

<div class="form-group text-right mt-5">
    <a href="{{ route('admin.product.index') }}" class="btn btn-info btn-icon-split">
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