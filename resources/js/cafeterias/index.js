document.addEventListener('DOMContentLoaded', function() {
    const favoriteButtons = document.querySelectorAll('.favorite-btn');

    favoriteButtons.forEach(btn => {
        const cafeteriaId = btn.dataset.cafeteriaId;
        const icon = btn.querySelector('.favorite-icon');

        fetch(`/favoritos/check/${cafeteriaId}`)
            .then(response => response.json())
            .then(data => {
                updateIcon(icon, data.favorited);
                // reflect ARIA state
                const btnEl = icon.closest('.favorite-btn');
                if (btnEl) {
                    btnEl.setAttribute('aria-pressed', data.favorited ? 'true' : 'false');
                    btnEl.setAttribute('aria-label', data.favorited ? 'Eliminar de favoritos' : 'Agregar a favoritos');
                }
            })
            .catch(() => {});

        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            fetch(`/favoritos/toggle/${cafeteriaId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateIcon(icon, data.favorited);
                    // update ARIA attributes on the button
                    const btnEl = icon.closest('.favorite-btn');
                    if (btnEl) {
                        btnEl.setAttribute('aria-pressed', data.favorited ? 'true' : 'false');
                        btnEl.setAttribute('aria-label', data.favorited ? 'Eliminar de favoritos' : 'Agregar a favoritos');
                    }
                    showToast(data.favorited ? 'success' : 'error', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('error', 'Ocurrió un error al actualizar favoritos');
            });
        });
    });

    function updateIcon(icon, isFavorited) {
        const btn = icon.closest('.favorite-btn');
        const card = btn.closest('.card');

        if (isFavorited) {
            icon.classList.remove('far', 'text-gold');
            icon.classList.add('fas', 'text-white');
            btn.classList.remove('btn-light');
            btn.classList.add('btn-gold');

            card.style.animation = 'favoriteCardPulse 0.8s ease-out';
            btn.style.animation = 'favoriteHeartBoom 0.8s ease-out';

            createHeartParticles(btn);

            setTimeout(() => {
                card.style.animation = '';
                btn.style.animation = '';
            }, 800);
        } else {
            icon.classList.remove('fas', 'text-white');
            icon.classList.add('far', 'text-gold');
            btn.classList.remove('btn-gold');
            btn.classList.add('btn-light');

            btn.style.animation = 'unfavoriteShake 0.4s ease';
            card.style.animation = 'cardFadeOut 0.4s ease';

            setTimeout(() => {
                btn.style.animation = '';
                card.style.animation = '';
            }, 400);
        }
    }

    function createHeartParticles(btn) {
        const colors = ['#D4AF37', '#E5C158', '#FFD700', '#FFA500'];
        for (let i = 0; i < 8; i++) {
            const particle = document.createElement('i');
            particle.className = 'fas fa-heart';
            particle.style.position = 'absolute';
            particle.style.color = colors[Math.floor(Math.random() * colors.length)];
            particle.style.fontSize = (Math.random() * 10 + 10) + 'px';
            particle.style.pointerEvents = 'none';
            particle.style.zIndex = '9999';

            const angle = (Math.PI * 2 * i) / 8;
            const distance = 50;
            const x = Math.cos(angle) * distance;
            const y = Math.sin(angle) * distance;

            particle.style.animation = `heartParticle 0.8s ease-out forwards`;
            particle.style.setProperty('--tx', x + 'px');
            particle.style.setProperty('--ty', y + 'px');

            btn.parentElement.appendChild(particle);

            setTimeout(() => particle.remove(), 800);
        }
    }

    function showToast(type, message) {
        try {
            const toastEl = type === 'success'
                ? document.getElementById('successToast')
                : document.getElementById('errorToast');
            if (!toastEl) return;
            const messageEl = toastEl.querySelector('.toast-body');
            messageEl.textContent = message;
            const ToastCtor = (window.bootstrap && window.bootstrap.Toast) ? window.bootstrap.Toast : (typeof bootstrap !== 'undefined' ? bootstrap.Toast : null);
            if (!ToastCtor) return;
            const toast = new ToastCtor(toastEl);
            toast.show();
        } catch (e) {
            console.warn('Toast no disponible:', e);
        }
    }
});
