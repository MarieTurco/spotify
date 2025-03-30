<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Artist $artist
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="artists form content">
            <?= $this->Form->create($artist) ?>
            <fieldset>
                <legend><?= __('Ajout d\'un artiste') ?></legend>
                <?php
                    echo $this->Form->control('name', ['label' => __('Nom')]);
                    echo $this->Form->control('bio', ['label' => __('Biographie')]);
                    echo $this->Form->control('picture', ['label' => __('Photo')]);
                    echo $this->Form->control('spotify_url', ['label' => __('URL Spotify')]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Enregistrer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
