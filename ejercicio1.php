<?php
// Uno esta sentado frente al espejo y mira la imagen de un reloj situado detras de usted. 
// Quiere saber que hora es. El reloj es un reloj tradicional que marca 12 horas tiene un minutero y uno que marca a hora. 
// Dado una cadena de numero que indica como se ve en el espejo. Se le pide devolver una cadena de nuemeros con la hora real.
// Por ejemplo si nos da la cadena 10:00 La respuesta será 02:00. 
// 01:45 salida 10 y 45. 03:40 salida 09:20.

$hora = ["03:30"];

for ($i = 0; $i < count($hora); $i++) { // Iniciamos un bucle para recorrer todas las horas del array
    $horaEspejo = $hora[$i]; // Obtenemos la hora actual del array usando el índice
    // Separar hora y minutos
    $partes = explode(':', $horaEspejo); // Dividimos la cadena de texto usando ':' como separador
    $h = $partes[0]; // Tomamos la primera parte (antes de los dos puntos) como la hora
    $m = $partes[1]; // Tomamos la segunda parte (después de los dos puntos) como los minutos

    // Calcular hora real
    $hReal = 12 - $h; // Restamos la hora leída a 12 para obtener la hora real invertida
    if ($hReal == 0) { // Si el resultado de la resta es 0 (ej. 12 - 12)
        $hReal = 12; // Corregimos la hora real para que sea 12
    }

    // Calcular minutos reales
    $mReal = 60 - $m; // Restamos los minutos leídos a 60 para obtener los minutos reales
    if ($mReal == 60) { // Si el resultado es 60 (ej. 60 - 0 minutos)
        $mReal = 0; // Corregimos los minutos reales para que sean 0
    }

    // Agregar cero a la izquierda si hace falta
    if ($hReal < 10) { // Verificamos si la hora real tiene un solo dígito (es menor a 10)
        $hReal = "0" . $hReal; // Concatenamos un '0' al principio de la hora
    }
    if ($mReal < 10) { // Verificamos si los minutos reales tienen un solo dígito (es menor a 10)
        $mReal = "0" . $mReal; // Concatenamos un '0' al principio de los minutos
    }

    echo "Espejo: " . $horaEspejo . " -- Hora real: " . $hReal . ":" . $mReal . "<br>"; // Imprimimos la hora original y la calculada
}
?>
