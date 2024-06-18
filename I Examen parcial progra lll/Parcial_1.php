<!DOCTYPE HTML>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas del Hotel</title>
    <style>
        body {
            background-color: #D2691E;
            color: black;
            text-align: center;
        }
        .container {
            width: 50%;
            background-color: #A9A9A9;
            border-radius: 5px;
            padding: 20px;
        }
        input[type="submit"] {
            background-color: #B8860B;
            color: black;
        }
        .reservations {
            background-color: #FFF0F5;
        }
        table {
            width: 100%;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

<?php
function mostrarReservas() {
    $archivo = 'reservaciones.txt';
    if (file_exists($archivo)) {
        $reservas = file($archivo, FILE_IGNORE_NEW_LINES);
        if (!empty($reservas)) {
            echo "<div class='reservations'><h3>Todas las Reservas</h3>";
            echo "<table>";
            echo "<tr><th>Hotel</th><th>Nombre</th><th>Apellido</th><th>Teléfono</th><th>Fecha de Reservación</th><th>Fecha de Salida</th><th>Acción</th></tr>";
            foreach ($reservas as $index => $reservacion) {
                $datos_reserva = explode(", ", $reservacion);
                $num_elementos = count($datos_reserva);
                if ($num_elementos >= 6) {
                    echo "<tr>";
                    for ($i = 0; $i < 6; $i++) {
                        echo "<td>" . htmlspecialchars(explode(": ", $datos_reserva[$i])[1]) . "</td>";
                    }
                    echo "<td><form action='' method='post'><input type='hidden' name='delete_index' value='$index'><input type='submit' value='Eliminar'></form></td>";
                    echo "</tr>";
                }
            }
            echo "</table></div>";
        } else {
            echo "<div class='reservations'><h3>No hay reservas.</h3></div>";
        }
    } else {
        echo "<div class='reservations'><h3>No hay reservas.</h3></div>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_index'])) {
        $delete_index = intval($_POST['delete_index']);
        $archivo = 'reservaciones.txt';
        $reservas = file($archivo, FILE_IGNORE_NEW_LINES);
        if (isset($reservas[$delete_index])) {
            unset($reservas[$delete_index]);
            file_put_contents($archivo, implode("\n", $reservas) . "\n");
            header("Location: " . basename($_SERVER['PHP_SELF']));
            exit();
        } else {
            echo "<div class='result'>Error al eliminar la reservación.</div>";
        }
    } else {
        $datos_reserva = array();
        $campos = array('hotel', 'nombre', 'apellido', 'telefono', 'fecha_reservacion', 'fecha_salida');
        foreach ($campos as $campo) {
            if (!empty($_POST[$campo])) {
                $datos_reserva[] = ucfirst($campo) . ": " . $_POST[$campo];
            }
        }
        if (!empty($datos_reserva)) {
            $reservacion = implode(", ", $datos_reserva) . "\n";
            $archivo = 'reservaciones.txt';
            if (file_put_contents($archivo, $reservacion, FILE_APPEND | LOCK_EX)) {
                header("Location: " . basename($_SERVER['PHP_SELF']));
                exit();
            } else {
                echo "<div class='result'>Error al guardar la reservación.</div>";
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    mostrarReservas();
}
?>

<div class="container">
    <h2>Haga su reservación</h2>
    <form action="" method="post">
        <select name="hotel" required>
            <option value="">Seleccione un hotel</option>
            <option value="Hotel Galapagos">Hotel Galapagos</option>
            <option value="Hotel El guarco">Hotel El Guarco</option>
            <option value="Hotel Gaia">Hotel Gaia</option>
            <option value="Hotel Sword">Hotel Sword</option>
            <option value="Hotel Pink">Hotel Pink</option>
        </select>
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" placeholder="Apellido" required>
        <input type="text" name="telefono" placeholder="Teléfono" required>
        <input type="date" name="fecha_reservacion" required>
        <input type="date" name="fecha_salida" required>
        <input type="submit" value="Reservar">
    </form>
</div>

</body>
</html>