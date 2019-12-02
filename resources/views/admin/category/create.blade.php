@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Crear categoriar</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif
                    
            {!! Form::open(['route'=>'admin.category.store']) !!}
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    {!! Form::text('name', null, array('class'=>'form-control', 'placeholder' => 'Nombre')) !!}
                </div>
                        
                <div class="form-group">
                    <label for="description">Descripción:</label>
                    {!! Form::textarea('description', null, array('class'=>'form-control', 'rows'=>'4', 'placeholder' => 'Agrega una descripcion')) !!}
                </div>
                        
                <div class="form-group text-right">
                    {!! Form::submit('Guardar', array('class'=>'btn btn-primary')) !!}
                    <a href="{{ route('admin.category.index') }}" class="btn btn-warning">Cancelar</a>
                </div>
                    
            {!! Form::close() !!}
        </div>
    </div>

@endsection