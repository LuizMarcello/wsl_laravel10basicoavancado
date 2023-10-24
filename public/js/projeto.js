function deleteRegistroPaginacao(rotaUrl, idDoRegistro) {
    //alert(rotaUrl);
    //alert(idDoRegistro);

    if (confirm('Confirma a exclusão ?')) {
        $.ajax({
            url: rotaUrl,
            method: 'DELETE',
            /* Para trabalhar laravel com ajax, é necessário
               ter um token de sessão, para o laravel poder autorizar
               requisição externa com ajax. O "meta" de paginacao.blade.php
               (excluir), está enviando este tokem */
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: idDoRegistro,
            },
            beforeSend: function () {
                $.blockUI({
                    message: 'Carregando...',
                    timeout: 3000,
                });
            },
            /* Ajax: Caso de sucesso */
        }).done(function (data) {
            $.unblockUI();
            if (data.success == true) {
                /* Atualizar a página */
                window.location.reload();
            } else {
                alert('Não foi possível excluir!');
            }
            //console.log(data);
            /* Ajax: Caso de não sucesso */
        }).fail(function (data) {
            $.unblockUI();
            alert('Não foi possível buscar os dados!');
        });

    }
}

/* RobinHerbots */
/* InputMask */
$('#mascara_valor').mask('#.##0,00', { reverse: true })