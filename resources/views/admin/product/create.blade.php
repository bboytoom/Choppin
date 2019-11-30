@extends('admin.template')

@section('content')
    
    <section class="row">
        <div class="col-md-12">
            <h1>
				<i class="fa fa-shopping-cart"></i> PRODUCTOS 
                <small>[Agregar producto]</small>
			</h1>
        </div>

        <div class="col-md-12">
            @if (count($errors) > 0)
                 @include('admin.partials.errors')
            @endif
                    
            {!! Form::open(['route'=>'admin.product.store']) !!}
                    
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
                    <label for="image">Imagen:</label>
                    {!! Form::text('image', null, array('class'=>'form-control', 'placeholder' => 'Imagen del producto')) !!}
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
    </section>

@endsection