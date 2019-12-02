@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Editar imagenes</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif
                    
            {!! Form::model($gallery, array('route' => array('admin.photogallery.update', $gallery), 'files' => true)) !!}
                <input type="hidden" name="_method" value="PUT">
             
                <div class="form-group">
                    <label for="title">Titulo:</label>
                    {!! Form::text('title', null, array('class'=>'form-control', 'placeholder' => 'Titulo de la imagen')) !!}
                </div>

                <div class="row mt-4 mb-4">
                    <div class="col-md-6">
                        <img src="{{ '/gallery_img/'.$gallery->image }}" alt="{{ $gallery->image }}" width="50">
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('image', 'Imagen') !!}
                            {!! Form::file('image') !!}
                        </div>
                    </div>
                </div>
                        
                <div class="form-group">
                    <label for="description">Descripccion:</label>
                    {!! Form::textarea('description', null, array('class'=>'form-control', 'rows'=>'4', 'placeholder' => 'Agrega una descripcion')) !!}
                </div>
                        
                <div class="form-group">
                    <label for="status">Estatus:</label>
                    <input type="checkbox" name="status" {{ $gallery->status == 1 ? "checked='checked'" : '' }}>
                </div>

                <div class="form-group text-right">
                    {!! Form::submit('Guardar', array('class'=>'btn btn-primary')) !!}
                    <a href="{{ route('admin.photogallery.index') }}" class="btn btn-warning">Cancelar</a>
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection