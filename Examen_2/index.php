<!DOCTYPE html>
<html lang="es"> 
<!-- El inicio de la estructura del HTML-->
<head>
    <meta charset="UTF-8">
    <title>Solicitud de Reservación</title>

    <!-- Despues del titulo esta parte es investigativapara dar un poco de personalidad al formulario con algunos rasgos basicos como el color y forma-->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #5499c7;
           

            text-align: center;
        }

        form {
            margin: 20px auto;
            padding: 20px;
            width: 400px;
            background-color: #A9A9A9;
            border: 1px solid #CCC;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        select,
        input[type=text],
        input[type=date],
        textarea {
            width: calc(100% - 20px);
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #CCC;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type=submit] {
            background-color: #4CAF50;

            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>

    <!-- La parte mas importante, la operativa-->
</head>

<body>
    <form action="Reservacion.php" method="post">  <!-- El action es para asociar el html al php y lograr una sinergia-->
        <h2>Solicitud de Reservación</h2>

        <!--El select es el tipo de input multi opcion donde se almacenan los hoteles como nombre-->

        <label for="hotel">Seleccione un hotel:</label>
        <select id="hotel" name="hotel" required>
            <option value="">Seleccione un hotel</option>
            <option value="Sheraton San Jose">Sheraton San Jose</option>
            <option value="Marriott Ocean & Golf Resort">Marriott Ocean & Golf Resort</option>
            <option value="Crowne Plaza San Jose">Crowne Plaza San Jose</option>
            <option value="Hotel Rancho Pacifico">Hotel Rancho Pacifico</option>
            <option value="Planet Holliwood">Planet Holliwood</option>
        </select><br><br>

        <!-- Diferentes input de texto y un date para la fecha-->

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required><br><br>

        <label for="fecha">Fecha de reservación:</label>
        <input type="date" id="fecha" name="fecha" required><br><br>

        <label for="observaciones">Observaciones:</label>

        <!-- Operador submit que envia la informacion a ser procesada por el php-->
         
        <textarea id="observaciones" name="observaciones" rows="4"></textarea><br><br>

        <input type="submit" value="Enviar Solicitud">
    </form>
</body>

</html>