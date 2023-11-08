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
$('#mascara_valor').mask('#.##0,00', { reverse: true });

$("#cep").blur(function () {
    var cep = $(this).val().replace(/\D/g, '');
    if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        if (validacep.test(cep)) {
            $("#logradouro").val("Buscando dados...");
            $("#bairro").val("Buscando dados...");
            $("#endereco").val("Buscando dados...");
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {
                if (!("erro" in dados)) {
                    $("#logradouro").val(dados.logradouro.toUpperCase());
                    $("#bairro").val(dados.bairro.toUpperCase());
                    $("#endereco").val(dados.localidade.toUpperCase());
                }
                else {
                    alert("CEP não encontrado de forma automatizado digite manualmente ou tente novamente.");
                }
            });
        }
    }
});