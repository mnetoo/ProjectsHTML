/* let formatted = true;

if (formatted) {
  alert('The code is easy to read');
}

let counter = 120; // counter is a number
counter = false;   // counter is now a boolean
counter = "foo";   // counter is now a string

console.log(typeof(counter)); // "number"

counter = false; 
console.log(typeof(counter)); // "boolean"

counter = "Hi";
console.log(typeof(counter)); // "string"

let teste;
console.log(teste);        // undefined
console.log(typeof teste); // undefined

let str = "JavaScript";
console.log(str);
str = str + " String";
console.log(str);

let inProgress = true;
let completed = false;

console.log(typeof completed); // boolean

let pageView = 9007199254740991n;
console.log(typeof(pageView)); // 'bigint'

let contact = {
    firstName: 'John',
    lastName: 'Doe',
    email: 'john.doe@example.com',
    phone: '(408)-555-9999',
    address: {
        building: '4000',
        street: 'North 1st street',
        city: 'San Jose',
        state: 'CA',
        country: 'USA'
    }
}

console.log(contact.firstName);
console.log(contact.lastName);
console.log(contact.address.country);

let error = 'An error occurred';
let hasError = Boolean(error);

console.log(error);
console.log(hasError);

error = 'An error occurred';

if (error) {
  console.log(error);
}

let name = 'John';
console.log(name);

let message = `Hi, I'm ${name}.`;

console.log(message);

let status = false;
console.log(status);
let word = status.toString();
console.log(status);
let back = Boolean(str); */

// Função para gerar uma posição aleatória dentro da janela do navegador

// Função para gerar uma posição aleatória dentro da janela do navegador
function posicaoAleatoria() {
  const larguraJanela = window.innerWidth;
  const alturaJanela = window.innerHeight;

  // Define a posição aleatória dentro dos limites da janela
  const novaPosicaoX = Math.random() * (larguraJanela - 100); // 100 para não sair da janela
  const novaPosicaoY = Math.random() * (alturaJanela - 50);   // 50 para evitar sobreposição na margem superior

  return { x: novaPosicaoX, y: novaPosicaoY };
}

// Função para mover o botão quando o mouse passa por cima
function moverBotao() {
  const botao = document.getElementById("botao");
  const novaPosicao = posicaoAleatoria();

  botao.style.left = novaPosicao.x + "px";
  botao.style.top = novaPosicao.y + "px";
}

// Adiciona o evento de passar o mouse sobre o botão
document.getElementById("botao").addEventListener("mouseover", moverBotao);



