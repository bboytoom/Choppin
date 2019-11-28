@extends('admin.template')

@section('content')

    <section class="row">
        <div class="col-md-12">
            <h1>
                <i class="fa fa-shopping-cart"></i> PEDIDOS
            </h1>
        </div>

        <div class="col-md-12 mt-5">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Ver Detalle</th>
                        <th>Eliminar</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Subtotal</th>
                        <th>Envio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            <a href="#" class="btn btn-primary btn-detalle-pedido" data-id="{{ $order->id }}" data-path="{{ route('admin.order.getItems') }}" data-toggle="modal" data-target="#myModal" data-token="{{ csrf_token() }}">
                                <i class="fa fa-external-link"></i>
                            </a>
                        </td>
                        <td>
                            {!! Form::open(['route' => ['admin.order.destroy', $order->id]]) !!}
                                <button onClick="return confirm('Eliminar registro?')" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            {!! Form::close() !!}
                        </td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->user->name . " " . $order->user->last_name }}</td>
                        <td>${{ number_format($order->subtotal,2) }}</td>
                        <td>${{ number_format($order->shipping,2) }}</td>
                        <td>${{ number_format($order->subtotal + $order->shipping,2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <?php echo $orders->render(); ?>

        @include('admin.partials.modal-detalle-pedido')
    </section>

@endsection


