function deleteRegistroPaginacao(rotaUrl, idDoRegistro) {
    //alert(rotaUrl);
    //alert(idDoRegistro);

    if (confirm('Confirma a exclusão ?')) {
        $.ajax({
            url: rotaUrl,
            method: 'DELETE',
            headers: {},
            data: {
                id: idDoRegistro,
            },
            beforeSend: function () {
                $.blockUI({
                    message: 'Carregando...',
                    timeout: 2000,
                });
            },
            /* Ajax: Caso de sucesso */
        }).done(function (data) {
            $.unblockUI();
            console.log(data);
            /* Ajax: Caso de não sucesso */
        }).fail(function (data) {
            $.unblockUI();
            alert('Não foi possíverl buscar os dados');
        });

    }
}