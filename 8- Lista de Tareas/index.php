<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Tareas</h1>
        <div id="tareas">
            <?php mostrarTareas(); ?>
        </div>
        <form action="index.php" method="post">
            <input type="text" name="tarea" placeholder="Escribe una nueva tarea">
            <button type="submit">Agregar</button>
        </form>
        <form id="formEditarTarea" action="index.php" method="post" style="display: none;">
            <input type="hidden" id="idTarea" name="idTarea">
            <input type="text" id="editarTarea" name="editarTarea">
            <button type="submit" onclick="guardarEdicion()">Guardar</button>
            <button type="button" onclick="cancelarEdicion()">Cancelar</button>
        </form>
    </div>

    <script>
        function editarTarea(id, tarea) {
            document.getElementById("idTarea").value = id;
            document.getElementById("editarTarea").value = tarea;
            document.getElementById("formEditarTarea").style.display = "block";
        }

        function cancelarEdicion() {
            document.getElementById("formEditarTarea").style.display = "none";
        }

        function guardarEdicion() {
            var tareaEditada = document.getElementById("editarTarea").value;
            if (tareaEditada.trim() !== "") {
                document.getElementById("formEditarTarea").submit();
                location.reload();
            } else {
                alert("Por favor, ingresa un nombre válido para la tarea.");
            }
        }

        function eliminarTarea(idTarea) {
            if (confirm("¿Estás seguro de que deseas eliminar esta tarea?")) {
                var form = document.createElement('form');
                form.method = 'post';
                form.action = 'index.php';
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'eliminarTarea';
                input.value = idTarea;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>

<?php
function mostrarTareas() {
    $tareas = obtenerTareas();
    if ($tareas === null) {
        echo "<p>No hay tareas disponibles.</p>";
    } else {
        echo "<ul>";
        foreach ($tareas as $key => $tarea) {
            echo "<li>{$tarea['id']}: {$tarea['nombre']} <button onclick='editarTarea({$tarea['id']}, \"{$tarea['nombre']}\")'>Editar</button> <button onclick='eliminarTarea({$tarea['id']})'>Eliminar</button></li>";
        }
        echo "</ul>";
    }
}

function obtenerTareas() {
    if (file_exists('tasks.json')) {
        $jsonString = file_get_contents('tasks.json');
        $data = json_decode($jsonString, true);
        return $data['tasks'];
    } else {
        return null;
    }
}

function guardarTareas($tareas) {
    $data = ['tasks' => $tareas];
    $jsonString = json_encode($data);
    file_put_contents('tasks.json', $jsonString);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tarea"])) {
    $tareas = obtenerTareas();
    if ($tareas === null) {
        $tareas = [];
    }
    $nuevaTarea = [
        'id' => count($tareas) + 1,
        'nombre' => $_POST["tarea"]
    ];
    $tareas[] = $nuevaTarea;
    guardarTareas($tareas);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idTarea"]) && isset($_POST["editarTarea"])) {
    $idTarea = $_POST["idTarea"];
    $editarTarea = $_POST["editarTarea"];
    $tareas = obtenerTareas();
    if ($tareas !== null) {
        foreach ($tareas as &$tarea) {
            if ($tarea['id'] == $idTarea) {
                $tarea['nombre'] = $editarTarea;
                break;
            }
        }
        guardarTareas($tareas);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminarTarea"])) {
    $idTarea = $_POST["eliminarTarea"];
    $tareas = obtenerTareas();
    if ($tareas !== null) {
        foreach ($tareas as $key => $tarea) {
            if ($tarea['id'] == $idTarea) {
                unset($tareas[$key]);
                break;
            }
        }
        guardarTareas(array_values($tareas));
    }
}
?>
