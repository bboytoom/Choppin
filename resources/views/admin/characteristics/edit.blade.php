@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Editar caracteristicas</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::model($caracteristica, array('route' => array('admin.characteristics.update', $caracteristica->id, $caracteristica->producto_id))) !!}
                <input type="hidden" name="_method" value="PUT">
                
                <div class="form-group">
                    <label for="caracteristica">Caracteristica:</label>
                    {!! Form::text('caracteristica', null, array( 'class'=>'form-control', 'placeholder' => 'Caracteristica del producto')) !!}
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripcion:</label>
                    {!! Form::text('descripcion', null, array('class'=>'form-control', 'placeholder' => 'Descripcion de la unidad')) !!}
                </div>

                <div class="form-group text-right">
                    {!! Form::submit('Actualizar', array('class'=>'btn btn-primary')) !!}
                    <a href="{{ route('admin.characteristics.show', $caracteristica->producto_id) }}" class="btn btn-warning">Cancelar</a>
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection