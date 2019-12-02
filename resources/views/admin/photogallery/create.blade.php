@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Crear imagenes</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif
                    
            {!! Form::open(['route'=>'admin.photogallery.store', 'files' => true]) !!}
                <div class="form-group">
                    <label for="title">Titulo:</label>
                    {!! Form::text('title', null, array('class'=>'form-control', 'placeholder' => 'Titulo de la imagen')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('image', 'Imagen') !!}
                    {!! Form::file('image') !!}
                </div>
                        
                <div class="form-group">
                    <label for="description">Descripccion:</label>
                    {!! Form::textarea('description', null, array('class'=>'form-control', 'rows'=>'4', 'placeholder' => 'Agrega una descripcion')) !!}
                </div>
                        
                <div class="form-group">
                    <label for="status">Estatus:</label>
                    {!! Form::checkbox('status', null, array('class'=>'form-control')) !!}
                </div>

                <div class="form-group text-right">
                    {!! Form::submit('Guardar', array('class'=>'btn btn-primary')) !!}
                    <a href="{{ route('admin.photogallery.index') }}" class="btn btn-warning">Cancelar</a>
                </div>
                    
            {!! Form::close() !!}
        </div>
    </div>

@endsection