@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Editar articulos</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::model($product, array('route' => array('admin.product.update', $product->slug), 'files' => true)) !!}

                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label class="control-label" for="category_id">Categoría</label>
                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    {!! Form::text('name', null, array( 'class'=>'form-control', 'placeholder' => 'Nombre de producto')) !!}
                </div>

                <div class="form-group">
                    <label for="extract">Extracto:</label>
                    {!! Form::text( 'extract', null, array('class'=>'form-control', 'placeholder' => 'Resumen del producto')) !!}
                </div>

                <div class="form-group">
                    <label for="description">Descripción:</label>
                    {!! Form::textarea('description', null, array('class'=>'form-control', 'rows'=>'4', 'placeholder' => 'Descripcion')) !!}
                </div>

                <div class="form-group">
                    <label for="price">Precio:</label>

                    {!! Form::text('price', null, array('class'=>'form-control', 'placeholder' => 'Precio del producto',)) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('image', 'Imagen') !!}
                    {!! Form::file('image') !!}
                </div>

                <div class="form-group">
                    <label for="visible">Visible:</label>
                    <input type="checkbox" name="visible" {{ $product->visible == 1 ? "checked='checked'" : '' }}>
                </div>

                <div class="form-group text-right">
                    {!! Form::submit('Actualizar', array('class'=>'btn btn-primary')) !!}
                    <a href="{{ route('admin.product.index') }}" class="btn btn-warning">Cancelar</a>
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection