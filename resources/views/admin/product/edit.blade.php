@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Editar articulos</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::model($product, array('route' => array('admin.product.update', $product->slug), 'files' => true, 'autocomplete' => 'off')) !!}

                <input type="hidden" name="_method" value="PUT">

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
                            {!! Form::text('price', null, array('class'=>'form-control', 'placeholder' => 'Precio del producto',)) !!}
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
                            <input id="visible" type="checkbox" class="custom-control-input" name="visible" {{ $product->visible == 1 ? "checked='checked'" : '' }}>
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
                        <span class="text">Actualizar</span>
                    </button>
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection