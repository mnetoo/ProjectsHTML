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

    csv += "Solicitante;Setor;Telefone;Numero do Registro;Tipo do Equipamento;Marca e Modelo;Data de Retirada;Data de Devolucao;Objetivo de Uso;Local de Uso;Grau de Fragilidade;Estado do Equipamento;Descricao\n";

    csv += (formValues['solicitante'] || '') + ";";
    csv += (formValues['setor'] || '') + ";";
    csv += (formValues['telefone'] || '') + ";";
    csv += (formValues['registro'] || '') + ";";
    csv += (formValues['tipo'] || '') + ";";
    csv += (formValues['marca'] || '') + ";";
    csv += (formValues['retirada'] || '') + ";";
    csv += (formValues['devolucao'] || '') + ";";
    csv += (formValues['obj_uso'] || '') + ";";
    csv += (formValues['local_uso'] || '') + ";";

    // Corrigindo captura do valor de grau de fragilidade
    var fragilidade = document.querySelector('input[name="inlineRadioOptions"]:checked');
    if (fragilidade) {
        csv += fragilidade.value + ";";
    } else {
        csv += ";";
    }

    // Corrigindo captura do valor de estado do equipamento
    var estadoEquipamento = document.querySelector('input[name="equipamento_estado"]:checked');
    if (estadoEquipamento) {
        csv += estadoEquipamento.value + ";";
    } else {
        csv += ";";
    }

    csv += (formValues['textarea'] || '') + ";";


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
                var solicitante = headers.indexOf('Solicitante');
                var setor = headers.indexOf('Setor');
                var telefone = headers.indexOf('Telefone');
                var num_registro = headers.indexOf('Numero do Registro');
                var tipo_equip = headers.indexOf('Tipo do Equipamento');
                var marca_modelo = headers.indexOf('Marca e Modelo');
                var data_retirada = headers.indexOf('Data de Retirada');
                var data_devolucao = headers.indexOf('Data de Devolucao');
                var obj_uso = headers.indexOf('Objetivo de Uso');
                var local_uso = headers.indexOf('Local de Uso');
                var grau_fragilidade = headers.indexOf('Grau de Fragilidade');
                var estado_equip = headers.indexOf('Estado do Equipamento');
                var campo_textarea = headers.indexOf('Descricao');

                // Checking if all columns exist
                if (solicitante === -1 || setor === -1 || telefone === -1 || num_registro === -1 ||
                    tipo_equip === -1 || marca_modelo === -1 || data_retirada === -1 || data_devolucao === -1 ||
                    obj_uso === -1 || local_uso === -1 ||
                    grau_fragilidade === -1 || estado_equip === -1 || campo_textarea === -1) 
                    {
                    showModal('Colunas necessárias não encontradas no arquivo .csv');
                    return;
                }

                // Default message
                var message = "Arquivo correto";
                for (var i = 1; i < lines.length; i++) {
                    var data = lines[i].split(';');
                    // Checks if the row has the expecte number of columns
                    if (data.length < headers.length) {
                        console.warn(`Linha ${i + 1} ignorada: ${lines[i]}`);
                        continue; // Ignore lines with incomplete data
                    }

                    // Preencher os inputs
                    document.getElementById('solicitante').value = data[solicitante];
                    document.getElementById('setor').value = data[setor];
                    document.getElementById('telefone').value = data[telefone];
                    document.getElementById('registro').value = data[num_registro];
                    document.getElementById('tipo').value = data[tipo_equip];
                    document.getElementById('marca').value = data[marca_modelo];
                    document.getElementById('retirada').value = data[data_retirada];
                    document.getElementById('devolucao').value = data[data_devolucao];
                    document.getElementById('obj_uso').value = data[obj_uso];
                    document.getElementById('local_uso').value = data[local_uso];

                   
                    const grauFragilidade = data[grau_fragilidade]; 

                    if (grauFragilidade === 'Alto') {
                        document.getElementById('inlineRadio1').checked = true;
                        const value = document.getElementById('inlineRadio1').value; // Pegue o value do input
                        console.log(value); // Exibe o value no console
                    } else if (grauFragilidade === 'Médio') {
                        document.getElementById('inlineRadio2').checked = true;
                        const value = document.getElementById('inlineRadio2').value; // Pegue o value do input
                        console.log(value); // Exibe o value no console
                    } else if (grauFragilidade === 'Baixo') {
                        document.getElementById('inlineRadio3').checked = true;
                        const value = document.getElementById('inlineRadio3').value; // Pegue o value do input
                        console.log(value); // Exibe o value no console
                    }

                    
                    const estadoEquip = data[estado_equip]; // Obtenha o estado do equipamento

                    if (estadoEquip === 'Equipamento sem danos') {
                        document.getElementById('equipamento_sem_danos').checked = true; // Corrigido o ID
                        const value = document.getElementById('equipamento_sem_danos').value; // Pegue o value do input
                        console.log(value); // Exibe o value no console
                    } else if (estadoEquip === 'Equipamento com danos') {
                        document.getElementById('equipamento_danos').checked = true; // Sem correções necessárias aqui
                        const value = document.getElementById('equipamento_danos').value; // Pegue o value do input
                        console.log(value); // Exibe o value no console
                    }
                    

                    document.getElementById('textarea').value = data[campo_textarea];
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

// ==========================================================================================d