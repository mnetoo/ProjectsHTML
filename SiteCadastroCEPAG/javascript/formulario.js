function imprimirPagina() {
    window.print();
}

// ==========================================================================================

// Função para obter a data atual formatada
function obterDataAtual() {
    const hoje = new Date();

    const dias = hoje.getDate();
    const mes = hoje.toLocaleString('pt-BR', { month: 'long' });
    const ano = hoje.getFullYear();

    // Retorna a string formatada com a data
    return `Curitiba, ${dias} de ${mes} de ${ano}.`;
}

// Chama a função e insere a data no elemento com id "data"
function mostrarDataAtual() {
    const dataAtual = obterDataAtual();
    document.getElementById("data").textContent = dataAtual; // Insere a data no elemento
}

// Chama a função quando a página for carregada
window.onload = mostrarDataAtual;

// ==========================================================================================

//Função para limpar os campos após o envio
function clearForm() {
    document.getElementById("form").reset();
}

//Função para salvar informações do formulário
function submitForm() {
    var formData = $("form").serializeArray();
    let csv = "data:text/csv;charset=utf-8,"; // accept data as CSV


    let formValues = {};
    formData.forEach(function (item) {
        formValues[item.name] = item.value;
    });

    csv += "Nome;Data de Nascimento;RG;Expedicao;Orgao Emissor;CPF;Email;Telefone;Celular;Nacionalidade;Chegada no Pais; Nome do Pai;Nome da Mae;Sexo;Estado Civil;N Dependentes;Grupo Sanguineo;Cor da Pele;Escolaridade;Formacao em Andamento; Instituicao de Ensino;Instagram;LinkedIn;CEP;Rua;Numero;Complemento;Bairro;Cidade;UF;Banco;Agencia;Conta;Nome da Agencia;PIX;Cidade da Agencia;Bairro da Agencia\n";

    csv += (formValues['nome'] || '') + ";";
    csv += (formValues['dataNascimento'] || '') + ";";
    csv += (formValues['rg'] || '') + ";";
    csv += (formValues['expedicao'] || '') + ";";
    csv += (formValues['orgaoEmissor'] || '') + ";";
    csv += (formValues['cpf'] || '') + ";";
    csv += (formValues['email'] || '') + ";";
    csv += (formValues['telefone'] || '') + ";";
    csv += (formValues['celular'] || '') + ";";
    csv += (formValues['nacionalidade'] || '') + ";";
    csv += (formValues['chegadaPais'] || '') + ";";
    csv += (formValues['nomePai'] || '') + ";";
    csv += (formValues['nomeMae'] || '') + ";";
    csv += (formValues['sexo'] || '') + ";";
    csv += (formValues['estadocivil'] || '') + ";";
    csv += (formValues['dependentes'] || '') + ";";
    csv += (formValues['grupoSanguineo'] || '') + ";";
    csv += (formValues['corPele'] || '') + ";";
    csv += (formValues['escolaridade'] || '') + ";";
    csv += (formValues['formacao'] || '') + ";";
    csv += (formValues['instituicao'] || '') + ";";
    csv += (formValues['instagram'] || '') + ";";
    csv += (formValues['linkedin'] || '') + ";";

    csv += (formValues['cep'] || '') + ";";
    csv += (formValues['rua'] || '') + ";";
    csv += (formValues['numero'] || '') + ";";
    csv += (formValues['complemento'] || '') + ";";
    csv += (formValues['bairroRes'] || '') + ";";
    csv += (formValues['cidadeRes'] || '') + ";";
    csv += (formValues['uf'] || '') + ";";

    csv += (formValues['banco'] || '') + ";";
    csv += (formValues['agencia'] || '') + ";";
    csv += (formValues['conta'] || '') + ";";
    csv += (formValues['nomeAgencia'] || '') + ";";
    csv += (formValues['PIX'] || '') + ";";
    csv += (formValues['cidadeAgencia'] || '') + ";";
    csv += (formValues['bairroAgencia'] || '') + ";";

    var encodedUri = encodeURI(csv);

    var downloadLink = document.createElement("a");
    downloadLink.setAttribute("download", "Informações.csv");
    downloadLink.setAttribute("href", encodedUri);
    document.body.appendChild(downloadLink);
    downloadLink.click();
    downloadLink.remove();

    clearForm();
}

// ==========================================================================================

