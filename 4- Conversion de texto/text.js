class TransformadorTexto {
    constructor(texto) {
        this.texto = texto;
    }

    obtenerCantidadCaracteres() {
        return this.texto.length;
    }

    convertirAMayusculas() {
        return this.texto.toUpperCase();
    }

    convertirAMinusculas() {
        return this.texto.toLowerCase();
    }

    esPalindroma() {
        const textoSinEspacios = this.texto.toLowerCase().replace(/\s/g, '');
        const textoReverso = textoSinEspacios.split('').reverse().join('');
        return textoSinEspacios === textoReverso;
    }
}

function usarTransformadorTexto() {
    const texto = prompt("Introduce un texto:");
    if (texto) {
        const transformador = new TransformadorTexto(texto);

        console.log("Texto original:", texto);
        console.log("Cantidad de caracteres:", transformador.obtenerCantidadCaracteres());
        console.log("En mayúsculas:", transformador.convertirAMayusculas());
        console.log("En minúsculas:", transformador.convertirAMinusculas());
        console.log("¿Es palíndroma?:", transformador.esPalindroma() ? "Sí" : "No");
    } else {
        console.log("No has introducido ningún texto.");
    }
}

usarTransformadorTexto();
