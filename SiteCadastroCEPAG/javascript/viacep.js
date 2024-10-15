function limpa_formulário_cep() {
    $("#rua").val("");
    $("#bairroRes").val("");
    $("#cidadeRes").val("");
    $("#uf").val("");
}

$("#cep").on('input', function() {
    // Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    if (cep !== "") {
        // Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        // Valida o formato do CEP.
        if (validacep.test(cep)) {
            // Verifica se o CEP é do Paraná (80 a 89)
            var cepPrefix = parseInt(cep.substring(0, 2));
            if (cepPrefix >= 80 && cepPrefix <= 89) {
                // Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairroRes").val("...");
                $("#cidadeRes").val("...");
                $("#uf").val("...");

                // Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                    if (!("erro" in dados)) {
                        // Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairroRes").val(dados.bairro);
                        $("#cidadeRes").val(dados.localidade);
                        $("#uf").val(dados.uf);

                        //verificarCamposEObterCoordenadas();
                    } else {
                        // CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } else {
                // CEP não é do Paraná.
                limpa_formulário_cep();
                alert("Por favor, insira um CEP válido do Paraná (80-89).");
            }
        } else {
            // CEP é inválido.
            limpa_formulário_cep();
        }
    } else {
        // CEP sem valor, limpa formulário.
        limpa_formulário_cep();
    }
});