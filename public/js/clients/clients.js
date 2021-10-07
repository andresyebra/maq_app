$(document).ready(function () {

    $('#discard').on('click', function () {
        $('.has-error').removeClass('has-error');
        $('#alert').empty();
        $(".input-md").each(function () {
            $(this).val('');
        });
    });

    $(".set_delete_client").on('click', function () {
        let client_id = $(this).data('id');
        let name_cliente = $(this).data('name');
        $("#id_client").text(client_id);
        $("#name_client").text(name_cliente);
        $("#delete_client").val(client_id);
    });

    $(".set_edit_client").on('click', function () {
        let client_id = $(this).data('id');
        let url = $("#GetDataClientsById").val();
        $("#id_edit_client").val(client_id);
        $('#alert_edit').empty();

        $.ajax({
            url: url + '/' + client_id,
            type: 'GET',
            success: function (data) {
                let nombre, archivo_clientes, clave, correo, direccion, telefono;

                nombre = data.client.nombre;
                archivo_clientes = data.client.archivo_clientes;
                clave = data.client.clave;
                correo = data.client.correo;
                direccion = data.client.direccion;
                telefono = data.client.telefono;

                $("#edit_clave_cliente").val(clave);
                $("#edit_nombre_cliente").val(nombre);
                $("#edit_telefono_cliente").val(telefono);
                $("#edit_correo_cliente").val(correo);
                $("#edit_direccion_cliente").val(direccion);
                $("#edit_archivo_cliente").val(archivo_clientes);
            },
        });

        $(".edit_client").on('click', function (event) {
            event.preventDefault();
            let id = $('#id_edit_client').val()
            $.ajax({
                url: $('#update_form').attr('action'),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id_edit_client: id,
                    edit_clave_cliente: $('#edit_clave_cliente').val(),
                    edit_nombre_cliente: $('#edit_nombre_cliente').val(),
                    edit_telefono_cliente: $('#edit_telefono_cliente').val(),
                    edit_correo_cliente: $('#edit_correo_cliente').val(),
                    edit_direccion_cliente: $('#edit_direccion_cliente').val(),
                    edit_archivo_cliente: $('#edit_archivo_cliente').val()
                },
                success: function(result){
                    $('#alert_edit').empty();
                    if(result.errors)
                    {
                        $('#alert_edit').append('<div class="alert alert-danger" role="alert">' + result.errors[0] + '</div>');
                    }
                    else
                    {
                        let tr = $("#row_client_" + id);
                        tr.find('td').eq(1).text($('#edit_clave_cliente').val());
                        tr.find('td').eq(2).text($('#edit_nombre_cliente').val());
                        tr.find('td').eq(3).text($('#edit_telefono_cliente').val());
                        tr.find('td').eq(4).text($('#edit_direccion_cliente').val());
                        tr.find('td').eq(5).text($('#edit_archivo_cliente').val());
                        $('#alert_edit').append('<div class="alert alert-success" role="alert">' + result.status + '</div>');
                    }
                }
            });
        });


    });

});