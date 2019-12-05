<div class="row mb-4">
   <div class="col-md-6">
        @if (isset($gallery))
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ '/gallery_img/'.$gallery->image }}" class="img-thumbnail" alt="{{ $gallery->image }}" width="200">
                </div>

                <div class="col-md-9">
                    <label for="image">Imagen:</label>
                    <div class="custom-file">
                        <input id="image" type="file" class="custom-file-input" name="image">
                        <label class="custom-file-label" for="image" data-browse="Cargar">Seleccionar Archivo</label>
                    </div>
                </div>
            </div>
        @else
            <label for="image">Imagen:</label>
            <div class="custom-file">
                <input id="image" type="file" class="custom-file-input" name="image">
                <label class="custom-file-label" for="image" data-browse="Cargar">Seleccionar Archivo</label>
            </div>
        @endif
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="title">Titulo:</label>
            {!! Form::text('title', null, array('class'=>'form-control', 'placeholder' => 'Titulo de la imagen')) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <label for="description">Descripccion:</label>
    {!! Form::textarea('description', null, array('class'=>'form-control', 'rows'=>'4', 'placeholder' => 'Agrega una descripcion')) !!}
</div>

<div class="custom-control custom-switch">
    @if (isset($gallery))
        <input id="status" type="checkbox" class="custom-control-input" name="status" {{ $gallery->status == 1 ? "checked='checked'" : '' }}>
    @else
        <input id="status" type="checkbox" class="custom-control-input" name="status" checked>
    @endif
    
    <label class="custom-control-label" for="status">Estatus</label>
</div>

<div class="form-group text-right mt-5">
    <a href="{{ route('admin.photogallery.index') }}" class="btn btn-info btn-icon-split">
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