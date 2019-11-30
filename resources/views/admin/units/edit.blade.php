@extends('admin.template')

@section('content')

    <section class="row">
        <div class="col-md-12">
            <h1>
                <i class="fa fa-shopping-cart"></i> UNIDADES 
                <small>[Editar unidades]</small>
            </h1>
        </div>

        <div class="col-md-12">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::model($unidad, array('route' => array('admin.units.update', $unidad))) !!}
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="unidad">Unidad:</label>
                    {!! Form::text('unidad', null, array( 'class'=>'form-control', 'placeholder' => 'Unidad del producto')) !!}
                </div>

                <div class="form-group">
                    <label for="contraccion">Contraccion:</label>
                    {!! Form::text('contraccion', null, array('class'=>'form-control', 'placeholder' => 'Contraccion de la unidad')) !!}
                </div>

                <div class="form-group text-right">
                    {!! Form::submit('Actualizar', array('class'=>'btn btn-primary')) !!}
                    <a href="{{ route('admin.units.index') }}" class="btn btn-warning">Cancelar</a>
                </div>

            {!! Form::close() !!}
        </div>
    </section>

@endsection