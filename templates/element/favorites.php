<script>
document.querySelectorAll('.star-icon').forEach(star => {
    if (star) {
        star.addEventListener('click', function () {
            const targetId = this.dataset.id;
            const targetType = this.dataset.type;

            fetch('/spotify/favorites/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": "<?= $this->request->getAttribute('csrfToken') ?>"
                },
                body: JSON.stringify({target_type: targetType, target_id: targetId})
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.style.color = data.isFavorited ? 'gold' : 'gray';
                        this.setAttribute('data-is-favorited', data.isFavorited ? 'true' : 'false');
                    } else {
                        alert('Erreur lors de la mise à jour du favori.');
                    }
                })
                .catch(error => console.error('Erreur:', error));
        });
    }
});
</script>
