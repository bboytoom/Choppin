@extends('admin.template')

@section('content')

    <section class="row">
        <div class="col-md-12">
            <h1>
                <i class="fa fa-shopping-cart"></i> CARACTERISTICAS 
                <small>[Editar caracteristicas]</small>
            </h1>
        </div>

        <div class="col-md-12">
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
    </section>

@endsection