<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .column {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Generador de códigos</h1>
    </header>
    <div class="container">
        <div class="column" id="column1"></div>
        <div class="column" id="column2"></div>
        <div class="column" id="column3"></div>
        <div class="column" id="column4"></div>
    </div>
    <button onclick="random()">Generar</button>
    <div>
        <h2 id="codigoTitulo"></h2>
        <input type="text" id="code" placeholder="Ingrese código">
        <button onclick="verificarCodigo()">Verificar</button>
    </div>
    <script>
        var array = [];

        function random() {
            array = [];
            while (array.length < 40) {
                const minCeiled = Math.ceil(1000);
                const maxFloored = Math.floor(9999);
                array.push({
                    value: Math.floor(Math.random() * (maxFloored - minCeiled) + minCeiled),
                    position: array.length + 1
                });
            }
            mostrarArray(array);
            mostrarPosicionAleatoria();
        }

        function mostrarArray(array) {
            const column1 = document.getElementById('column1');
            const column2 = document.getElementById('column2');
            const column3 = document.getElementById('column3');
            const column4 = document.getElementById('column4');
            column1.innerHTML = '';
            column2.innerHTML = '';
            column3.innerHTML = '';
            column4.innerHTML = '';
            array.forEach(item => {
                const li = document.createElement('li');
                li.textContent = ` ${item.position}. ${item.value}`;
                if (item.position <= 10) {
                    column1.appendChild(li);
                } else if (item.position <= 20) {
                    column2.appendChild(li);
                } else if (item.position <= 30) {
                    column3.appendChild(li);
                } else {
                    column4.appendChild(li);
                }
            });
        }

        function obtenerPosicionAleatoria() {
            return Math.floor(Math.random() * 40) + 1;
        }

        function mostrarPosicionAleatoria() {
    const posicion = obtenerPosicionAleatoria();
    console.log("Posición aleatoria:", posicion); // Agregamos esta línea para depurar
    const codigoTitulo = document.getElementById('codigoTitulo');
    codigoTitulo.textContent = `Escriba el código #${posicion}`;
        }

        function verificarCodigo() {
            const codeInput = document.getElementById('code').value;
            const codigoTitulo = document.getElementById('codigoTitulo');
            const position = parseInt(codigoTitulo.textContent.split("#")[1]);
            if (!isNaN(position) && position >= 1 && position <= 40) {
                const codigoCorrecto = array[position - 1].value;
                if (codigoCorrecto == codeInput) {
                    alert('¡Código correcto!');
                } else {
                    alert('Código incorrecto. Inténtalo de nuevo.');
                }
            } else {
                alert('No hay ninguna posición especificada.');
            }
        }
    </script>
</body>
</html>
