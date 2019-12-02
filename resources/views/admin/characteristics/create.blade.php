@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Crear caracteristicas</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::open(['route'=>'admin.characteristics.store']) !!}
                <input type="hidden" name="producto_id" value="{{ $producto_id }}">
                <div class="form-group">
                    <label for="caracteristica">Caracteristica:</label>
                    {!! Form::text('caracteristica', null, array('class'=>'form-control', 'placeholder' => 'Caracteristica del producto')) !!}
                </div>
                        
                <div class="form-group">
                    <label for="descripcion">Descripcion:</label>
                    {!! Form::text('descripcion', null, array('class'=>'form-control', 'placeholder' => 'Agrega una descripcion')) !!}
                </div>
                        
                <div class="form-group text-right">
                    {!! Form::submit('Guardar', array('class'=>'btn btn-primary')) !!}
                    <a href="{{ route('admin.characteristics.show', $producto_id) }}" class="btn btn-warning">Cancelar</a>
                </div>
                    
            {!! Form::close() !!}
        </div>
    </div>

@endsection