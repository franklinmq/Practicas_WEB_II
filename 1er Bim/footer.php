        <section class="info-section">
            <h2>¿Cómo funciona?</h2>
            <div class="info-cards">
                <div class="info-card">
                    <div class="info-card-icon">🕐</div>
                    <h3>Hora</h3>
                    <p>Se resta la hora del espejo a <strong>12</strong> para obtener la hora real.</p>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">⏱️</div>
                    <h3>Minutos</h3>
                    <p>Se restan los minutos del espejo a <strong>60</strong> para obtener los minutos reales.</p>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">🔄</div>
                    <h3>Ajuste</h3>
                    <p>Si los minutos no son <strong>00</strong>, se resta <strong>1 hora</strong> adicional al resultado.</p>
                </div>
            </div>
        </section>

        <footer class="footer">
            <p class="footer-date">&copy; <?php echo date('Y'); ?> - Tercero - 1er Bimestre</p>
        </footer>
    </div>

    <script src="ejercicio1.js"></script>
</body>
</html>