// MODAL:
function showModal(message, buttons = [], showCloseButton = true) {
    // Disable page scrolling
    document.body.style.overflow = 'hidden';

    // Overlay
    const overlay = document.createElement('div');
    overlay.classList.add('modal-overlay');

    // Modal
    const modal = document.createElement('div');
    modal.classList.add('modal-container');

    const title = document.createElement('h4');
    title.innerText = 'Atenção:';
    title.classList.add('modal-title');
    modal.appendChild(title);

    const messageText = document.createElement('p');
    messageText.innerText = message;
    messageText.classList.add('modal-message');
    modal.appendChild(messageText);

    // Add buttons
    buttons.forEach(button => {
        const btn = document.createElement('button');
        btn.textContent = button.text;
        btn.classList.add('btn', 'btn-light');
        btn.addEventListener('click', button.action);
        modal.appendChild(btn);
    });

    // Message container for button actions
    const actionMessage = document.createElement('p');
    actionMessage.classList.add('action-message');
    modal.appendChild(actionMessage);

    // Conditionally add close button
    if (showCloseButton) {
        const closeButton = document.createElement('button');
        closeButton.innerText = '×';
        closeButton.classList.add('modal-close-btn');

        closeButton.focus();

        // Remove
        closeButton.onclick = function () {
            document.body.removeChild(modal);
            document.body.removeChild(overlay);
            // Re-enable page scrolling
            document.body.style.overflow = '';
        };

        modal.appendChild(closeButton);
    }
    // Add overlay + modal
    document.body.appendChild(overlay);
    document.body.appendChild(modal);
}

function closeModal() {
    const modal = document.querySelector('.modal-container');
    const overlay = document.querySelector('.modal-overlay');
    if (modal) document.body.removeChild(modal);
    if (overlay) document.body.removeChild(overlay);
    // Re-enable page scrolling
    document.body.style.overflow = '';
}

// ==========================================================================================

//Função para carregar informações do CSV

function readCSV(input) {
    if (input.files && input.files[0]) {
        var file = input.files[0];

        if (!file.name.toLowerCase().endsWith('.csv')) {
            showModal('Por favor, carregue apenas arquivos no formato .csv');
            return;
        }
        var reader = new FileReader();

        reader.onload = function (e) {
            try {
                // CSV upload
                var csv = e.target.result;
                var lines = csv.split('\n').filter(line => line.trim() !== ''); // Ignore empty lines
                var headers = lines[0].split(';').map(header => header.trim()); // Remove extra spaces and use ';' as delimiter

                // Column indexes
                var nome = headers.indexOf('Nome');
                var data_nasc = headers.indexOf('Data de Nascimento');
                var rg = headers.indexOf('RG');
                var expedicao = headers.indexOf('Expedicao');
                var orgao_emissor = headers.indexOf('Orgao Emissor');
                var cpf = headers.indexOf('CPF');
                var email = headers.indexOf('Email');
                var telefone = headers.indexOf('Telefone');
                var celular = headers.indexOf('Celular');
                var nacionalidade = headers.indexOf('Nacionalidade');
                var chegada_pais = headers.indexOf('Chegada no Pais');
                var nome_pai = headers.indexOf('Nome do Pai');
                var nome_mae = headers.indexOf('Nome da Mae');
                var sexo = headers.indexOf('Sexo');
                var estado_civil = headers.indexOf('Estado Civil');
                var numero_dependentes = headers.indexOf('N Dependentes');
                var grupo_sanguineo = headers.indexOf('Grupo Sanguineo');
                var cor_pele = headers.indexOf('Cor da Pele');
                var escolaridade = headers.indexOf('Escolaridade');
                var formacao_andamento = headers.indexOf('Formacao em Andamento');
                var instituicao_ensino = headers.indexOf('Instituicao de Ensino');
                var instagram = headers.indexOf('Instagram');
                var linkedin = headers.indexOf('LinkedIn');

                var cep = headers.indexOf('CEP');
                var rua = headers.indexOf('Rua');
                var numero = headers.indexOf('Numero');
                var complemento = headers.indexOf('Complemento');
                var bairro = headers.indexOf('Bairro');
                var cidade = headers.indexOf('Cidade');
                var uf = headers.indexOf('UF');

                var banco = headers.indexOf('Banco');
                var agencia = headers.indexOf('Agencia');
                var conta_agencia = headers.indexOf('Conta');
                var nome_agencia = headers.indexOf('Nome da Agencia');
                var pix = headers.indexOf('PIX');
                var cidade_agencia = headers.indexOf('Cidade da Agencia');
                var bairro_agencia = headers.indexOf('Bairro da Agencia');

                // Checking if all columns exist
                if (nome === -1 || data_nasc === -1 || rg === -1 || expedicao === -1 ||
                    orgao_emissor === -1 || cpf === -1 || email === -1 || telefone === -1 || celular === -1 ||
                    nacionalidade === -1 || chegada_pais === -1 ||
                    nome_pai === -1 || nome_mae === -1 || sexo === -1 || estado_civil === -1 ||
                    numero_dependentes === -1 || grupo_sanguineo === -1 || cor_pele === -1 ||
                    escolaridade === -1 || formacao_andamento === -1 || instituicao_ensino === -1 ||
                    instagram === -1 || linkedin === -1 || cep === -1 || rua === -1 ||
                    numero === -1 || complemento === -1 || bairro === -1 || cidade === -1 || uf === -1 ||
                    banco === -1 || agencia === -1 || conta_agencia === -1 || nome_agencia === -1 || pix === -1 ||
                    cidade_agencia === -1 || bairro_agencia === -1
                ) {
                    showModal('Colunas necessárias não encontradas no arquivo .csv');
                    return;
                }
                // Default message
                var message = "Arquivo correto";
                for (var i = 1; i < lines.length; i++) {
                    var data = lines[i].split(';');
                    // Checks if the row has the expected number of columns
                    if (data.length < headers.length) {
                        console.warn(`Linha ${i + 1} ignorada: ${lines[i]}`);
                        continue; // Ignore lines with incomplete data
                    }

                    // Preencher os inputs
                    document.getElementById('nome').value = data[nome];
                    document.getElementById('dataNascimento').value = data[data_nasc];
                    document.getElementById('rg').value = data[rg];
                    document.getElementById('expedicao').value = data[expedicao];
                    document.getElementById('orgaoEmissor').value = data[orgao_emissor];
                    document.getElementById('cpf').value = data[cpf];
                    document.getElementById('email').value = data[email];
                    document.getElementById('telefone').value = data[telefone];
                    document.getElementById('celular').value = data[celular];
                    document.getElementById('nacionalidade').value = data[nacionalidade];
                    document.getElementById('chegadaPais').value = data[chegada_pais];
                    document.getElementById('nomePai').value = data[nome_pai];
                    document.getElementById('nomeMae').value = data[nome_mae];
                    document.getElementById('sexo').value = data[sexo];
                    document.getElementById('estadocivil').value = data[estado_civil];
                    document.getElementById('dependentes').value = data[numero_dependentes];
                    document.getElementById('grupoSanguineo').value = data[grupo_sanguineo];
                    document.getElementById('corPele').value = data[cor_pele];
                    document.getElementById('escolaridade').value = data[escolaridade];
                    document.getElementById('formacao').value = data[formacao_andamento];
                    document.getElementById('instituicao').value = data[instituicao_ensino];
                    document.getElementById('instagram').value = data[instagram];
                    document.getElementById('linkedin').value = data[linkedin];
                    document.getElementById('cep').value = data[cep];
                    document.getElementById('rua').value = data[rua];
                    document.getElementById('numero').value = data[numero];
                    document.getElementById('complemento').value = data[complemento];
                    document.getElementById('bairroRes').value = data[bairro];
                    document.getElementById('cidadeRes').value = data[cidade];
                    document.getElementById('uf').value = data[uf];
                    document.getElementById('banco').value = data[banco];
                    document.getElementById('agencia').value = data[agencia];
                    document.getElementById('conta').value = data[conta_agencia];
                    document.getElementById('nomeAgencia').value = data[nome_agencia];
                    document.getElementById('PIX').value = data[pix];
                    document.getElementById('cidadeAgencia').value = data[cidade_agencia];
                    document.getElementById('bairroAgencia').value = data[bairro_agencia];

                }

                // Error
                if (message) {
                    showModal(message);
                }
                // OK
                else {
                    var resultInput = document.getElementById('fileNameInput');
                    if (resultInput) {
                        resultInput.value = file.name;
                    } else {
                        console.error('Input de nome do arquivo não encontrado.');
                    }
                }

                // Reset input to allow re-upload of the same file
                input.value = '';

            } catch (error) {
                console.error('Erro ao processar o arquivo .csv:', error);
            }
        };
        reader.readAsText(file);
    }
}

