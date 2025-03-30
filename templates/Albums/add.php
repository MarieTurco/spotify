<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Album $album
 * @var \Cake\Collection\CollectionInterface|string[] $artists
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="albums form content">
            <?= $this->Form->create($album) ?>
            <fieldset>
                <legend><?= __('Ajouter un Album') ?></legend>
                <?php
                    echo $this->Form->control('name', ['label' => 'Titre']);
                    echo $this->Form->control('description');
                    echo $this->Form->control('picture', ['label' => 'Couverture'] );
                    echo $this->Form->control('spotify_url', ['label' => __('URL Spotify')]);
                    echo $this->Form->control('artist_id', [
                            'label' => __('Artiste'),
                            'options' => $artists,
                            'type' => 'select',
                        ]);
                        ?>
            </fieldset>
            <?= $this->Form->button(__('Enregistrer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
