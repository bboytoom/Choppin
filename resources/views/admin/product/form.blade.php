<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" id="name" class="form-control" name="name" placeholder="Nombre de producto" value="{{ isset($product->name) ? $product->name : old('name') }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="price">Precio:</label>
            <input id="price" class="form-control" name="price" type="number" min="0" step="0.01" placeholder="Precio del producto" value="{{ isset($product->price) ? $product->price : old('price') }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label" for="category_id">Categoría</label>
            @if (isset($product))
                <select id="category_id" class="custom-select" name="category_id">
                    @foreach ($categories as $key => $item)
                        <option value="{{ $key }}" {{ ($key === $product->category_id) ? 'selected' : '' }}>
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
            @else
                <select id="category_id" class="custom-select" name="category_id">
                    @foreach ($categories as $key => $item)
                        <option value="{{ $key }}">
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    <label for="extract">Extracto:</label>
    <input type="text" id="extract" class="form-control" name="extract" placeholder="Resumen del producto" value="{{ isset($product->extract) ? $product->extract : old('extract') }}">
</div>

<div class="form-group">
    <label for="description">Descripción:</label>
    <textarea id="description" class="form-control" name="description" rows="4" placeholder="Agrega una descripcion">{{ isset($product->description) ? $product->description : old('description') }}</textarea>
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