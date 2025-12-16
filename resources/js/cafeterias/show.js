document.addEventListener('DOMContentLoaded', function() {
    const favoriteBtn = document.getElementById('favoriteBtn');
    const favoriteIcon = document.getElementById('favoriteIcon');
    const favoriteText = document.getElementById('favoriteText');
    
    if (!favoriteBtn) return;
    
    const cafeteriaId = favoriteBtn.dataset.cafeteriaId;
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    
    if (!csrfToken) {
        console.error('CSRF token not found');
        return;
    }
    
    // Verificar estado inicial
    fetch(`/favoritos/check/${cafeteriaId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            updateButton(data.favorited);
            // Reflect ARIA state
            favoriteBtn.setAttribute('aria-pressed', data.favorited ? 'true' : 'false');
            favoriteBtn.setAttribute('aria-label', data.favorited ? 'Eliminar de favoritos' : 'Agregar a favoritos');
        })
        .catch(error => {
            console.error('Error checking favorite status:', error);
            favoriteText.textContent = 'Agregar a Favoritos';
            favoriteIcon.classList.add('far');
        });
    
    // Toggle favorito
    favoriteBtn.addEventListener('click', function() {
        fetch(`/favoritos/toggle/${cafeteriaId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.content
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                updateButton(data.favorited);
                favoriteBtn.setAttribute('aria-pressed', data.favorited ? 'true' : 'false');
                favoriteBtn.setAttribute('aria-label', data.favorited ? 'Eliminar de favoritos' : 'Agregar a favoritos');
                // Mostrar notificación
                if (data.favorited) {
                    showToast('success', data.message);
                } else {
                    showToast('error', data.message);
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'Ocurrió un error al actualizar favoritos');
        });
    });
    
    function updateButton(isFavorited) {
        if (isFavorited) {
            favoriteIcon.classList.remove('far');
            favoriteIcon.classList.add('fas');
            favoriteText.textContent = 'Eliminar de Favoritos';
            favoriteBtn.classList.remove('btn-outline-gold');
            favoriteBtn.classList.add('btn-gold');
            
            // Animación compleja de favorito
            favoriteBtn.style.animation = 'favoriteHeartBoom 0.8s ease-out';
            createHeartParticles(favoriteBtn);
            
            setTimeout(() => {
                favoriteBtn.style.animation = '';
            }, 800);
        } else {
            favoriteIcon.classList.remove('fas');
            favoriteIcon.classList.add('far');
            favoriteText.textContent = 'Agregar a Favoritos';
            favoriteBtn.classList.remove('btn-gold');
            favoriteBtn.classList.add('btn-outline-gold');
            
            // Animación al quitar favorito
            favoriteBtn.style.animation = 'unfavoriteShake 0.4s ease';
            setTimeout(() => {
                favoriteBtn.style.animation = '';
            }, 400);
        }
    }
    
    function createHeartParticles(btn) {
        const colors = ['#D4AF37', '#E5C158', '#FFD700', '#FFA500'];
        const btnRect = btn.getBoundingClientRect();
        
        for (let i = 0; i < 8; i++) {
            const particle = document.createElement('i');
            particle.className = 'fas fa-heart';
            particle.style.position = 'fixed';
            particle.style.left = btnRect.left + btnRect.width / 2 + 'px';
            particle.style.top = btnRect.top + btnRect.height / 2 + 'px';
            particle.style.color = colors[Math.floor(Math.random() * colors.length)];
            particle.style.fontSize = (Math.random() * 10 + 10) + 'px';
            particle.style.pointerEvents = 'none';
            particle.style.zIndex = '9999';
            
            const angle = (Math.PI * 2 * i) / 8;
            const distance = 60;
            const x = Math.cos(angle) * distance;
            const y = Math.sin(angle) * distance;
            
            particle.style.animation = `heartParticle 0.8s ease-out forwards`;
            particle.style.setProperty('--tx', x + 'px');
            particle.style.setProperty('--ty', y + 'px');
            
            document.body.appendChild(particle);
            
            setTimeout(() => particle.remove(), 800);
        }
    }
    
    function showToast(type, message) {
        const toastEl = type === 'success' 
            ? document.getElementById('successToast')
            : document.getElementById('errorToast');
        
        if (!toastEl) {
            console.error('Toast element not found');
            return;
        }
        
        const messageEl = toastEl.querySelector('.toast-body');
        if (messageEl) {
            messageEl.textContent = message;
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    }
});
