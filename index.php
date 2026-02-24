<?php
// =============================================================
// index.php - Procesa el formulario del Reloj Espejo
// 
// REQUIRE vs INCLUDE:
// - require: Si el archivo no existe, genera un ERROR FATAL y detiene el script.
//   Se usa para archivos ESENCIALES (como la lógica del programa).
// - include: Si el archivo no existe, genera una ADVERTENCIA pero el script continúa.
//   Se usa para archivos NO ESENCIALES (como el header o footer).
// =============================================================

// REQUIRE - Incluimos la lógica del reloj espejo
// Si este archivo no existe, el programa NO puede funcionar, por eso usamos require
require 'logica.php';

// Procesar el formulario si se envió
$resultado = null;
$horaIngresada = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $horaIngresada = isset($_POST['hora']) ? trim($_POST['hora']) : '';
    $minutoIngresado = isset($_POST['minuto']) ? trim($_POST['minuto']) : '';
    
    // Validar que se ingresaron valores
    if ($horaIngresada !== '' && $minutoIngresado !== '') {
        $horaCompleta = sprintf("%02d:%02d", intval($horaIngresada), intval($minutoIngresado));
        $resultado = calcularHoraReal($horaCompleta);
        $horaIngresada = $horaCompleta;
    }
}

// INCLUDE - Incluimos el header (encabezado HTML)
// Si este archivo falta, la página se verá mal pero no se rompe el programa
include 'header.php';
?>

        <main class="main-content">
            <?php if ($resultado): ?>
            <!-- Resultado -->
            <section class="result-section" id="resultado">
                <div class="result-card">
                    <div class="result-header">
                        <h2>Resultado</h2>
                    </div>
                    
                    <div class="clocks-comparison">
                        <div class="clock-box mirror-clock">
                            <div class="clock-label">🪞 Hora en el Espejo</div>
                            <div class="clock-display mirror-display"><?php echo htmlspecialchars($horaIngresada); ?></div>
                        </div>
                        
                        <div class="arrow-container">
                            <div class="arrow">→</div>
                        </div>
                        
                        <div class="clock-box real-clock">
                            <div class="clock-label">🕐 Hora Real</div>
                            <div class="clock-display real-display"><?php echo htmlspecialchars($resultado['horaReal']); ?></div>
                        </div>
                    </div>

                    <!-- Detalles del cálculo -->
                    <div class="calculation-steps">
                        <h3>📝 Pasos del cálculo:</h3>
                        <div class="steps-grid">
                            <div class="step">
                                <span class="step-number">1</span>
                                <div class="step-content">
                                    <strong>Hora:</strong> <?php echo $resultado['detalles']['pasoHora']; ?>
                                </div>
                            </div>
                            <div class="step">
                                <span class="step-number">2</span>
                                <div class="step-content">
                                    <strong>Minutos:</strong> <?php echo $resultado['detalles']['pasoMinutos']; ?>
                                </div>
                            </div>
                            <div class="step">
                                <span class="step-number">3</span>
                                <div class="step-content">
                                    <strong>Ajuste:</strong> <?php echo $resultado['detalles']['ajusteHora']; ?>
                                </div>
                            </div>
                            <div class="step step-final">
                                <span class="step-number">✓</span>
                                <div class="step-content">
                                    <strong>Resultado final:</strong> <?php echo $resultado['horaReal']; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botón para volver -->
                    <div class="back-button-container">
                        <a href="ejercicio.html" class="btn-calcular btn-back" id="btnVolver">
                            <span class="btn-icon">⬅️</span>
                            Volver al formulario
                        </a>
                    </div>
                </div>
            </section>

            <!-- Código PHP utilizado -->
            <section class="code-section">
                <div class="form-card">
                    <h2 class="form-title">
                        <span class="form-title-icon">💻</span>
                        Archivos PHP usados
                    </h2>
                    <div class="code-files">
                        <div class="code-file">
                            <div class="code-file-header require-tag">
                                <span class="code-tag">require</span>
                                <span class="code-filename">logica.php</span>
                            </div>
                            <p class="code-desc">Contiene la función <code>calcularHoraReal()</code>. Es <strong>obligatorio</strong>: sin este archivo, el programa se detiene con un error fatal.</p>
                        </div>
                        <div class="code-file">
                            <div class="code-file-header include-tag">
                                <span class="code-tag">include</span>
                                <span class="code-filename">header.php</span>
                            </div>
                            <p class="code-desc">Contiene el encabezado HTML (head, CSS, título). Es <strong>opcional</strong>: si falta, solo se pierde el diseño visual.</p>
                        </div>
                        <div class="code-file">
                            <div class="code-file-header include-tag">
                                <span class="code-tag">include</span>
                                <span class="code-filename">footer.php</span>
                            </div>
                            <p class="code-desc">Contiene el pie de página y el script JS. Es <strong>opcional</strong>: si falta, solo se pierde la información del pie.</p>
                        </div>
                    </div>
                </div>
            </section>

            <?php else: ?>
            <!-- Si no se envió el formulario, redirigir al HTML -->
            <section class="form-section">
                <div class="form-card" style="text-align: center;">
                    <h2 class="form-title" style="justify-content: center;">
                        <span class="form-title-icon">⚠️</span>
                        No se recibieron datos
                    </h2>
                    <p style="color: var(--text-secondary); margin-bottom: 24px;">Ingresá una hora desde el formulario para calcular la hora real.</p>
                    <a href="ejercicio.html" class="btn-calcular" style="text-decoration: none; display: inline-flex;">
                        <span class="btn-icon">🪞</span>
                        Ir al formulario
                    </a>
                </div>
            </section>
            <?php endif; ?>
        </main>

<?php
// INCLUDE - Incluimos el footer (pie de página)
// Si este archivo falta, solo faltará la info del pie, pero el programa sigue funcionando
include 'footer.php';
?>
