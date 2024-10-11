function imprimirPagina() {
    window.print();
}
//-----------------------------------------------------------------------

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
//------------------------------------------------------------------------
