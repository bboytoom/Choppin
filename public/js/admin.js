$(document).ready(function(){

	$(".btn-detalle-pedido").on('click', function(e){
		e.preventDefault();

		var id_pedido = $(this).data('id');
        var path = $(this).data('path');
        var token = $(this).data('token');
        var modal_title = $(".modal-title");
        var modal_body = $(".modal-body");
        var loading = '<p><i class="fa fa-circle-o-notch fa-spin"></i> Cargando datos</p>';
        var table = $("#table-detalle-pedido tbody");
        var data = {'_token' : token, 'order_id' : id_pedido};

        modal_title.html('Detalle del Pedido: ' + id_pedido);
        table.html(loading);

        $.post(
        	path,
        	data,
        	function(data){
        		table.html("");
        		
                for(var i=0; i<data.length; i++){
                    
                    var fila = "<tr>";
                    fila += "<td><img src='" + data[i].product.image + "' width='30'></td>";
                    fila += "<td>" + data[i].product.name + "</td>";
                    fila += "<td>$ " + parseFloat(data[i].price).toFixed(2) + "</td>";
                    fila += "<td>" + parseInt(data[i].quantity) + "</td>";
                    fila += "<td>$ " + (parseFloat(data[i].quantity) * parseFloat(data[i].price)).toFixed(2) + "</td>";
                    fila += "</tr>";
                    
                    table.append(fila);
                }
        	},
        	'json'
        );
	});

    $('#products, #caracteristicas, #caracteristicas, #gallery, #users , #envios').DataTable({
        ordering:  false,
        searching: false,
        lengthChange: false,
        pageLength: 4,
        responsive: true,
        language: {
	        "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                 "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                 "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
    });
});