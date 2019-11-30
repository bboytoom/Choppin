@extends('admin.template')

@section('content')

    <section class="row">
        <div class="col-md-12">
            <h1>
                <i class="fa fa-shopping-cart"></i> PRODUCTOS 
                <small>[Editar producto]</small>
            </h1>
        </div>

        <div class="col-md-12 mt-5">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::model($product, array('route' => array('admin.product.update', $product->slug))) !!}

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
                    <label class="control-label" for="unidad_id">Unidades</label>
                    {!! Form::select('unidad_id', $unidades, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label for="image">Imagen:</label>

                    {!! Form::text('image', null, array('class'=>'form-control', 'placeholder' => 'imagen',))!!}
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
    </section>

@endsection