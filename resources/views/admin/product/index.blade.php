@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Artículos</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-right">
            <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-white-50">
                  <i class="fa fa-plus-circle"></i>
                </span>
                <span class="text">Agregar</span>
            </a>
        </div>

        <div class="card-body">
            @if ($products->count() === 0)
                <h4 class="text-center">No cuentas con artículos</h4>                
            @else
                <div class="table-responsive">
                    <table id="products" class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Imagen</th>
                                <th>Artículo</th>
                                <th>Precio</th>
                                <th>Categoría</th>
                                <th class="text-center">Visible</th>
                                <th class="text-center">Complemento</th>
                                <th class="text-center">Editar</th>
                                <th class="text-center">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="text-center">
                                        @if ($product->image == "default.jpg")
                                            <img src="{{'/image/'.$product->image }}" width="50">
                                        @else
                                            <img src="{{'/products_img/'.$product->image }}" width="50">
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>${{ number_format($product->price,2) }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td class="text-center">
                                        @if ($product->visible == 1)
                                            <a href="#" class="btn btn-success btn-circle btn-sm">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-danger btn-circle btn-sm">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.characteristics.show', $product->id) }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.product.edit', $product->slug) }}" class="btn btn-warning btn-circle">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open(['route' => ['admin.product.destroy', $product->slug]]) !!}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" onClick="return confirm('Eliminar registro?')" class="btn btn-danger btn-circle">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>          
            @endif
        </div>
    </div>

@endsection