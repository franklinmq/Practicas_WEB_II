// =============================================
// ejercicio1.js - Interactividad del Reloj Espejo
// =============================================

document.addEventListener('DOMContentLoaded', function () {

    // === Scroll automático al resultado ===
    const resultado = document.getElementById('resultado');
    if (resultado) {
        resultado.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // === Validación del formulario ===
    const form = document.getElementById('formReloj');
    const btnCalcular = document.getElementById('btnCalcular');

    if (form) {
        form.addEventListener('submit', function (e) {
            const hora = document.getElementById('hora');
            const minuto = document.getElementById('minuto');

            if (!hora.value || !minuto.value) {
                e.preventDefault();
                // Efecto de shake en el botón
                btnCalcular.classList.add('shake');
                setTimeout(() => btnCalcular.classList.remove('shake'), 500);

                // Resaltar campos vacíos
                if (!hora.value) hora.style.borderColor = '#f43f5e';
                if (!minuto.value) minuto.style.borderColor = '#f43f5e';

                setTimeout(() => {
                    hora.style.borderColor = '';
                    minuto.style.borderColor = '';
                }, 2000);
            } else {
                // Animación de carga en el botón
                btnCalcular.innerHTML = '<span class="btn-icon">⏳</span> Calculando...';
                btnCalcular.style.opacity = '0.8';
            }
        });
    }

    // === Efecto de selección en los selects ===
    const selects = document.querySelectorAll('.time-select');
    selects.forEach(select => {
        select.addEventListener('change', function () {
            this.style.borderColor = '#8b5cf6';
            setTimeout(() => {
                this.style.borderColor = '';
            }, 1000);
        });
    });

    // === Animación de las tarjetas de ejemplo al hacer hover ===
    const exampleCards = document.querySelectorAll('.example-card');
    exampleCards.forEach(card => {
        card.addEventListener('click', function () {
            const mirrorText = this.querySelector('.example-mirror').textContent;
            // Extraer hora y minutos del texto (formato "🪞 HH:MM")
            const match = mirrorText.match(/(\d{2}):(\d{2})/);
            if (match) {
                const horaSelect = document.getElementById('hora');
                const minutoSelect = document.getElementById('minuto');
                if (horaSelect && minutoSelect) {
                    horaSelect.value = parseInt(match[1]);
                    minutoSelect.value = parseInt(match[2]);

                    // Efecto visual
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 200);

                    // Scroll al formulario
                    form.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });

        // Cursor pointer para los ejemplos
        card.style.cursor = 'pointer';
    });
});

// CSS para animación de shake (inyectado dinámicamente)
const shakeStyle = document.createElement('style');
shakeStyle.textContent = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        20% { transform: translateX(-8px); }
        40% { transform: translateX(8px); }
        60% { transform: translateX(-4px); }
        80% { transform: translateX(4px); }
    }
    .shake {
        animation: shake 0.5s ease-in-out;
    }
`;
document.head.appendChild(shakeStyle);
