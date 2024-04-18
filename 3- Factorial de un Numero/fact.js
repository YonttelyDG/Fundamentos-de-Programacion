function factorial(numero) {
    let res = 1;
    for (let i = 1; i <= numero; i++) {
        res *= i;
    }
    return res;
}

const numero = parseInt(prompt("Ingresa un número para calcular su factorial:"));

if (isNaN(numero)) {
    console.log("Por favor, ingresa un número válido.");
} else if (numero < 0) {
    console.log("El factorial de un número negativo no está definido.");
} else {
    const res = factorial(numero);
    console.log(`El factorial de ${numero} es: ${res}`);
}
