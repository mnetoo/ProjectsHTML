let contador = 0;
let input = document.getElementById("inputTarefa");
let btnAdd = document.getElementById("btn-add");
let main = document.getElementById("areaLista");

function addTarefa() {
    // PEGAR O VALOR DIGITADO NO INPUT
    let valorInput = input.value;

    // SE NÃO FOR VAZIO, NEM NULO, NEM INDEFINIDO
    if (valorInput !== "" && valorInput !== null && valorInput !== undefined) {
        contador++; // Incrementa o contador

        let novoItem = `
            <div id="${contador}" class="item">
                <div onclick="marcarTarefa(${contador})" class="item-icone">
                    <i id="icone_${contador}" class="mdi mdi-circle-outline"></i>
                </div>
                <div onclick="marcarTarefa(${contador})" class="item-nome">
                    ${valorInput}
                </div>
                <div class="item-botao">
                    <button onclick="deletar(${contador})" class="delete"><i class="mdi mdi-delete"></i> Deletar</button>
                </div>
            </div>`;

        // ADICIONAR NOVO ITEM NO MAIN
        main.innerHTML += novoItem;

        // ZERAR OS CAMPOS
        input.value = "";
        input.focus();
    }
}