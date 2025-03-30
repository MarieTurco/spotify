<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ask $ask
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="asks form content">
            <?= $this->Form->create($ask) ?>
            <fieldset>
                <legend><?= __('Modifier la demande') ?></legend>
                <?php
                    echo $this->Form->control('user_id', [
                        'value' => $currentUser->id,
                        'readonly' => true,
                        'type' => 'hidden'
                    ]);
                echo $this->Form->control('target_type', ['options' => $targets, 'label' => __('Type de demande')]);
                echo $this->Form->control('spotify_url', ['label' => __('Spotify URL')]);
                echo $this->Form->control('message', ['label' => __('Nom')]);
                echo $this->Form->control('status', [
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
