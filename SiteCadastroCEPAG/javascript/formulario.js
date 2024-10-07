function imprimirPagina() {
    window.print();
}

function obterDataAtual() {
    const hoje = new Date(); // Cria um objeto de data com a data atual

    const dias = hoje.getDate(); // Obtém o dia do mês
    const mes = hoje.toLocaleString('pt-BR', { month: 'long' }); // Obtém o mês em formato longo (ex: Outubro)
    const ano = hoje.getFullYear(); // Obtém o ano

    return `Curitiba, ${dias} de ${mes} de ${ano}.`; // Retorna a string formatada
}

// Insere a data formatada no elemento com o id "data"
document.getElementById('data').textContent = obterDataAtual();