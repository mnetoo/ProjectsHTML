function eventoClick() {
    //alert("Você clicou no botão!");
    document.body.style.backgroundColor = "yellow";
}

function viraVermelho() {
    let div = document.getElementById("div1");
    div.style.backgroundColor = "red";
}

function viraPreto() {
    let div = document.getElementById("div1");
    div.style.backgroundColor = "black";
}

function focado() {
    let input = document.getElementById("formGroupExampleInput");
    input.style.transition = "background-color 0.2s ease";
    input.style.backgroundColor = "white";
    input.style.border = "none";
}

function desfocado() {
    let input = document.getElementById("formGroupExampleInput");
    input.style.transition = "background-color 0.2s ease";
    input.style.backgroundColor = "rgb(206, 229, 250)";
}