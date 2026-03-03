<?php
// =============================================================
// logica.php - Lógica del Reloj Espejo
// Este archivo se incluye con REQUIRE porque es OBLIGATORIO
// para que el programa funcione correctamente.
// Si este archivo falta, el programa se detendrá con un error fatal.
// =============================================================

/**
 * Función que calcula la hora real a partir de la hora vista en el espejo.
 * 
 * @param string $horaEspejo La hora en formato HH:MM vista en el espejo
 * @return array Un array con 'horaReal' (string HH:MM) y 'detalles' (array con los pasos)
 */
function calcularHoraReal($horaEspejo) {
    // Separar hora y minutos
    $partes = explode(':', $horaEspejo); // Dividimos la cadena usando ':' como separador
    $h = intval($partes[0]); // Convertimos la hora a entero
    $m = intval($partes[1]); // Convertimos los minutos a entero

    // Guardar valores originales para mostrar los pasos
    $hOriginal = $h;
    $mOriginal = $m;

    // Calcular hora real
    $hReal = 12 - $h; // Restamos la hora leída a 12
    if ($hReal == 0) { // Si el resultado es 0
        $hReal = 12; // Corregimos a 12
    }

    // Calcular minutos reales
    $mReal = 60 - $m; // Restamos los minutos leídos a 60
    if ($mReal == 60) { // Si el resultado es 60 (minutos eran :00)
        $mReal = 0; // Corregimos a 0
    } else {
        // Si los minutos no son 00, restamos 1 hora adicional
        $hReal = $hReal - 1;
        if ($hReal == 0) {
            $hReal = 12;
        }
    }

    // Formatear con ceros a la izquierda
    $hRealStr = sprintf("%02d", $hReal); // Formato de 2 dígitos con cero a la izquierda
    $mRealStr = sprintf("%02d", $mReal); // Formato de 2 dígitos con cero a la izquierda

    // Retornar resultado con detalles del cálculo
    return [
        'horaReal' => $hRealStr . ':' . $mRealStr,
        'detalles' => [
            'horaEspejo' => sprintf("%02d", $hOriginal),
            'minutosEspejo' => sprintf("%02d", $mOriginal),
            'pasoHora' => "12 - $hOriginal = " . (12 - $hOriginal),
            'pasoMinutos' => $mOriginal == 0 ? "Minutos en 00, se mantienen" : "60 - $mOriginal = " . (60 - $mOriginal),
            'ajusteHora' => $mOriginal != 0 ? "Se resta 1 hora adicional porque los minutos no son 00" : "Sin ajuste",
            'horaFinal' => $hRealStr,
            'minutosFinal' => $mRealStr
        ]
    ];
}
?>
