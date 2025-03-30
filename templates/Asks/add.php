<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ask $ask
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <?php if ($this->Flash->render()): ?>
        <div class="alert alert-danger">
            <?= $this->Flash->render() ?>
        </div>
    <?php endif; ?>
    <div class="column column-80">
        <div class="asks form content">
            <?= $this->Form->create($ask) ?>
            <fieldset>
                <legend><?= __('Nouvelle demande') ?></legend>
                <?php
                    echo $this->Form->control('user_id', [
                        'value' => $currentUser->id,
                        'readonly' => true,
                        'type' => 'hidden'
                    ]);
                    echo $this->Form->control('target_type', ['options' => $targets, 'label' => __('Type de demande')]);
                    echo $this->Form->control('spotify_url', ['label' => __('Spotify URL')]);
                    echo $this->Form->control('message', ['label' => __('Nom')]);
                    ?>
                <div id="artist-field">
                    <?= $this->Form->control('artist_id', ['options' => $artists, 'label' => __('Nom de l\'artiste')]); ?>
                </div>
                <?php echo $this->Form->control('status', [
                            'value' => 'En attente',
                            'readonly' => true,
                            'type' => 'hidden'
                        ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Enregistrer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Sélectionner les éléments du DOM
        let targetTypeField = document.querySelector("select[name='target_type']");
        let artistField = document.getElementById("artist-field");

        // Vérifier la valeur initiale de target_type
        function toggleArtistField() {
            if (targetTypeField.value === "album") {
                artistField.style.display = "block"; // Afficher le champ artist_id
            } else {
                artistField.style.display = "none"; // Masquer le champ artist_id
            }
        }

        // Écouter le changement de valeur dans target_type
        targetTypeField.addEventListener("change", function() {
            toggleArtistField(); // Met à jour l'affichage du champ artist_id en fonction de target_type
        });

        // Initialisation : appeler la fonction au chargement de la page
        toggleArtistField();
    });


</script>

