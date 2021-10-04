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

});