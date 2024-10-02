let numero = prompt("Digite um número de 1 a 10");

if (numero <= 10 && numero >= 1)
{
    document.write(`O número ${numero} ao quadrado é ${numero * numero}`)
}
else
{
    document.write("Número invalido.")
}