// ==========================================================================================

//Função para esconder o campo "Chegada no País"

document.addEventListener("DOMContentLoaded", function() {
    const nacionalidade = document.getElementById("nacionalidade");
    const chegadaLabel = document.getElementById("chegadaLabel");
    const chegadaPais = document.getElementById("chegadaPais");

    // Função para mostrar/esconder o <p> e o input
    function toggleChegadaPais() {
        if (nacionalidade.value !== "Brasileiro (a)" && nacionalidade.value !== "") {
            chegadaLabel.style.display = "block"; // Mostra o <p>
            chegadaPais.style.display = "block";  // Mostra o input
        } else {
            chegadaLabel.style.display = "none";  // Esconde o <p>
            chegadaPais.style.display = "none";   // Esconde o input
        }
    }

    // Esconde o <p> e o input inicialmente
    chegadaLabel.style.display = "none";
    chegadaPais.style.display = "none";

    // Adiciona o evento de mudança no select
    nacionalidade.addEventListener("change", toggleChegadaPais);
});

// ==========================================================================================

// Chama o JSON para opções de universidades
fetch('../json/ies.json')
    .then(response => response.json())
    .then(data => {
        const select = document.getElementById('instituicao');
        data.forEach(instituicao => {
            const option = document.createElement('option');
            option.value = instituicao.id;  // Define o valor do campo option com o ID
            option.textContent = instituicao.ies_razaosocial;  // Exibe o nome da instituição
            select.appendChild(option);
        });
    })
    .catch(error => console.error('Erro ao carregar o arquivo JSON:', error));

// ==========================================================================================