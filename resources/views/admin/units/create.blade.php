@extends('admin.template')

@section('content')

    <section class="row">
        <div class="col-md-12">
            <h1>
				<i class="fa fa-shopping-cart"></i> UNIDADES 
                <small>[Agregar unidades]</small>
			</h1>
        </div>

        <div class="col-md-12">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::open(['route'=>'admin.units.store']) !!}
                <div class="form-group">
                    <label for="unidad">Nombre:</label>
                    {!! Form::text('unidad', null, array('class'=>'form-control', 'placeholder' => 'Unidad del producto')) !!}
                </div>
                        
                <div class="form-group">
                    <label for="contraccion">Contraccion:</label>
                    {!! Form::text('contraccion', null, array('class'=>'form-control', 'placeholder' => 'Agrega una descripcion')) !!}
                </div>
                        
                <div class="form-group text-right">
                    {!! Form::submit('Guardar', array('class'=>'btn btn-primary')) !!}
                    <a href="{{ route('admin.units.index') }}" class="btn btn-warning">Cancelar</a>
                </div>
                    
            {!! Form::close() !!}
        </div>
    </section>

@endsection