@extends('admin.template')

@section('content')
    
    <h1 class="h3 mb-2 text-gray-800 mb-4">Agregar articulos</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                 @include('admin.partials.errors')
            @endif
                    
            {!! Form::open(['route'=>'admin.product.store', 'files' => true]) !!}
                    
                <div class="form-group">
                    <label class="control-label" for="category_id">Categoría</label>
                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    {!! Form::text('name', null, array('class'=>'form-control', 'placeholder' => 'Nombre del producto')) !!}
                </div>

                <div class="form-group">
                    <label for="extract">Extracto:</label>
                    {!! Form::text('extract', null, array('class'=>'form-control', 'placeholder' => 'Resumen del producto')) !!}
                </div>

                <div class="form-group">
                    <label for="description">Descripción:</label>
                    {!! Form::textarea('description', null, array('class'=>'form-control', 'rows'=>'4', 'placeholder' => 'Descripcion del producto')) !!}
                </div>

                <div class="form-group">
                    <label for="price">Precio:</label>
                    {!! Form::text('price', null, array('class'=>'form-control', 'placeholder' => 'Precio del producto')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('image', 'Imagen') !!}
                    {!! Form::file('image') !!}
                </div>

                <div class="form-group">
                    <label for="visible">Visible:</label>
                    {!! Form::checkbox('visible', null, array('class'=>'form-control')) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Guardar', array('class'=>'btn btn-primary')) !!}
                    <a href="{{ route('admin.product.index') }}" class="btn btn-warning">Cancelar</a>
                </div>
                    
            {!! Form::close() !!}
        </div>
    </div>

@endsection