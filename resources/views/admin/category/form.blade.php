<div class="form-group">
    <label for="name">Nombre:</label>
    <input type="text" id="name" class="form-control" name="name" placeholder="Nombre" value="{{ isset($category->name) ? $category->name : old('name') }}">
</div>

<div class="form-group">
    <label for="description">Descripción:</label>
    <textarea id="description" class="form-control" name="description" rows="4" placeholder="Agrega una descripcion">{{ isset($category->description) ? $category->description : old('description') }}</textarea>
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